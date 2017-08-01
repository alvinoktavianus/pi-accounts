<div ng-controller="HomeAdminCtrl">

    <h3 ng-if="transactions.length == 0">Loading...</h3>

    <div class="table-responsive" ng-if="transactions.length > 0" ng-cloak>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice No.</th>
                    <th>Customer</th>
                    <th>Transaction Detail</th>
                    <th>Shipping Fee</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="transaction in transactions track by $index">
                    <td>{{$index+1}}</td>
                    <td>{{transaction.invoice_no}}</td>
                    <td>{{users[transaction.user_id].first_name + ' ' + users[transaction.user_id].last_name}}</td>
                    <td>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Qty</th>
                                    <th>Price/item</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="detail in transaction.details">
                                    <td>{{detail.item_name}}</td>
                                    <td>{{detail.quantity | number:0}}</td>
                                    <td>{{detail.price | number:0}}</td>
                                    <td>{{detail.quantity * detail.price | number:0}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>{{transaction.shipping_fee | number:0}}</td>
                    <td>{{transaction.total | number:0}}</td>
                    <td>
                        <button type="button" ng-click="updateTransaction(transaction)" class="btn btn-success" ng-if="transaction.status_id < status.length"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
                        <button type="button" ng-click="removeTransaction(transaction)" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>