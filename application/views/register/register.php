<?php if ($this->session->flashdata('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $this->session->flashdata('errors'); ?></strong>
    </div>
<?php endif; ?>

<div class="logindiv">
<?php echo form_open(base_url('register/do_register'), array('name' => 'regisForm', 'novalidate' => 'true', 'class' => 'regisformcss')); ?>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : regisForm.email.$invalid && !regisForm.email.$pristine, 'has-success': regisForm.email.$valid }">
            <?php echo form_input(array('type' => 'email', 'id' => 'email', 'name' => 'email', 'ng-required' => true, 'ng-model' => 'regis.email', 'ng-pattern' => '/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/')); ?>
            <span class="highlight"></span><span class="bar"></span>
            <label>Email</label>
            <span ng-show="!regisForm.email.$pristine && (regisForm.email.$error.required || regisForm.email.$error.pattern)" class="help-block" ng-cloak>Please enter your email address</span>
        </div>
    </div>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : regisForm.first_name.$invalid && !regisForm.first_name.$pristine, 'has-success': regisForm.first_name.$valid }">
            <?php echo form_input(array('type' => 'text', 'id' => 'first_name', 'name' => 'first_name', 'ng-required' => true, 'ng-model' => 'regis.first_name')); ?>
            <span class="highlight"></span><span class="bar"></span>
            <label>First Name</label>
            <span ng-show="!regisForm.first_name.$pristine && (regisForm.first_name.$error.required || regisForm.first_name.$error.pattern)" class="help-block" ng-cloak>Please enter your first name</span>
        </div>
    </div>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : regisForm.last_name.$invalid && !regisForm.last_name.$pristine, 'has-success': regisForm.last_name.$valid }">
            <?php echo form_input(array('type' => 'text', 'id' => 'last_name', 'name' => 'last_name', 'ng-required' => true, 'ng-model' => 'regis.last_name')); ?>
            <span class="highlight"></span><span class="bar"></span>
            <label>Last Name</label>
            <span ng-show="!regisForm.last_name.$pristine && regisForm.last_name.$error.required" class="help-block" ng-cloak>Please enter your last name</span>
        </div>
    </div>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : regisForm.nohp.$invalid && !regisForm.nohp.$pristine, 'has-success': regisForm.nohp.$valid }">
            <?php echo form_input(array('type' => 'number', 'id' => 'nohp', 'name' => 'nohp', 'ng-required' => true, 'ng-model' => 'regis.nohp')); ?>
            <span class="highlight"></span><span class="bar"></span>
            <label>Phone Number</label>
            <span ng-show="!regisForm.nohp.$pristine && regisForm.nohp.$error.required" class="help-block" ng-cloak>Please enter your phone number</span>
        </div>
    </div>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : regisForm.password.$invalid && !regisForm.password.$pristine, 'has-success': regisForm.password.$valid }">
            <?php echo form_password('password', '', array('name' => 'password', 'ng-model' => 'regis.password', 'ng-required' => true, 'ng-minlength' => 6)); ?>
            <span class="highlight"></span><span class="bar"></span>
           <label>Password</label>
            <span ng-show="!regisForm.password.$pristine && (regisForm.password.$error.required || regisForm.password.$error.minlength)" class="help-block" ng-cloak>Please enter your password</span>
        </div>
    </div>

    <div class="group">
        <div class="form-group" ng-class="{ 'has-error' : regisForm.confirmpassword.$invalid && !regisForm.confirmpassword.$pristine, 'has-success': regisForm.confirmpassword.$valid }">
            <?php echo form_password('confirmpassword', '', array('name' => 'confirmpassword', 'ng-model' => 'regis.confirmpassword', 'ng-required' => true, 'ng-minlength' => 6)); ?>
            <span class="highlight"></span><span class="bar"></span>
           <label>Confirm Password</label>
            <span ng-show="!regisForm.confirmpassword.$pristine && (regisForm.confirmpassword.$error.required || regisForm.confirmpassword.$error.minlength)" class="help-block" ng-cloak>Please enter your password again</span>
        </div>
    </div>

    <button type="submit" class="button buttonGreen" ng-disabled="regisForm.$invalid" ng-cloak>REGISTER
        <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
    </button>


    <a href="<?php echo base_url('login'); ?>"><button type="button" class="button buttonBlue" ng-cloak>LOGIN
        <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
    </button></a>

<?php echo form_close(); ?>
</div>