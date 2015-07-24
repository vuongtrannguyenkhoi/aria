'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsDetailCtrl
 * @description
 * # ProductsDetailCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsCreateCtrl', function ($scope, $state, $http, URL_API, FileUploader, Restangular, $timeout) {

        var baseProducts = Restangular.all('products');

        var uploader = $scope.uploader = new FileUploader({
            url: URL_API + 'products/upload'
        });


        uploader.onCompleteItem = function(fileItem, response, status, headers) {

            $scope.fileUrl = response.data;
        };

        //load tags
        var baseTags = Restangular.all('tags');

        baseTags.getList().then(function (tags) {

            $scope.tags = tags;
        });

        $scope.tagAdded = function(tag){

            baseTags.post(tag);
        };

        $scope.loadItems = function(query) {

            return baseTags.getList().then(function(tags){

                return tags;
            });
        };

        /**
         * @property interface
         * @type {Object}
         */
        $scope.interface = {};

        /**
         * @property uploadCount
         * @type {Number}
         */
        $scope.uploadCount = 0;

        /**
         * @property success
         * @type {Boolean}
         */
        $scope.success = false;

        /**
         * @property error
         * @type {Boolean}
         */
        $scope.error = false;

        // Listen for when the interface has been configured.
        $scope.$on('$dropletReady', function whenDropletReady() {

            $scope.interface.allowedExtensions(['png', 'jpg', 'bmp', 'gif', 'svg', 'torrent','rar']);
            $scope.interface.setRequestUrl(URL_API + 'products/upload');
            $scope.interface.defineHTTPSuccess([/2.{2}/]);
            $scope.interface.useArray(true);

        });

        // Listen for when the files have been successfully uploaded.
        $scope.$on('$dropletSuccess', function onDropletSuccess(event, response, files) {

            $scope.uploadCount = files.length;
            $scope.success     = true;
            console.log(response, files);
            if(!$scope.photos)
                $scope.photos = response.data;
            else{

                angular.forEach(response.data, function(value, key) {
                    $scope.photos.push(value);
                });


            }

            $timeout(function timeout() {
                $scope.success = false;
            }, 5000);

        });

        // Listen for when the files have failed to upload.
        $scope.$on('$dropletError', function onDropletError(event, response) {

            $scope.error = true;
            console.log(response);
            $timeout(function timeout() {
                $scope.error = false;
            }, 5000);

        });

        $scope.submit = function(){

            var product = {
                fileUrl: $scope.photos[0],
                name: $scope.name,
                price: $scope.price,
                active: $scope.active,
                content: $scope.content,
                photos: $scope.photos
            };

            baseProducts.post(product).then(function(res){

                $state.go('membersDashboard.products',{},{
                    reload: true
                });
            });
        }
    }).directive('progressbar', function ProgressbarDirective() {

        return {

            /**
             * @property restrict
             * @type {String}
             */
            restrict: 'A',

            /**
             * @property scope
             * @type {Object}
             */
            scope: {
                model: '=ngModel'
            },

            /**
             * @property ngModel
             * @type {String}
             */
            require: 'ngModel',

            /**
             * @method link
             * @param scope {Object}
             * @param element {Object}
             * @return {void}
             */
            link: function link(scope, element) {

                var progressBar = new ProgressBar.Path(element[0], {
                    strokeWidth: 2
                });

                scope.$watch('model', function() {

                    progressBar.animate(scope.model / 100, {
                        duration: 1000
                    });

                });

                scope.$on('$dropletSuccess', function onSuccess() {
                    progressBar.animate(0);
                });

                scope.$on('$dropletError', function onSuccess() {
                    progressBar.animate(0);
                });

            }

        }

    });
