'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsDetailCtrl
 * @description
 * # ProductsDetailCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsEditCtrl', function ($scope, $state, $http, $stateParams, URL_API, FileUploader, Restangular) {

        var uploader = $scope.uploader = new FileUploader({
            url: URL_API + 'products/upload'
        });


        uploader.onCompleteItem = function(fileItem, response, status, headers) {

            $scope.product.thumb = response.data;
        };

        Restangular.one('products', $stateParams.productId).get().then(function(product){

            $scope.product = product;
            $scope.isShowed = true;
        });

        $scope.submit = function(){

            var product = Restangular.copy($scope.product);
            console.log(product);
            product.put().then(function(res){
                console.log(res);
                $state.go('membersDashboard.products',{},{reload:true});
            });

        }

    });
