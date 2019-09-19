 <?php
 function checkSession(){
 	if(isset($_SESSION['userid']))
{
return $_SESSION['userid'];
}else{
	return ;
}
 }

 function setSession($userid){
 	$_SESSION['userid'] = $userid;
 	if(isset($_SESSION['userid']))
{
return true;
}else{
	return false;
}

 }

 function clearSession(){
 	$_SESSION['userid'] = '';

 	if(isset($_SESSION['userid']))
{
return false;
}else{
	return true;
}

 }

 function getSession(){
 	if(isset($_SESSION['userid']))
{
return $_SESSION['userid'];
}else{
	return 0;
}
 }
