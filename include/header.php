<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header('Location:login.php');
  exit;
}
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Villanueva Eye Clinic | Dashboard</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


  <link href="font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
  <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css"/>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!--  <link rel="stylesheet" href="bootstrap/css/bootstrapValidator.css"/>-->
	<link rel="stylesheet" href="bootstrap/css/jquery-ui.min.css">
  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="dist/sweetalert.css" rel="stylesheet" type="text/css" />
  <link href="bootstrap/css/custom.css" rel="stylesheet" type="text/css"/>
</head>
<body class="skin-blue sidebar-mini fixed">
<div class="wrapper">