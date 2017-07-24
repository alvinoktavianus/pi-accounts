app.controller('CategoriesAdminCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.isLoading = true;
    $scope.responses = {
        showNotif: false,
        message: null
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

    $scope.removeCategory = function(categoryId) {
        var r = confirm("Are you sure you want to delete this category? This cannot be undone.");
        if (r == true) {
            $scope.isLoading = true;
            $scope.categories = [];
            $http.post(baseUrl+'/categories/update', {category_id: categoryId}, {}).then(function(response) {
                $scope.isLoading = false;
                $scope.responses.showNotif = true;
                $scope.responses.message = "Successfully delete a category";
                $scope.categories = response.data;
            }, function() {

            });
        } else {
            return;
        }
    };

    $scope.addNewCategory = function(formName) {
        if (formName.$valid) {
            $scope.isLoading = true;
            $scope.categories = [];
            $http.post(baseUrl+'/categories/new', $scope.category, {}).then(function(responses) {
                $scope.isLoading = false;
                $scope.responses.showNotif = true;
                $scope.responses.message = "Successfully insert new category";
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
