app.controller('HomeAdminCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.transactions = [];
    $scope.users = {};

    function init() {
        $http.get(baseUrl+'/transactions/all', {}).then(function(response) {
            console.log(response);
            $scope.transactions = response.data;
        }, function() {

        });

        $http.get(baseUrl+'/users/hashed_users', {}).then(function(response) {
            $scope.users = response.data;
        }, function() {

        });
    }

    $scope.removeTransaction = function(item) {
        var r = confirm("Are you sure you want to delete this transactions? This cannot be undone.");
        if (r == true) {
            $scope.transactions = [];
            var data = {
                transaction_id: item.id
            };
            $http.post(baseUrl+'/transactions/delete', data, {}).then(function(response) {
                $scope.transactions = response.data;
            }, function() {

            });
        }
    };

    angular.element(document).ready(function () {
        init();
    });

}]);
