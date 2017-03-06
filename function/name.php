<?php
/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 7/10/2015
 * Time: 9:12 AM
 */
class Name{
  private $id;
  private  $name;
  private $lastname;

  public function set_name($name){
    $this->name =  $_SERVER['REMOTE_ADDR'];
  }
  public function get_name(){
    return$this->name;
  }

  public function get_object(){
    print_r(get_object_vars($this));
  }
}
$n = new Name();
$n->set_name('chris');
//echo $n->get_name();
echo '<pre>';
$n->get_object();
echo '</pre>';

foreach($n->get_object() as $key=>$value){
  echo $key;

}
