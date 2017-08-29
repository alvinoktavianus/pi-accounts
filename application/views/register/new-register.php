<?php echo doctype('html5'); ?>
<html lang="en" ng-app="piAccounts">
<head>
    <?php
        $meta = array(
            array(
                'name' => 'Content-type',
                'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
            ),
            array(
                'name' => 'keywords',
                'content' => 'proimportir, import, mudah'
            ),
            array(
                'name' => 'description',
                'content' => 'Pro Importir menyederhanakan proses import barang menjadi sangat mudah'
            ),
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1, user-scalable=0'
            )
        );
        echo meta($meta);
    ?>
    <title><?php echo $title; ?></title>
    <?php
        if ($this->input->server('CI_ENV') == 'development') {
            echo link_tag(base_url('assets/css/vendor-less.css')) . link_tag(base_url('assets/css/vendor-css.css')) . link_tag(base_url('assets/css/sb-admin-2.css')) . link_tag(base_url('assets/css/application.css'));
        } else if ($this->input->server('CI_ENV') == 'production') {
            echo link_tag(base_url('assets/css/vendor.min.css')) . link_tag(base_url('assets/css/application.min.css'));
        }
    ?>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register to PRO Importir</h3>
                    </div>
                    <div class="panel-body">

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $this->session->flashdata('errors'); ?></strong>
    </div>
<?php endif; ?>

<?php echo form_open(base_url('register/do_register'), array('name' => 'regisForm', 'novalidate' => 'true', )); ?>
    <fieldset>

        <div class="form-group" ng-class="{ 'has-error' : regisForm.email.$invalid && !regisForm.email.$pristine, 'has-success': regisForm.email.$valid }">
            <?php
                $inputForm = array(
                    'type' => 'email', 'id' => 'email', 'name' => 'email',
                    'ng-required' => true, 'ng-model' => 'regis.email',
                    'ng-pattern' => '/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/',
                    'class' => 'form-control', 'placeholder' => 'E-mail address'
                );
                echo form_input($inputForm);
            ?>
            <span ng-show="!regisForm.email.$pristine && (regisForm.email.$error.required || regisForm.email.$error.pattern)" class="help-block" ng-cloak>Please enter your email address</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : regisForm.first_name.$invalid && !regisForm.first_name.$pristine, 'has-success': regisForm.first_name.$valid }">
            <?php
                $inputForm = array(
                    'type' => 'text', 'id' => 'first_name',
                    'name' => 'first_name', 'ng-required' => true,
                    'ng-model' => 'regis.first_name', 'class' => 'form-control',
                    'placeholder' => 'First mame'
                );
                echo form_input($inputForm);
            ?>
            <span ng-show="!regisForm.first_name.$pristine && (regisForm.first_name.$error.required || regisForm.first_name.$error.pattern)" class="help-block" ng-cloak>Please enter your first name</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : regisForm.last_name.$invalid && !regisForm.last_name.$pristine, 'has-success': regisForm.last_name.$valid }">
            <?php
                $inputForm = array(
                    'type' => 'text', 'id' => 'last_name',
                    'name' => 'last_name', 'ng-required' => true,
                    'ng-model' => 'regis.last_name', 'class' => 'form-control',
                    'placeholder' => 'Last name'
                );
                echo form_input($inputForm);
            ?>
            <span ng-show="!regisForm.last_name.$pristine && regisForm.last_name.$error.required" class="help-block" ng-cloak>Please enter your last name</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : regisForm.nohp.$invalid && !regisForm.nohp.$pristine, 'has-success': regisForm.nohp.$valid }">
            <?php
                $inputForm = array(
                    'type' => 'number', 'id' => 'nohp',
                    'name' => 'nohp', 'ng-required' => true,
                    'ng-model' => 'regis.nohp', 'class' => 'form-control',
                    'placeholder' => 'Phone no.'
                );
                echo form_input($inputForm);
            ?>
            <span ng-show="!regisForm.nohp.$pristine && regisForm.nohp.$error.required" class="help-block" ng-cloak>Please enter your phone number</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : regisForm.password.$invalid && !regisForm.password.$pristine, 'has-success': regisForm.password.$valid }">
            <?php
                $inputForm = array(
                    'name' => 'password', 'ng-model' => 'regis.password',
                    'ng-required' => true, 'ng-minlength' => 6,
                    'class' => 'form-control', 'placeholder' => 'Password'
                );
                echo form_password('password', '', $inputForm);
            ?>
            <span ng-show="!regisForm.password.$pristine && (regisForm.password.$error.required || regisForm.password.$error.minlength)" class="help-block" ng-cloak>Please enter your password with 6 characters minimal</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : regisForm.confirmpassword.$invalid && !regisForm.confirmpassword.$pristine, 'has-success': regisForm.confirmpassword.$valid }">
            <?php
                $inputForm = array(
                    'name' => 'confirmpassword', 'ng-model' => 'regis.confirmpassword',
                    'ng-required' => true, 'ng-minlength' => 6, 'class' => 'form-control',
                    'placeholder' => 'Confirm password', 'match-password' => "regis.password"
                );
                echo form_password('confirmpassword', '', $inputForm);
            ?>
            <span ng-show="!regisForm.confirmpassword.$pristine && (regisForm.confirmpassword.$error.matchPassword || regisForm.confirmpassword.$error.minlength)" class="help-block" ng-cloak>Please enter your password again</span>
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block" ng-disabled="regisForm.$invalid" ng-cloak>
            Register
        </button>

        <a href="<?php echo base_url('login') ?>" class="btn btn-link btn-block">
            Login
        </a>
        
    </fieldset>
<?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->input->server('CI_ENV') == 'development') : ?>
        <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.js"); ?>"></script>
        <script type="text/javascript">
            var app = angular.module('piAccounts', ['dynamicNumber', 'ui.select', 'ngSanitize']);
            var baseUrl = '<?php echo $this->input->server('HOST_URL'); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/application.js"); ?>"></script>
    <?php elseif ($this->input->server('CI_ENV') == 'production') : ?>
        <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.min.js"); ?>"></script>
        <script type="text/javascript">
            var app = angular.module('piAccounts', ['dynamicNumber', 'ui.select', 'ngSanitize']);
            var baseUrl = '<?php echo $this->input->server('HOST_URL'); ?>';
        </script>  
        <script type="text/javascript" src="<?php echo base_url("assets/js/application.min.js"); ?>"></script>
    <?php endif; ?>

<script type="text/javascript">
    app.directive("matchPassword", function () {
        return {
            require: "ngModel",
            scope: {
                otherModelValue: "=matchPassword"
            },
            link: function(scope, element, attributes, ngModel) {

                ngModel.$validators.matchPassword = function(modelValue) {
                    return modelValue == scope.otherModelValue;
                };

                scope.$watch("otherModelValue", function() {
                    ngModel.$validate();
                });
            }
        };
    });
</script>

</body>
</html>