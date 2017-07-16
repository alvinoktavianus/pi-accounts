<div ng-controller="GalleryAdminCtrl">

    <form name="galleryForm" novalidate>
        <fieldset>
            <legend>Gallery Data</legend>
            <div class="form-group" ng-class="{ 'has-error' : galleryForm.name.$invalid && !galleryForm.name.$pristine, 'has-success': galleryForm.name.$valid }">
                <?php echo form_label('Name', 'name', array('class' => 'sr-only')); ?>
                <?php echo form_input('name', '', array('class' => 'form-control', 'ng-required' => true, 'ng-model' => 'galleryform.name', 'placeholder' => 'Name')); ?>
                <span ng-show="!galleryForm.name.$pristine && galleryForm.name.$error.required" class="help-block" ng-cloak>Please enter valid product name</span>
            </div>

            <div class="form-group" ng-class="{ 'has-error' : galleryForm.baseprice.$invalid && !galleryForm.baseprice.$pristine, 'has-success': galleryForm.baseprice.$valid }">
                <?php echo form_label('Base Price', 'baseprice', array('class' => 'sr-only')); ?>
                <input type="text" class="form-control" placeholder="Base Price" ng-model="galleryform.basePrice" name="baseprice" awnum num-int="11" num-fract="0" num-neg="false" num-sep="," num-thousand="true" num-thousand-sep="{{' '}}" ng-required="true">
                <span ng-show="!galleryForm.baseprice.$pristine && galleryForm.baseprice.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
            </div>

            <div class="form-group" ng-class="{ 'has-error' : galleryForm.sellprice.$invalid && !galleryForm.sellprice.$pristine, 'has-success': galleryForm.sellprice.$valid }">
                <?php echo form_label('Sell Price', 'sellprice', array('class' => 'sr-only')); ?>
                <input type="text" awnum ng-model="galleryform.sellPrice" ng-required="true" class="form-control" placeholder="Sell Price" num-fract="0" num-thousand="true" num-thousand-sep="{{' '}}" num-int="9" name="sellprice" />
                <span ng-show="!galleryForm.sellprice.$pristine && galleryForm.sellprice.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
            </div>

            <div class="form-group" ng-class="{ 'has-error' : galleryForm.categories.$invalid && !galleryForm.categories.$pristine, 'has-success': galleryForm.categories.$valid }">
                <?php echo form_label('Categories', 'categories', array('class' => 'sr-only')); ?>
                <?php echo form_dropdown('categories', $categories, '0', array('class' => 'form-control', 'ng-required' => "true", "name" => "categories", 'ng-model' => 'galleryform.category')); ?>
                <span ng-show="!galleryForm.categories.$pristine && galleryForm.categories.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
            </div>
        </fieldset>

        <fieldset>
            <legend>Images</legend>
            <div class="form-group">
                    <div class="well my-drop-zone" nv-file-over="" uploader="uploader">Base drop zone</div>
                <br/>
                <ul>
                    <li ng-repeat="item in uploader.queue">
                        Name: <span ng-bind="item.file.name"></span><br/>
                        <button ng-click="item.upload()">Upload</button>
                    </li>
                </ul>   
            </div>
        </fieldset>
    </form>

    <pre ng-cloak><code>{{galleryform | json}}</code></pre>

<!--     <?php if ($this->session->flashdata('errors')): ?>
        <div class="alert alert-danger" role="alert">
            <strong><?php echo $this->session->flashdata('errors'); ?></strong>
        </div>
    <?php endif; ?>

    <?php echo form_open_multipart(base_url('galleries/do_add'), array('name' => 'galleryForm', 'novalidate' => 'true')); ?>

    <fieldset>
        <legend>Gallery Data</legend>

        <div class="form-group" ng-class="{ 'has-error' : galleryForm.name.$invalid && !galleryForm.name.$pristine, 'has-success': galleryForm.name.$valid }">
            <?php echo form_label('Name', 'name', array('class' => 'sr-only')); ?>
            <?php echo form_input('name', '', array('class' => 'form-control', 'ng-required' => true, 'ng-model' => 'gallery.name', 'placeholder' => 'Name')); ?>
            <span ng-show="!galleryForm.name.$pristine && galleryForm.name.$error.required" class="help-block" ng-cloak>Please enter valid product name</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : galleryForm.baseprice.$invalid && !galleryForm.baseprice.$pristine, 'has-success': galleryForm.baseprice.$valid }">
            <?php echo form_label('Base Price', 'baseprice', array('class' => 'sr-only')); ?>
            <input type="text" class="form-control" placeholder="Base Price" ng-model="galleryForm.basePrice" name="baseprice" awnum num-int="11" num-fract="0" num-neg="false" num-sep="," num-thousand="true" num-thousand-sep="{{' '}}" ng-required="true">
            <span ng-show="!galleryForm.baseprice.$pristine && galleryForm.baseprice.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : galleryForm.sellprice.$invalid && !galleryForm.sellprice.$pristine, 'has-success': galleryForm.sellprice.$valid }">
            <?php echo form_label('Sell Price', 'sellprice', array('class' => 'sr-only')); ?>
            <input type="text" awnum ng-model="galleryForm.sellPrice" ng-required="true" class="form-control" placeholder="Sell Price" num-fract="0" num-thousand="true" num-thousand-sep="{{' '}}" num-int="9" name="sellprice" />
            <span ng-show="!galleryForm.sellprice.$pristine && galleryForm.sellprice.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : galleryForm.categories.$invalid && !galleryForm.categories.$pristine, 'has-success': galleryForm.categories.$valid }">
            <?php echo form_label('Categories', 'categories', array('class' => 'sr-only')); ?>
            <?php echo form_dropdown('categories', $categories, '0', array('class' => 'form-control', 'ng-required' => "true", "name" => "categories", 'ng-model' => 'galleryForm.category')); ?>
            <span ng-show="!galleryForm.categories.$pristine && galleryForm.categories.$error.required" class="help-block" ng-cloak>Please enter valid base price</span>
        </div>
    </fieldset>

    <fieldset>
        <legend>Images</legend>

        <div class="form-group">
            <?php echo form_label('Categories', 'categories', array('class' => 'sr-only')); ?>
            <input type="file" name="images[]" multiple class="form-control">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Upload image</th>
                        <th colspan="2">Check if primary image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="image in images track by $index">
                        <td>
                            <input type="file" name="images[]" class="form-control">
                        </td>
                        <td>
                            <input type="checkbox" name="isPrimary[]">
                        </td>
                        <td>
                            <button class="btn btn-success" ng-click="addImage($event)">Add</button>
                            <button class="btn btn-danger" ng-if="$index > 0" ng-cloak ng-click="removeImages($event, image)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </fieldset>

    <div class="form-group">
        <button ng-disabled="galleryForm.$invalid" class="btn" ng-class="{'btn-success': galleryForm.$valid, 'btn-danger': galleryForm.$invalid}" ng-cloack>Add</button>
    </div>

    <?php echo form_close(); ?> -->

</div>