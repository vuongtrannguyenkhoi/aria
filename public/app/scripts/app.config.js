'use strict';

/**
 * @ngdoc overview
 * @name publicApp
 * @description
 * # publicApp
 *
 * Main module of the application.
 */
angular.module('publicApp').config(function($urlRouterProvider, $stateProvider, $httpProvider){

    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state('main',{
            url: '/',
            templateUrl:'/app/views/main.html',
        })
        .state('jobs',{
            url: '/jobs',
            templateUrl:'/app/views/jobs.html',
            controller: 'JobsCtrl'
        })
        .state('login',{
            url: '/members/login',
            templateUrl:'/app/views/members/login.html',
            controller: 'LoginCtrl'
        })
        .state('register',{
            url: '/members/register',
            templateUrl:'/app/views/members/register.html',
            controller: 'RegisterCtrl'
        })
        .state('logout',{
            url: '/members/logout',
            controller: 'LogoutCtrl'
        });

    $httpProvider.interceptors.push('authInterceptor');
})
    .constant('URL_API','http://aria.app/api/');

