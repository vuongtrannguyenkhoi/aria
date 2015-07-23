'use strict';

/**
 * @ngdoc service
 * @name publicApp.authInterceptor
 * @description
 * # authInterceptor
 * Factory in the publicApp.
 */
angular.module('publicApp')
    .factory('authInterceptor', function (authToken) {

        return {
            request: function(config){

                var token = authToken.getToken();
                if(token)
                    config.headers.Authorization = 'Bearer ' + token;
                return config;
            },
            response: function(res){
                return res;
            }
        };
    });
