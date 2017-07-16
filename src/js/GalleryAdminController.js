app.controller('GalleryAdminCtrl', ['$scope', 'FileUploader', function($scope, FileUploader) {

    $scope.uploader = new FileUploader();

    $scope.galleryform = {};
    $scope.images = [{}];

    $scope.addImage = function(event) {
        event.preventDefault();
        $scope.images.push({});
    };

    $scope.removeImages = function(event, image) {
        event.preventDefault();
        if ($scope.images.length > 1) {
            var index = $scope.images.indexOf(image);
            $scope.images.splice(index, 1);
        }
    };

}]);