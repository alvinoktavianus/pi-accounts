app.controller('CategoriesAdminCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.isLoading = true;
    $scope.responses = {
        showNotif: false
    };
    $scope.categories = [];
    $scope.category = {};

    function init() {
        $http.get(baseUrl+'/categories/get_all_categories', {}).then(function (responses) {
            $scope.categories = responses.data;
        }, function () {
            
        });
        $scope.isLoading = false;
    }

    $scope.addNewCategory = function(formName) {
        if (formName.$valid) {
            $scope.isLoading = true;
            $scope.categories = [];
            $http.post(baseUrl+'/categories/new', $scope.category, {}).then(function(responses) {
                $scope.isLoading = false;
                $scope.responses.showNotif = true;
                $scope.categories = responses.data;
                formName.$setPristine();
                $scope.category = {};
            }, function(){

            });
        }
    };

    angular.element(document).ready(function () {
        init();
    });

}]);
