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
<div class="divgaladmin">
<?php echo form_open_multipart(base_url('galleries/do_add'), array('name' => 'galleryForm', 'novalidate' => 'true')); ?>

<fieldset>
    <legend>Add Product to Gallery</legend>

    <div class="form-group" ng-class="{ 'has-error' : galleryForm.name.$invalid && !galleryForm.name.$pristine, 'has-success': galleryForm.name.$valid }">
        <?php echo form_label('Name', 'name', array('class' => 'sr-only')); ?>
        <?php echo form_input('name', '', array('class' => 'form-control', 'ng-required' => true, 'ng-model' => 'gallery.name', 'placeholder' => 'Name')); ?>
        <span ng-show="!galleryForm.name.$pristine && galleryForm.name.$error.required" class="help-block" ng-cloak>Please enter valid product name</span>
    </div>

    <div class="form-group" ng-class="{ 'has-error' : galleryForm.baseprice.$invalid && !galleryForm.baseprice.$pristine, 'has-success': galleryForm.baseprice.$valid }">
        <?php echo form_label('Base Price', 'baseprice', array('class' => 'sr-only')); ?>
        <input type="text" class="form-control" placeholder="Base Price" ng-model="gallery.basePrice" name="baseprice" awnum num-int="11" num-fract="0" num-neg="false" num-sep="," num-thousand="true" num-thousand-sep="{{' '}}" ng-required="true">
        <span ng-show="!galleryForm.baseprice.$pristine && galleryForm.baseprice.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
    </div>

    <div class="form-group" ng-class="{ 'has-error' : galleryForm.sellprice.$invalid && !galleryForm.sellprice.$pristine, 'has-success': galleryForm.sellprice.$valid }">
        <?php echo form_label('Sell Price', 'sellprice', array('class' => 'sr-only')); ?>
        <input type="text" awnum ng-model="gallery.sellPrice" ng-required="true" class="form-control" placeholder="Sell Price" num-fract="0" num-thousand="true" num-thousand-sep="{{' '}}" num-int="9" name="sellprice" />
        <span ng-show="!galleryForm.sellprice.$pristine && galleryForm.sellprice.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
    </div>

    <div class="form-group" ng-class="{ 'has-error' : galleryForm.categories.$invalid && !galleryForm.categories.$pristine, 'has-success': galleryForm.categories.$valid }">
        <?php echo form_label('Categories', 'categories', array('class' => 'sr-only')); ?>
        <?php echo form_dropdown('categories', $categories, '0', array('class' => 'form-control', 'ng-required' => "true", "name" => "categories", 'ng-model' => 'gallery.category')); ?>
        <span ng-show="!galleryForm.categories.$pristine && galleryForm.categories.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
    </div><br>
</fieldset>

<fieldset>
    <legend>Upload Image</legend>

    <div class="form-group">
        <?php echo form_label('Image', 'image', array('class' => 'sr-only')); ?>
        <input type="file" name="image" class="form-control">
    </div>

</fieldset>

<div class="form-group">
    <br>
    <button ng-disabled="galleryForm.$invalid" class="btn btn-lg" ng-class="{'btn-success': galleryForm.$valid, 'btn-danger': galleryForm.$invalid}" ng-cloack>Add Product</button>
</div>

<?php echo form_close(); ?>
    
</div>