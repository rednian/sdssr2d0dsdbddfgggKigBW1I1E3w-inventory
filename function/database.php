 <?php
 try{
//   require_once 'config.php';
   $db = new mysqli('localhost','root','','vecs');
   if($db->connect_error){
     echo $db->connect_error;
   }
   else{
//     echo "connected";
   }
 }
 catch (Exception $e){
   echo $e->getMessage();
 }
