'use strict';

/**
 * @ngdoc overview
 * @name publicApp
 * @description
 * # publicApp
 *
 * Main module of the application.
 */
var app =angular
    .module('publicApp', ['ui.router','angularFileUpload','ngAnimate','restangular','angular-redactor','angular-loading-bar','ngSanitize','datatables','datatables.bootstrap','ngTagsInput']);

app.run(['$http','$location','$window', function($http,$location,$window) {

    var searchObject = $location.search();
    if(searchObject.token)
        $window.localStorage.setItem('userToken',searchObject.token);

}]);


