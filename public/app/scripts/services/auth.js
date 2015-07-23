'use strict';

/**
 * @ngdoc service
 * @name publicApp.auth
 * @description
 * # auth
 * Service in the publicApp.
 */
angular.module('publicApp')
    .service('auth', function ($http, URL_API, authToken, $state,$window) {

        function authSuccessful(res) {
            authToken.setToken(res.token);
            $window.location.href = 'http://'+res.data.name+'.aria.app/#/shops?token='+res.token;
        }

        this.login = function(email, password)
        {
            return $http.post(URL_API + 'members/login',{email:email, password:password}).success(authSuccessful);
        };

        this.register = function(name, email, password){

            return $http.post(URL_API + 'members/register',{name:name, email:email, password:password}).success(authSuccessful);
        }
    });
