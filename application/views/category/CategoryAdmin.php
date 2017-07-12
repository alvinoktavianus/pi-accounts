<?php if ($this->session->flashdata('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $this->session->flashdata('errors'); ?></strong>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-xs-12">
        <h2 class="text-center">Add new category</h2>
    </div>

    <div class="col-xs-12 col-md-6">
        <?php echo form_open(base_url('categories/do_add'), array('name' => 'categoryForm', 'novalidate' => 'true')); ?>
            <div class="form-group" ng-class="{ 'has-error' : categoryForm.categoryName.$invalid && !categoryForm.categoryName.$pristine, 'has-success': categoryForm.categoryName.$valid }">
                <?php echo form_label('Category Name', 'categoryName', array('class' => 'sr-only')); ?>
                <?php echo form_input(array('type' => 'text', 'class' => 'form-control', 'id' => 'categoryName', 'name' => 'categoryName', 'ng-required' => true, 'ng-model' => 'category.categoryName', 'placeholder' => 'Category Name', 'ng-maxlength' => '20', 'ng-minlength' => '5')); ?>
                <span ng-show="!categoryForm.categoryName.$pristine && categoryForm.categoryName.$error.required" class="help-block" ng-cloak>Please enter category</span>
                <span ng-show="!categoryForm.categoryName.$pristine && categoryForm.categoryName.$error.minlength" class="help-block" ng-cloak>Minimum character is 5</span>
                <span ng-show="!categoryForm.categoryName.$pristine && categoryForm.categoryName.$error.maxlength" class="help-block" ng-cloak>Maximum character is 20</span>
            </div>

            <div class="form-group">
                <button ng-disabled="categoryForm.$invalid" class="btn" ng-class="{'btn-success': categoryForm.$valid, 'btn-danger': categoryForm.$invalid}">Add</button>
            </div>
        <?php echo form_close(); ?>        
    </div>
</div>


<?php if (empty($categories)): ?>
    <h4>No categories</h4>
<?php else: ?>

<?php endif; ?>