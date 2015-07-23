'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:LogoutCtrl
 * @description
 * # LogoutCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('LogoutCtrl', function (authToken, $state) {
        authToken.removeToken();

        window.location = "http://aria.app/";

    });
