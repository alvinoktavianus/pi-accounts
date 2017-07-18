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
            echo link_tag(base_url('assets/css/vendor.css')) . link_tag(base_url('assets/css/application.css'));
        } else if ($this->input->server('CI_ENV') == 'production') {
            echo link_tag(base_url('assets/css/vendor.min.css')) . link_tag(base_url('assets/css/application.min.css'));
        }
    ?>
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
                <a class="navbar-brand" href="<?php if ($this->session->userdata('user_session')) { echo base_url(); } else { echo base_url('login'); } ?>">Pro Importir</a>
            </div>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="nav navbar-nav">
                    <?php if ($this->session->userdata('user_session')): ?>
                        <li class="<?php if ($pageKey == 'home') echo "active"; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <?php if ($this->session->userdata('user_session')['role'] == 'admin'): ?>
                            <li class="<?php if ($pageKey == 'category') echo "active"; ?>"><a href="<?php echo base_url('categories'); ?>">Categories</a></li>
                            <li class="<?php if ($pageKey == 'gallery') echo "active"; ?>"><a href="<?php echo base_url('galleries'); ?>">Galleries</a></li>
                            <li class="<?php if ($pageKey == 'employee') echo "active"; ?>"><a href="<?php echo base_url('employees'); ?>">Employees</a></li>
                        <?php elseif ($this->session->userdata('user_session')['role'] == 'user'): ?>
                        <?php endif; ?>
                    <?php elseif (!$this->session->userdata('user_session')): ?>
                        <li class="<?php if ($pageKey == 'gallery') echo "active"; ?>"><a href="<?php echo base_url("galleries") ?>">Galleries</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('user_session')): ?>
                        <li class="<?php if ($pageKey == 'profile') echo "active"; ?>"><a href="<?php echo base_url('profile'); ?>"><?php echo $this->session->userdata('user_session')['first_name']; ?></a></li>
                        <li><a href="<?php echo base_url("logout") ?>">Logout</a></li>
                    <?php elseif (!$this->session->userdata('user_session')): ?>
                        <li class="<?php if ($pageKey == 'register') echo "active"; ?>"><a href="<?php echo base_url("register") ?>">Register</a></li>
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
                switch ($pageKey) {
                    case 'login':
                        $this->load->view('login/login');
                        break;
                    case 'register':
                        $this->load->view('register/register');
                        break;
                    case 'gallery':
                        $this->load->view('gallery/GalleryGuest', $viewData);
                        break;
                }
            } else {
                // Render UI if users already logged in
                switch ($this->session->userdata('user_session')['role']) {
                    case 'admin':
                        // Handle UI for admin case
                        switch ($pageKey) {
                            case 'home':
                                $this->load->view('home/HomeAdmin');
                                break;
                            case 'category':
                                $this->load->view('category/CategoryAdmin', $viewData);
                                break;
                            case 'gallery':
                                $this->load->view('gallery/GalleryAdmin', $viewData);
                                break;
                            case 'employee':
                                $this->load->view('home/EmployeeAdmin');
                                break;
                            case 'profile':
                                $this->load->view('profile/ProfileUser', $viewData);
                                break;
                        }
                        break;
                    case 'user':
                        // Handle UI for user case
                        switch ($pageKey) {
                            case 'home':
                                $this->load->view('home/HomeUser');
                                break;
                            case 'gallery':
                                $this->load->view('gallery/GalleryUser', $viewData);
                                break;
                            case 'profile':
                                $this->load->view('profile/ProfileUser', $viewData);
                                break;
                        }
                        break;
                }
            }
        ?>
    </div>

    <?php if ($this->input->server('CI_ENV') == 'development') : ?>
        <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.js"); ?>"></script>
        <script type="text/javascript">
            var app = angular.module('piAccounts', ['dynamicNumber'])
        </script>  
        <script type="text/javascript" src="<?php echo base_url("assets/js/application.js"); ?>"></script>
    <?php elseif ($this->input->server('CI_ENV') == 'production') : ?>
        <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.min.js"); ?>"></script>
        <script type="text/javascript">
            var app = angular.module('piAccounts', ['dynamicNumber'])
        </script>  
        <script type="text/javascript" src="<?php echo base_url("assets/js/application.min.js"); ?>"></script>
    <?php endif; ?>

</body>
</html>