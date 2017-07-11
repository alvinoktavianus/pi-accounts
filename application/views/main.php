<!DOCTYPE html>
<html lang="en" ng-app="piAccounts">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title><?php echo $title; ?></title>
    <?php if ($this->input->server('CI_ENV') == 'development') : ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/vendor.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/application.css"); ?>">
    <?php elseif ($this->input->server('CI_ENV') == 'production') : ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/vendor.min.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/application.min.css"); ?>">
    <?php endif; ?>
</head>
<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php if ($this->session->userdata('user_session')) { echo base_url(); } else { echo base_url('login'); } ?>">PRO Importir</a>
            </div>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="nav navbar-nav">
                    <?php if ($this->session->userdata('user_session')): ?>
                        
                    <?php elseif (!$this->session->userdata('user_session')): ?>
                        <li class="<?php if ($pageKey == 'gallery') echo "active"; ?>"><a href="<?php echo base_url("gallery") ?>">Gallery</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('user_session')): ?>
                        <li><a href="<?php echo base_url("logout") ?>">Logout</a></li>
                    <?php elseif (!$this->session->userdata('user_session')): ?>
                        <li class="<?php if ($pageKey == 'login') echo "active"; ?>"><a href="<?php echo base_url("login") ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
            // This code will handle all of the pages that will be rendered onto application
            if (!$this->session->userdata('user_session')) {
                // Render UI if users have not been logged in
                $this->load->view('login/login');
            } else {
                // Render UI if users already logged in
                switch ($this->session->userdata('user_session')['role']) {
                    case 'admin':
                        // Handle UI for admin case
                        break;
                    case 'user':
                        // Handle UI for user case
                        break;
                }
            }
        ?>
    </div>

    <?php if ($this->input->server('CI_ENV') == 'development') : ?>
        <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.js"); ?>"></script>
        <script type="text/javascript">
            var app = angular.module('piAccounts', [])
        </script>  
        <script type="text/javascript" src="<?php echo base_url("assets/js/application.js"); ?>"></script>
    <?php elseif ($this->input->server('CI_ENV') == 'production') : ?>
        <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.min.js"); ?>"></script>
        <script type="text/javascript">
            var app = angular.module('piAccounts', [])
        </script>  
        <script type="text/javascript" src="<?php echo base_url("assets/js/application.min.js"); ?>"></script>
    <?php endif; ?>

</body>
</html>