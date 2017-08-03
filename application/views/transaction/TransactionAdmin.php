<div ng-controller="TransactionCtrl">

    <div class="alert alert-success" ng-show="responses.showNotif" ng-cloak ng-class="{'alert-success': responses.isSuccess, 'alert-danger': !responses.isSuccess}">
        <strong>{{responses.message}}</strong>
    </div>

    <form name="transForm" novalidate="true" ng-submit="submitForm()" id="transformadmin">
        <div class="form-group">
          <ui-select ng-model="transaction.selected" theme="bootstrap" ng-disabled="!isSelectable">
            <ui-select-match placeholder="{{uiSelectPlaceholder}}">{{$select.selected.email}}</ui-select-match>
            <ui-select-choices repeat="item in users | filter: $select.search">
              <div ng-bind-html="item.email | highlight: $select.search"></div>
              <small ng-bind-html="item.first_name | highlight: $select.search"></small>
              <small ng-bind-html="item.last_name | highlight: $select.search"></small>
            </ui-select-choices>
          </ui-select>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" readonly class="form-control" value="{{transaction.selected.first_name + ' ' + transaction.selected.last_name}}" placeholder="Full Name">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" style="resize: vertical;height: 120px;" readonly>{{transaction.selected.address}}</textarea>
        </div>

        
        <div>
            <table class="table-responsive table transadmtbl">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Product Name</th>
                        <th class="qtytransadm">Qty</th>
                        <th class="text-center pricetransadm">Price</th>
                        <th style="border: 0"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in transaction.items track by $index">
                        <td class="text-center">{{$index+1}}</td>
                        <td>
                            <input type="text" ng-model="item.name" class="form-control">
                        </td>
                        <td>
                            <input type="text" class="form-control" ng-model="item.qty" awnum num-int="11" num-fract="0" num-neg="false" num-sep="," num-thousand="true" num-thousand-sep="{{' '}}" ng-required="true" ng-change="calcTotalPrice()">
                        </td>
                        <td>
                            <input type="text" class="form-control" ng-model="item.price" awnum num-int="11" num-fract="0" num-neg="false" num-sep="," num-thousand="true" num-thousand-sep="{{' '}}" ng-required="true" ng-change="calcTotalPrice()">
                        </td>
                        <td style="width: 80px;border: 0">
                            <button type="button" ng-click="removeItem(item)" ng-show="$index > 0" class="btn btn-danger" ng-cloak>Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center"><button ng-click="addItem(item)" class="btn btn-success" type="button">Add Item</button></td>
                        <td style="text-align: right;vertical-align: middle;"><strong>SHIPPING FEE</strong></td>
                        <td><input type="number" ng-model="transaction.shipping_fee" class="form-control" ng-change="calcTotalPrice()" min="0"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;vertical-align: middle;"><strong>GRAND TOTAL</strong></td>
                        <td><input type="text" class="form-control" readonly value="{{transaction.total_price | number: 0}}"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>

    </form>

    <?php if ($this->input->server('CI_ENV') == 'development') : ?>
        <pre><code>{{transaction | json}}</code></pre>
    <?php endif; ?>
</div>