<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/24/2015
 * Time: 3:13 PM
 */
require_once 'includes.php';

function find_by_sql($db,$sql){
  $result = $db->query($sql);
 $row = $result->fetch_array();
  return $row;
}

function clean_input($input="	"){
	$input = trim($input);
	return $input;
}


function test($row){
    echo "<pre>";
  print_r($row);
  echo "</pre>";
//  echo $row[2];
}
