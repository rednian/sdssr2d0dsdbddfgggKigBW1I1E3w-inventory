<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/25/2015
 * Time: 9:45 AM
 */
header('Content-type: application/json');
require_once 'includes.php';


//$sql = "SELECT user_profile.firstname AS firstname, user_profile.middlename, user_profile.lastname, user_profile.username, log_history.date_login, log_history.date_log_out";
//$sql .= " FROM user_profile, log_history";
//$sql .= " WHERE user_profile.user_id = log_history.user_id";
//$sql .= " ORDER BY log_history.lh_id";
//$sql .= " DESC";
$sql = "SELECT * FROM user_profile";

$result = $db->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_array()){
//    echo 1;
    echo json_encode($row);
  }
}
