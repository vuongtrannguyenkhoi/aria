'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsDetailCtrl
 * @description
 * # ProductsDetailCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsCreateCtrl', function ($scope, $state, $http, URL_API, FileUploader, Restangular, $timeout, $modal, $log, authToken,editableOptions) {

        editableOptions.theme = 'bs3';

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
            $scope.interface.setRequestUrl(URL_API + 'photos/uploads');
            $scope.interface.defineHTTPSuccess([/2.{2}/]);
            $scope.interface.useArray(true);

            var token = authToken.getToken();
            if(token)
                var authorization = 'Bearer ' + token;

            $scope.interface.setRequestHeaders({
                Authorization: authorization
            });

        });

        // Listen for when the files have been successfully uploaded.
        $scope.$on('$dropletSuccess', function onDropletSuccess(event, response, files) {

            $scope.uploadCount = files.length;
            $scope.success     = true;
            if(!$scope.photos){
                $scope.photos = response.data;
            }
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
        $scope.dialogShown = false;
        $scope.toggleModal = function() {



            $scope.dialogShown = !$scope.dialogShown;
        };

        $scope.photoDetail = function(photo){
            //get photo of photoId
            Restangular.one('photos', photo.id).get().then(function(photo){

                $scope.photoDetailObject = photo;

                $scope.isShowedPhotoDetail = true;
            });
        };

        $scope.photoDetailClose = function(){

            $scope.isShowedPhotoDetail = false;
        };

        $scope.updatePhoto = function(photo){

            photo.put().then(function(photo){

                alert('Update photo!');
            });
        };

        $scope.submit = function(){

            var product = {
                fileUrl: $scope.photos[0].thumb,
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
    });
