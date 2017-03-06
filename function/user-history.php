<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/20/2015
 * Time: 2:10 PM
 */
require_once 'database.php';
require_once 'function.php';
$sql = "SELECT user_profile.firstname, user_profile.middlename, user_profile.lastname,user_profile.username, log_history.date_login,`date_log-out`
        FROM log_history, user_profile
        WHERE user_profile.user_id = log_history.user_id";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_array()) {
   echo json_encode($row); 
  }
} else {
  echo '';
}