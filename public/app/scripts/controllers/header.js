'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:HeaderCtrl
 * @description
 * # HeaderCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('HeaderCtrl', function ($scope, authToken) {
        $scope.isAuthenticated = authToken.isAuthenticated;
  });
