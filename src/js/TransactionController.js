app.controller('TransactionCtrl', ['$scope', '$http', '$q', function($scope, $http, $q) {

    $scope.users = [];
    $scope.transaction = {};
    $scope.transaction.items = [{}];
    $scope.transaction.total_price = 0;
    $scope.transaction.shipping_fee = 0;
    $scope.uiSelectPlaceholder = "Loading...";
    $scope.isSelectable = false;
    $scope.responses = {
        showNotif: false,
        message: null,
        isSuccess: false
    };

    function init() {
        // get all users
        $http.get(baseUrl+'/users/get_all_users', {}).then(function(response) {
            $scope.users = response.data;
            $scope.isSelectable = true;
            $scope.uiSelectPlaceholder = "Select or search with email...";
        }, function() {

        });
    }

    $scope.addItem = function() {
        $scope.transaction.items.push({});
    };

    $scope.removeItem = function(item) {
        var index = $scope.transaction.items.indexOf(item);
        $scope.transaction.items.splice(index, 1); 
    };

    $scope.calcTotalPrice = function() {
        $scope.transaction.total_price = 0;
        angular.forEach($scope.transaction.items, function(item) { $scope.transaction.total_price += !isNaN(item.qty * item.price) ? (item.qty * item.price) : 0; });
        $scope.transaction.total_price += $scope.transaction.shipping_fee;
    };

    $scope.submitForm = function() {
        var data = {
            user_id: $scope.transaction.selected ? $scope.transaction.selected.id : null,
            total_price: $scope.transaction.total_price,
            shipping_fee: $scope.transaction.shipping_fee,
            total: $scope.transaction.total_price,
            items: $scope.transaction.items
        }
        // console.log(data);
        $http.post(baseUrl+'/transactions/insert_new_transaction', data, {}).then(function(response) {
            $scope.responses.showNotif = true;
            $scope.responses.message = "Successfully insert new transaction";
            $scope.responses.isSuccess = true;
        }, function() {
            $scope.responses.showNotif = true;
            $scope.responses.message = "Please re-check your data!";
            $scope.responses.isSuccess = false;
        });
    };

    angular.element(document).ready(function () {
        init();
    });

}]);
