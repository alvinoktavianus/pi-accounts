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
            echo link_tag(base_url('assets/css/vendor-less.css')) . link_tag(base_url('assets/css/vendor-css.css')) . link_tag(base_url('assets/css/sb-admin-2.css'));
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
                        <h3 class="panel-title">Please enter your new password</h3>
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

<?php echo form_open(base_url('reset_password/update').'?reset_token='.$resetToken, array('name' => 'newPasswordForm', 'novalidate' => 'true', )); ?>
    <fieldset>


        <div class="form-group" ng-class="{ 'has-error' : newPasswordForm.newPassword.$invalid && !newPasswordForm.newPassword.$pristine, 'has-success': newPasswordForm.newPassword.$valid }">
            <?php
                $inputForm = array(
                    'ng-model' => 'regis.password',
                    'ng-required' => true, 'ng-minlength' => 6,
                    'class' => 'form-control', 'placeholder' => 'Password'
                );
                echo form_password('newPassword', '', $inputForm);
            ?>
            <span ng-show="!newPasswordForm.newPassword.$pristine && (newPasswordForm.newPassword.$error.required || newPasswordForm.newPassword.$error.minlength)" class="help-block" ng-cloak>Please enter your password with 6 characters minimal</span>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : newPasswordForm.newConfirmPassword.$invalid && !newPasswordForm.newConfirmPassword.$pristine, 'has-success': newPasswordForm.newConfirmPassword.$valid }">
            <?php
                $inputForm = array(
                    'ng-model' => 'regis.confirmpassword',
                    'ng-required' => true, 'ng-minlength' => 6, 'class' => 'form-control',
                    'placeholder' => 'Confirm password', 'match-password' => "regis.password"
                );
                echo form_password('newConfirmPassword', '', $inputForm);
            ?>
            <span ng-show="!newPasswordForm.newConfirmPassword.$pristine && (newPasswordForm.newConfirmPassword.$error.matchPassword || newPasswordForm.newConfirmPassword.$error.minlength)" class="help-block" ng-cloak>Please enter your password again</span>
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block" ng-disabled="newPasswordForm.$invalid" ng-cloak>
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
