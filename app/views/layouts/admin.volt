<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <title><?php echo Phalcon\Tag::getTitle(); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="">
    <link rel="shortcut icon" href="" type="image/x-icon">

    <link rel="stylesheet" href="{{ static_url('vendor/core/packages/bootstrap/dist/css/bootstrap.min.css?v=') }}<?php echo cache_asset()?>">
    <link rel="stylesheet" href="{{ static_url('vendor/core/packages/font-awesome/css/font-awesome.min.css?v=') }}<?php echo cache_asset()?>">
    <link rel="stylesheet" href="{{ static_url('vendor/core/packages/Ionicons/css/ionicons.min.css?v=') }}<?php echo cache_asset()?>">
    <link rel="stylesheet" href="{{ static_url('vendor/core/css/core.min.css?v=') }}<?php echo cache_asset()?>">
    <link rel="stylesheet" href="{{ static_url('vendor/core/css/main.css?v=') }}<?php echo cache_asset(false)?>">
    <link rel="stylesheet" href="{{ static_url('vendor/core/css/skins/skin-blue.min.css?v=') }}<?php echo cache_asset(false)?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php $this->partial('partials/admin/top-header'); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php $this->partial('partials/admin/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php $this->partial('partials/admin/breadcrumb'); ?>

            <!-- Main content -->
            <section class="content container-fluid">
                <?php echo $this->getContent(); ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- Main Footer -->
        <?php $this->partial('partials/admin/footer'); ?>
        <!-- /Footer -->
    </div>
    <!-- /.content-wrapper -->

    <script src="{{ static_url('vendor/core/packages/jquery/dist/jquery.min.js?v=') }}<?php echo cache_asset()?>"></script>
    <script src="{{ static_url('vendor/core/packages/bootstrap/dist/js/bootstrap.js?v=') }}<?php echo cache_asset()?>"></script>
    <script src="{{ static_url('vendor/core/packages/bootstrap-notify/bootstrap-notify.min.js?v=') }}<?php echo cache_asset()?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.js"></script>
    <script src="{{ static_url('vendor/core/js/core.min.js?v=') }}<?php echo cache_asset()?>"></script>
    <script src="{{ static_url('vendor/core/js/main.js?v=') }}<?php echo cache_asset(false)?>"></script>
</body>

</html>
