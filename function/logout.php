<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 7/20/2015
 * Time: 11:33 AM
 */
//if(isset($_SESSION['id'])){}
session_start();
require_once 'database.php';
date_default_timezone_set('Asia/Manila');
$id = $_SESSION['user_id'];
$login_date = $_SESSION['time'];
$logout_date = date('F d, Y / h:m:s A');

$sql = "INSERT INTO log_history(user_id,date_login,date_log_out)
        VALUES('$id','$login_date','$logout_date')";
$db->query($sql);
$db->close();


session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
header('Location:../login.php');
