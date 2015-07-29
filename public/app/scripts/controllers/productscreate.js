'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ProductsDetailCtrl
 * @description
 * # ProductsDetailCtrl
 * Controller of the publicApp
 */
angular.module('publicApp')
    .controller('ProductsCreateCtrl', function (
        $scope,
        $state,
        $http,
        URL_API,
        FileUploader,
        Restangular,
        $timeout,
        $modal,
        $log,
        authToken,
        editableOptions,
        editableThemes,
        Upload
    ) {

        editableOptions.theme = 'bs3';
        editableThemes.bs3.inputClass = 'input-sm';
        editableThemes.bs3.buttonsClass = 'btn-sm';

        var baseProducts = Restangular.all('products');



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

        //start upload files
        $scope.$watch('files', function () {
            $scope.upload($scope.files);
        });

        $scope.photos = [];

        $scope.upload = function (files) {
            if (files && files.length) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    $timeout(function(){
                        Upload.upload({
                            url: URL_API + 'photos/upload',
                            file: file
                        }).progress(function (evt) {
                            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);

                        }).success(function (response, status, headers, config) {

                                $scope.photos.push(response.data);

                            console.log(response);
                        });
                    },500);
                }
            }
        };
        //end upload files

        $scope.dialogShown = false;
        $scope.toggleModal = function() {



            $scope.dialogShown = !$scope.dialogShown;
        };

        //photo view aria

        function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {

            var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);

            return { width: srcWidth*ratio, height: srcHeight*ratio };
        }

        $scope.photoDetail = function(photo){
            //get photo of photoId
            $scope.currPhotoIndex = $scope.photos.indexOf(photo);
            Restangular.one('photos', photo.id).get().then(function(photo){

                $scope.photoDetailObject = photo;
                $scope.isShowedPhotoDetail = true;
            });
        };

        $scope.photoDetailClose = function(){

            $scope.isShowedPhotoDetail = false;
        };

        $scope.prevImage = function(){

            if($scope.currPhotoIndex - 1 > -1){

                $scope.photoDetail($scope.photos[$scope.currPhotoIndex-1]);
            }

        };

        $scope.nextImage = function(){

            if($scope.currPhotoIndex + 1 < $scope.photos.length){

                $scope.photoDetail($scope.photos[$scope.currPhotoIndex+1]);
            }
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
