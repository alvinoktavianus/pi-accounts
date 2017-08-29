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
                        <h3 class="panel-title">Please Sign In</h3>
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

<?php echo form_open(base_url('login/do_login'), array('name' => 'loginForm', 'novalidate' => 'true', 'role' => 'form')); ?>
    <fieldset> 
        <div class="form-group" ng-class="{ 'has-error' : loginForm.email.$invalid && !loginForm.email.$pristine, 'has-success': loginForm.email.$valid }">
            <?php
                $inputForm = array(
                    'type' => 'email', 'id' => 'email', 'name' => 'email',
                    'ng-required' => true, 'ng-model' => 'login.email',
                    'ng-pattern' => '/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/',
                    'placeholder' => 'E-mail', 'autofocus' => true, 'class' => 'form-control'
                );
                echo form_input($inputForm);
            ?>
            <span ng-show="!loginForm.email.$pristine && (loginForm.email.$error.required || loginForm.email.$error.pattern)" class="help-block" ng-cloak>Please enter your email address</span>  
        </div>

        <div class="form-group" ng-class="{ 'has-error' : loginForm.password.$invalid && !loginForm.password.$pristine, 'has-success': loginForm.password.$valid }"> 
            <?php
                $inputForm = array(
                    'name' => 'password', 'ng-model' => 'login.password', 'placeholder' => 'Password',
                    'ng-required' => true, 'ng-minlength' => 6, 'class' => 'form-control'
                );
                echo form_password('password', '', $inputForm);
            ?>
            <span ng-show="!loginForm.password.$pristine && (loginForm.password.$error.required || loginForm.password.$error.minlength)" class="help-block" ng-cloak>Please enter your password</span>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block" ng-disabled="loginForm.$invalid" ng-cloak>
            Login
        </button>
    </fieldset>
<?php echo form_close(); ?>

<a href="<?php echo base_url('register') ?>" class="btn btn-lg btn-primary btn-block" style="margin-top: 10px;">Register</a>

<div class="row" style="margin-top: 10px;">
    <div class="col-sm-6">
        <a href="<?php echo base_url('resend_verification') ?>" class="btn btn-link btn-block">Resend Verification</a>
    </div>
    <div class="col-sm-6">
        <a href="<?php echo base_url('reset_password') ?>" class="btn btn-link btn-block">Forgot Password</a>
    </div>
</div>

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

</body>
</html>