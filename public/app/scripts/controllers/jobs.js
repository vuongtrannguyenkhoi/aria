'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:JobsCtrl
 * @description
 * # JobsCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('JobsCtrl', function ($scope, $http, URL_API) {

        $http.get(URL_API + 'jobs')
            .success(function(jobs){

            })
            .error(function(err){
                alert('Unable to get jobs:'+err.message);
            });
    });
