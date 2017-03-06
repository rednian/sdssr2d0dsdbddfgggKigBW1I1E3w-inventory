<?php
class user{

  public  function get_class_name(){
    $class_name = get_called_class();
    return $class_name;
  }
}

$u = new user();
echo $u->get_class_name();