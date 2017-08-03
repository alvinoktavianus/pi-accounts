app.controller('HomeUserCtrl', ['$scope', '$http', function($scope, $http) {

    $scope.transactions = [];
    $scope.status = [];

    function init() {
        $http.get(baseUrl+'/transactions/all', {}).then(function(response) {
            console.log(response);
            $scope.transactions = response.data;
        }, function() {

        });

        $http.get(baseUrl+'/statuses/all', {}).then(function(response) {
            console.log(response);
            $scope.status = response.data;
        }, function() {

        });
    }

    angular.element(document).ready(function () {
        init();
    });

}]);
