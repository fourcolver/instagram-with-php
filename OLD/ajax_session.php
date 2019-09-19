<?php
session_start(); 
	 if(isset($_POST['val']))
 {
  echo $_SESSION['userid'] = $_POST['val'];

 }
// }

// if(isset($_SESSION['href']))
// {
// echo $_SESSION['href'];
// }

if(isset($_POST['can_clear']))
 {
  $can_clear = $_POST["can_clear"];

   if($can_clear)
     session_destroy();

   echo json_encode(array("can_clear" => true));
}