<div ng-controller="HomeUserCtrl">

    <h3 ng-if="transactions.length == 0">Loading...</h3>

    <div class="table-responsive" ng-if="transactions.length > 0" ng-cloak>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th rowspan="2" style="vertical-align: middle;">#</th>
                    <th rowspan="2" style="vertical-align: middle;">Invoice No.</th>
                    <th colspan="{{transactions.length}}" style="text-align: center;">Status</th>
                </tr>
                <tr>
                    <th ng-repeat="s in status" style="text-align: center;">{{s.description}}</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="transaction in transactions track by $index">
                    <td>{{$index+1}}</td>
                    <td><a href="<?php echo base_url('transactions'); ?>?invoice_no={{transaction.invoice_no}}">{{transaction.invoice_no}}</a></td>
                    <td ng-repeat="s in status" style="text-align: center;">
                        <input type="checkbox" ng-checked="s.id <= transaction.status_id" disabled readonly>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>