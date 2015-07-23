'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:DashboardCtrl
 * @description
 * # DashboardCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('DashboardCtrl', function ($http, URL_API) {

      $http.get(URL_API + 'dashboard/info')
          .success(function(info){

          })
          .error(function(err){
            window.location = "http://aria.app/";
          });
    });
