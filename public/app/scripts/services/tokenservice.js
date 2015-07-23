'use strict';

/**
 * @ngdoc service
 * @name publicApp.TokenService
 * @description
 * # TokenService
 * Service in the publicApp.
 */
angular.module('publicApp')
  .service('TokenService', function ($http) {
        return {
            get: get
        };

        ////
        function get() {
            return $http.get('auth/token').then(
                success,
                fail
            );
        }

        function success(response) {
            return response;
        }

        function fail(response) {
            return response;
        }
  });
