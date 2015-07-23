'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:AccountCtrl
 * @description
 * # AccountCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('AccountCtrl', function ($scope, $http, URL_API) {

      $http.get(URL_API + 'members/info')
          .success(function(info){

          })
          .error(function(err){
              window.location = "http://aria.app/";
          });
    });
