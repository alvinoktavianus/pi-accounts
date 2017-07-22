app.controller('TransactionCtrl', ['$scope', '$http', '$q', function($scope, $http, $q) {

    $scope.users = [];
    $scope.transaction = {};

    function init() {
        // get all users
        $http.get(baseUrl+'/users/get_all_users', {}).then(function(response) {
            // console.log(response);
            $scope.users = response.data;
            $scope.transaction.user = $scope.users[0];
        }, function() {

        });
    }

    angular.element(document).ready(function () {
        init();
    });

}]);