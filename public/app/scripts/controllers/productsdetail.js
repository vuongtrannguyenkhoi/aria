'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsDetailCtrl
 * @description
 * # ProductsDetailCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsDetailCtrl', function ($scope, $stateParams, Restangular, cfpLoadingBar) {

        Restangular.one('products', $stateParams.productId).get().then(function(product){

            $scope.product = product;
            $scope.isShowed = true;
        });
    });
