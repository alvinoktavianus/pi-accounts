<div ng-controller="TransactionCtrl">
    <form name="transForm" novalidate="true" ng-submit="submitForm()">

        <div class="form-group">
          <ui-select ng-model="transaction.selected" theme="bootstrap">
            <ui-select-match placeholder="Select or search a person in the list...">{{$select.selected.email}}</ui-select-match>
            <ui-select-choices repeat="item in users | filter: $select.search">
              <div ng-bind-html="item.email | highlight: $select.search"></div>
              <small ng-bind-html="item.first_name | highlight: $select.search"></small>
              <small ng-bind-html="item.last_name | highlight: $select.search"></small>
            </ui-select-choices>
          </ui-select>
        </div>

        <div class="form-group">
            <label class="sr-only">Full Name</label>
            <input type="text" readonly="true" class="form-control" value="{{transaction.selected.first_name + ' ' + transaction.selected.last_name}}" placeholder="Full Name">
        </div>

        <div class="form-group">
            <label class="sr-only">Address</label>
            <textarea class="form-control" style="resize: vertical;" readonly="true">{{transaction.selected.address}}</textarea>
        </div>

        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in transaction.items track by $index">
                        <td>{{$index+1}}</td>
                        <td>
                            <input type="text" ng-model="item.name" class="form-control">
                        </td>
                        <td>
                            <input type="number" ng-model="item.qty" class="form-control" ng-change="calcTotalPrice()">
                        </td>
                        <td>
                            <input type="number" ng-model="item.price" class="form-control" ng-change="calcTotalPrice()">
                        </td>
                        <td>
                            <button ng-click="addItem(item)" class="btn btn-success">Add Item</button>
                            <button ng-click="removeItem(item)" ng-show="$index > 0" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Shipping Fee</td>
                        <td><input type="number" ng-model="transaction.shipping_fee" class="form-control" ng-change="calcTotalPrice()" min="0"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">Total Price</td>
                        <td><strong>{{transaction.total_price | number: 0}}</strong></td>
                        <td></td>
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
