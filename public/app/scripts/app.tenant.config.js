'use strict';

/**
 * @ngdoc overview
 * @name publicApp
 * @description
 * # publicApp
 *
 * Main module of the application.
 */
angular.module('publicApp').config(function($urlRouterProvider, $stateProvider, $httpProvider, RestangularProvider){

    $urlRouterProvider.otherwise('/shops');

    $stateProvider
        .state('logout',{
            url: '/logout',
            controller: 'LogoutCtrl'
        })
        .state('main',{
            url: '/shops',
            templateUrl:'/app/views/tenant/shops/index.html'
        })
        .state('shops',{
            url: '/shops',
            templateUrl:'/app/views/tenant/shops/index.html'
        })
        .state('shops.tagsListProducts',{
            url: '/tags/{tag:string}',
            templateUrl:'/app/views/tenant/shops/tagsList.html'
        })
        .state('productDetail',{
            url: '/shops/products/{slug:string}',
            templateUrl:'/app/views/tenant/shops/productDetail.html'
        })
        .state('membersDashboard',{
            url: '/dashboard',
            templateUrl:'/app/views/tenant/dashboard/index.html'
        })
        .state('membersDashboard.account',{
            url: '/account',
            templateUrl:'/app/views/tenant/dashboard/account/index.html',
            controller: 'AccountCtrl'
        })
        .state('membersDashboard.products',{
            url: '/products',
            templateUrl:'/app/views/tenant/dashboard/products/index.html',
            controller: 'ProductsCtrl'
        })
        .state('membersDashboard.products.create',{
            url: '/create',
            templateUrl:'/app/views/tenant/dashboard/products/create.html',
            controller: 'ProductsCreateCtrl'
        })
        .state('membersDashboard.products.edit',{
            url: '/{productId}/edit',
            templateUrl:'/app/views/tenant/dashboard/products/edit.html',
            controller: 'ProductsEditCtrl'
        })
        .state('membersDashboard.products.show',{
            url: '/{productId}',
            templateUrl:'/app/views/tenant/dashboard/products/detail.html',
            controller: 'ProductsDetailCtrl'
        })
        .state('membersDashboard.orders',{
            url: '/orders',
            templateUrl:'/app/views/tenant/dashboard/orders/index.html'
        });

    $httpProvider.interceptors.push('authInterceptor');
    RestangularProvider.setBaseUrl('http://aria.app/api/');
    // add a response interceptor
    RestangularProvider.addResponseInterceptor(function(data, operation, what, url, response, deferred) {
        var extractedData;
        // .. to look for getList operations
        if (operation === "getList") {
            // .. and handle the data and meta data
            extractedData = data.data.data;
            extractedData.meta = data.data.meta;
        } else {
            extractedData = data.data;
        }
        return extractedData;
    });

})
    .constant('URL_API','http://aria.app/api/');

