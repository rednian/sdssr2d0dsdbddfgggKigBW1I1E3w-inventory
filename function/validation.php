<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 7/9/2015
 * Time: 1:51 PM
 */
class Validation{
  private $fieldname;
  private $password;
  private $required_field = array('username','password');

  public function __construct($fieldname){
    $this->fieldname = $fieldname;
  }
  public function limit_length($min = 0, $max){

  }



}