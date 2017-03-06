<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Autocad
 * Date: 8/14/2015
 * Time: 1:58 PM
 */

require_once 'database.php';

$username = $_POST['username'];
$password = $_POST['password'];
$password = sha1($password.$username);



date_default_timezone_set('Asia/Manila');

$sql = "SELECT * FROM user_profile WHERE username = '$username' AND `password` = '$password' LIMIT 1 ";
$result = $db->query($sql);

if($result->num_rows > 0){
  $user = $result->fetch_array();
  $_SESSION['user_id'] = $user[0];
  $_SESSION['time'] = date('F d, Y / h:m:s A');
//  require_once '../function/includes.php';
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM user_profile WHERE user_id = '$user_id' LIMIT 1";
  $result = $db->query($sql);
//if($result->num_rows > 0){
  $row = $result->fetch_array();
  $_SESSION['user']=$row;
//echo "<pre>";
//print_r($_SESSION['user'][1]);
//echo "</pre>";
//}

  echo true;
}
else{
  echo 'Incorrect username or password.';

}


