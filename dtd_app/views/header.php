<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php

    if ($current_page == "customer") {
        echo "<title>DTD - Customer</title>";
    } else if ($current_page == "vendor") {
        echo "<title>DTD - Vendor</title>";
    } else if ($current_page == "site") {
        echo "<title>DTD - Login</title>";
    } else if ($current_page == "admin") {
        echo "<title>DTD - Admin</title>";
    } else if ($current_page == "register") {
        echo "<title>DTD - Registration</title>";
    }
    ?>

    <!-- Bootstrap Core CSS -->
    <link href="<?= RES_URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= RES_URL; ?>css/datepicker.css">

    <!-- MetisMenu CSS -->
    <link href="<?= RES_URL; ?>css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= RES_URL; ?>css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?= RES_URL; ?>css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?= RES_URL; ?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= RES_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
if ($current_page != "site")
{
?>
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
            <?php

            if ($current_page == "customer") {
                echo '<a class="navbar-brand" href="' . site_url('customer') . '">Door to Door Transport</a>';
            }
            if ($current_page == "vendor") {
                echo '<a class="navbar-brand" href="' . site_url('vendor') . '">Door to Door Transport</a>';
            }
            if ($current_page == "site") {
                echo "<title>DTD - Login</title>";
            }
            if ($current_page == "admin") {
                echo '<a class="navbar-brand" href="' . site_url('admin') . '">Door to Door Transport</a>';
            }

            ?>

        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <?php

                if ($current_page == "customer") {
                    echo '<a class="navbar-brand" href="">Welcome,'.$user_info['username'].'</a>';
                }
                if ($current_page == "vendor") {
                    echo '<a class="navbar-brand" href="">Welcome, Vendor</a>';
                }
                if ($current_page == "site") {
                    echo '<a class="navbar-brand" href="">Welcome to DTD</a>';
                }
                if ($current_page == "admin") {
                    echo '<a class="navbar-brand" href="">Welcome, Admin</a>';
                }

                ?>

            </li>


        </ul>
        <!-- /.navbar-top-links -->
        <?php
        }
        ?>
