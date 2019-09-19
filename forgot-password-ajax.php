<?php
if( !session_id() ){
	session_start();
}
if(isset($_POST['action']))
{
	$action = $_POST['action'];
	$_SESSION['forgotPassword'] = $action;
	echo $_SESSION['forgotPassword']."1";
}
else
{
	echo "0";
}
?>