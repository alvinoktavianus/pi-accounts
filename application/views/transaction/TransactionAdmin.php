<div ng-controller="TransactionCtrl">
    <form name="transForm" novalidate="true" ng-submit="submitForm()" id="transformadmin">
        <div class="form-group">
          <ui-select ng-model="transaction.selected" theme="bootstrap">
            <ui-select-match placeholder="Select or search with email...">{{$select.selected.email}}</ui-select-match>
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
                            <input type="number" ng-model="item.qty" class="form-control" ng-change="calcTotalPrice()">
                        </td>
                        <td>
                            <input type="number" ng-model="item.price" class="form-control" ng-change="calcTotalPrice()">
                        </td>
                        <td style="width: 80px;border: 0">
                            <button type="button" ng-click="removeItem(item)" ng-show="$index > 0" class="btn btn-danger" ng-cloak>Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center"><button ng-click="addItem(item)" class="btn btn-success">Add Item</button></td>
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