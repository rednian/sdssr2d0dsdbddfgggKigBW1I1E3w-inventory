<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 7/10/2015
 * Time: 5:14 PM
 */

class Session {
  private $log_in = false;
  public $is_login;
  private $user_id;

  public function __construct(){
    session_start();
  }
  private function check_login(){
    if(isset($_SESSION['user_id'])){

    }
  }
  public function is_logged_in(){
    return $this->log_in;
  }
  public function login($user){

  }





} 