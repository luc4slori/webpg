<?php include('session_start.php');
	require_once("models/nota.php");	
		require_once("utils/common.php");
		require_once("models/menu.php");		
		require_once("models/submenu.php");	
		require_once("models/publi.php");
    	$publ = new Publi();
		$mnu = new Menu();		
		$submnu = new Submenu();
		$nta = new Nota();
 ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Viejos Son Los Trapos</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<!--link rel="icon" type="image/png" href="images/icons/favicon.png"/!-->
	
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/bootstrap/css/bootstrap.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/fonts/iconic/css/material-design-iconic-font.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/animate/animate.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/css-hamburgers/hamburgers.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/animsition/css/animsition.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/vendor/toastr/css/toastr.min.css"'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/css/util.min.css'?>">
	<link rel="stylesheet" type="text/css" href="<?=$rootDir.'/nuevo/css/main.css'?>">


</head>