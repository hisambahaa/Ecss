<?php session_start();
require_once __DIR__ .'/../../../Connections/config.php';
 ?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $pageTitle; ?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo $config['base_url'].'admin/template/';?>css/bootstrap.min.css" rel="stylesheet"> 
    <link href="<?php echo $config['base_url'].'admin/template/';?>css/bootstrap-rtl.min.css" rel="stylesheet">

    <link href="<?php echo $config['base_url'].'admin/template/';?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $config['base_url'].'admin/template/';?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo $config['base_url'].'admin/template/';?>css/custom.css" rel="stylesheet">
    <link href="<?php echo $config['base_url'].'admin/template/';?>css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo $config['base_url'].'admin/template/';?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>نظام دارس</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <?php if(!empty($_SESSION['User_photo'])): ?>
                                <img src="images/img.jpg" alt="<?php echo $_SESSION['User_name'] ?>" class="img-circle profile_img">
                            <?php else: ?>
                                <img src="<?php echo $config['base_url']; ?>admin/template/images/img.jpg" alt="<?php echo $_SESSION['User_name'] ?>" class="img-circle profile_img">
                            <?php endif; ?>
                        </div>
                        <div class="profile_info">
                            <span>
                                مرحبا بك
                            </span>
                            <h2>
                                 <?php echo $_SESSION['User_name'] ?>
                            </h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                   <?php require_once __DIR__ . '/sidebar.php'; ?>
                    <!-- /sidebar menu -->

                    
                </div>
            </div>

            <!-- top navigation -->
           <?php require_once __DIR__ . '/topbar.php'; ?>
            <!-- /top navigation -->