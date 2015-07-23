'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:LoginCtrl
 * @description
 * # LoginCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
  .controller('LoginCtrl', function ($scope, auth) {

        $scope.submit = function(){

            auth.login($scope.email, $scope.password)
                .success(function(res){

                    alert('^^ Thanks for coming back!');
                })
                .error(function(err){

                    alert(':( Invalid email or password');
                });
        }
  });
