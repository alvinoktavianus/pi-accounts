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
    <title>Reset Your Password | PRO Importir</title>
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
                <p class="text-center top-10percent"><img src="https://www.proimportir.com/wp-content/uploads/2017/08/apps-logo.png" class="img-logo"></p>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please enter your email address to reset your password</h3>
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

<?php echo form_open(base_url('reset_password/submit'), array('name' => 'resetForm', 'novalidate' => 'true', )); ?>
    <fieldset>

        <div class="form-group" ng-class="{ 'has-error' : resetForm.currentEmail.$invalid && !resetForm.currentEmail.$pristine, 'has-success': resetForm.currentEmail.$valid }">
            <?php
                $inputForm = array(
                    'type' => 'email', 'id' => 'email', 'name' => 'currentEmail',
                    'ng-required' => true, 'ng-model' => 'regis.email',
                    'ng-pattern' => '/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/',
                    'class' => 'form-control', 'placeholder' => 'E-mail address'
                );
                echo form_input($inputForm);
            ?>
            <span ng-show="!resetForm.currentEmail.$pristine && (resetForm.currentEmail.$error.required || resetForm.currentEmail.$error.pattern)" class="help-block" ng-cloak>Please enter your email address</span>
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block" ng-disabled="resetForm.$invalid" ng-cloak>
            Reset Password
        </button>
        
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

</body>
</html>
