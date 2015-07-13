<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<?php

    if($current_page=="customer")
	{
	echo "<title>DTD - Customer</title>";
	}
	if($current_page=="site")
	{
	echo "<title>DTD - Login</title>";
	}
	
	?>

    <!-- Bootstrap Core CSS -->
    <link href="<?=RES_URL;?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=RES_URL;?>css/datepicker.css">
        

    <!-- MetisMenu CSS -->
    <link href="<?=RES_URL;?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=RES_URL;?>css/sb-admin-2.css" rel="stylesheet">
	<link href="<?=RES_URL;?>css/jquery.dataTables.css" rel="stylesheet">
	<link href="<?=RES_URL;?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=RES_URL;?>css/dataTables.bootstrap.css" rel="stylesheet">
	
	
	

    <!-- Custom Fonts -->
    <link href="<?=RES_URL;?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php 
if($current_page != "site")
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
                <a class="navbar-brand" href="<?=BASE_URL("customer")?>">Door to Door Transport</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="navbar-brand" href="">Welcome, Vimal</a>
                </li>
				
				
                
            </ul>
            <!-- /.navbar-top-links -->
<?php 
			}
			?>