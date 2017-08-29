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
                'content' => 'PRO Importir menyederhanakan proses import barang menjadi sangat mudah'
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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">PRO Importir</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('user_session')['first_name']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="<?php if ($pageKey == 'profile') echo "active"; ?>"><a href="<?php echo base_url('profile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url("logout") ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url() ?>" class="<?php if ($pageKey == 'home') echo "active"; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php if ($this->session->userdata('user_session')): ?>
                            <?php if ($this->session->userdata('user_session')['role'] == 'admin'): ?>
                                <li>
                                    <a href="<?php echo base_url('categories'); ?>" class="<?php if ($pageKey == 'category') echo "active"; ?>"><i class="fa fa-folder-o fa-fw" aria-hidden="true"></i> Categories</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("galleries") ?>" class="<?php if ($pageKey == 'gallery') echo "active"; ?>"><i class="fa fa-picture-o fa-fw"></i> Galleries</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('transactions'); ?>" class="<?php if ($pageKey == 'transaction') echo "active"; ?>"><i class="fa fa-credit-card-o fa-fw" aria-hidden="true"></i> Transaction</a>
                                </li>
                            <?php elseif ($this->session->userdata('user_session')['role'] == 'user'): ?>
                        <li>
                            <a href="<?php echo base_url("galleries") ?>" class="<?php if ($pageKey == 'gallery') echo "active"; ?>"><i class="fa fa-picture-o fa-fw"></i> Galleries</a>
                        </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $pageTitle ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                    <?php
                        switch ($this->session->userdata('user_session')['role']) {
                            case 'admin':
                                // Handle UI for admin case
                                switch ($pageKey) {
                                    case 'home':
                                        $this->load->view('home/HomeAdmin');
                                        break;
                                    case 'category':
                                        $this->load->view('category/CategoryAdmin');
                                        break;
                                    case 'gallery':
                                        $this->load->view('gallery/GalleryAdmin', $viewData);
                                        break;
                                    case 'transaction':
                                        $this->load->view('transaction/TransactionAdmin', $viewData);
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
                                    case 'transaction':
                                        $this->load->view('transaction/TransactionUser', $viewData);
                                        break;
                                    case 'profile':
                                        $this->load->view('profile/ProfileUser', $viewData);
                                        break;
                                }
                                break;
                        }
                    ?>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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