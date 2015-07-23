'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsDetailCtrl
 * @description
 * # ProductsDetailCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsCreateCtrl', function ($scope, $state, $http, URL_API, FileUploader, Restangular) {

        var baseProducts = Restangular.all('products');

        var uploader = $scope.uploader = new FileUploader({
            url: URL_API + 'products/upload'
        });


        uploader.onCompleteItem = function(fileItem, response, status, headers) {

            $scope.fileUrl = response.data;
        };

        //load tags
        var baseTags = Restangular.all('tags');

        baseTags.getList().then(function (tags) {

            $scope.tags = tags;
        });

        $scope.tagAdded = function(tag){

            baseTags.post(tag);
        };

        $scope.loadItems = function(query) {

            return baseTags.getList().then(function(tags){

                return tags;
            });
        };

        $scope.submit = function(){

            var product = {
                fileUrl: $scope.fileUrl,
                name: $scope.name,
                price: $scope.price,
                active: $scope.active,
                content: $scope.content
            };

            baseProducts.post(product).then(function(res){

                $state.go('membersDashboard.products',{},{
                    reload: true
                });
            });
        }
    });
