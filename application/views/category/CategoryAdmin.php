<div ng-controller="CategoriesAdminCtrl">

    <div class="alert alert-success" ng-show="responses.showNotif" ng-cloak>
        <strong>{{responses.message}}</strong>
    </div>

    <div ng-if="isLoading"><h3>Loading...</h3></div>

    <div class="row" ng-if="!isLoading" ng-cloak>
        <div class="col-xs-12">
            <h2 class="text-center">Add new category</h2>
        </div>

        <div class="col-xs-12 col-md-6">
            <form name="categoryForm" novalidate="true" ng-submit="addNewCategory(categoryForm)">
                <div class="form-group" ng-class="{ 'has-error' : categoryForm.categoryName.$invalid && !categoryForm.categoryName.$pristine, 'has-success': categoryForm.categoryName.$valid }">
                    <label class="sr-only">Category Name</label>
                    <input type="text" name="categoryName" class="form-control" ng-required="true" ng-maxlength="20" placeholder="Category Name" ng-model="category.name">
                    <span ng-show="!categoryForm.categoryName.$pristine && categoryForm.categoryName.$error.required" class="help-block" ng-cloak>Please enter category</span>
                    <span ng-show="!categoryForm.categoryName.$pristine && categoryForm.categoryName.$error.minlength" class="help-block" ng-cloak>Minimum character is 5</span>
                    <span ng-show="!categoryForm.categoryName.$pristine && categoryForm.categoryName.$error.maxlength" class="help-block" ng-cloak>Maximum character is 20</span>
                </div>

                <div class="form-group">
                    <input type="submit" value="Add" ng-disabled="categoryForm.$invalid" class="btn" ng-class="{'btn-success': categoryForm.$valid, 'btn-danger': categoryForm.$invalid}" ng-cloak />
                </div>
            </form>
        </div>

<?php if ($this->input->server('CI_ENV') == 'development'): ?>
    <div class="col-xs-12" ng-cloak>
        <pre><code>{{category | json}}</code></pre>
    </div>
<?php endif; ?>

        <div class="col-xs-12">
            <div ng-if="categories.length == 0" ng-cloak><h3>No data to display</h3></div>

            <div ng-if="categories.length > 0" ng-cloak>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="category in categories track by $index">
                            <td>{{$index+1}}</td>
                            <td>{{category.name}}</td>
                            <td><button type="button" class="btn btn-danger" ng-click="removeCategory(category.id)"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>