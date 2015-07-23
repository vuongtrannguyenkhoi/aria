'use strict';

/**
 * @ngdoc directive
 * @name publicApp.directive:sameAs
 * @description
 * # sameAs
 */
angular.module('publicApp')
  .directive('validateEquals', function () {
    return {
      template: '<div></div>',
      restrict: 'E',
      link: function postLink(scope, element, attrs) {
        element.text('this is the sameAs directive');
      }
    };
  });
