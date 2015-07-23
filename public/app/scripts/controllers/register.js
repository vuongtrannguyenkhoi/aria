'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:RegisterCtrl
 * @description
 * # RegisterCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('RegisterCtrl', function ($scope, auth) {


        $scope.submit = function(){

            auth.register($scope.name, $scope.email, $scope.password)
                .success(function(res){
                    alert('ok');
                })
                .error(function(err){
                    alert('not ok');
                });
        }
    });
