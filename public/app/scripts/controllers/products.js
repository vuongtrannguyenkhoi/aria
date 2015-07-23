'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsCtrl
 * @description
 * # ProductsCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsCtrl', function ($scope, $http, URL_API, Restangular,DTOptionsBuilder, DTColumnBuilder,authToken, $compile) {
        var vm = this;
        var baseProducts = Restangular.all('products');

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withOption('ajax', {
                // Either you specify the AjaxDataProp here
                // dataSrc: 'data',
                url: URL_API + 'products/datatables',
                type: 'POST',
                headers: {
                    "Authorization": 'Bearer ' + authToken.getToken()
                }
            })
            // or here
            .withBootstrap()
            .withBootstrapOptions({
                pagination: {
                    classes: {
                        ul: 'pagination pagination-sm'
                    }
                }
            })
            .withOption('createdRow', createdRow)
            .withDataProp('data')
            .withOption('processing', true)
            .withOption('serverSide', true)
            .withPaginationType('full_numbers');
        $scope.dtColumns = [
            DTColumnBuilder.newColumn(null).withTitle('Name')
                .renderWith(detailLinkHtml),
            DTColumnBuilder.newColumn('price').withTitle('Price'),
            DTColumnBuilder.newColumn(null).notSortable()
                .renderWith(actionsHtml)
        ];

        $scope.delete = function(id){

            $http.delete(URL_API + 'products/' + id).then(function(res){

                $scope.dtInstance.reloadData();
            });

        };

        function createdRow(row, data, dataIndex) {
            // Recompiling so we can bind Angular directive to the DT
            $compile(angular.element(row).contents())($scope);
        }

        function actionsHtml(data, type, full, meta) {
            return '<a class="btn btn-danger btn-sm" ng-click="delete(\''+data.id+'\')">delete</a>';
        }

        function detailLinkHtml(data, type, full, meta) {
            return '<a ui-sref="membersDashboard.products.show({productId:\''+data.id+'\'})">'+data.name+'</a>';
        }

        $scope.dtInstanceCallback = function(dtInstance) {
            $scope.dtInstance = dtInstance;
        }

    });
