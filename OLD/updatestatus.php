<?php
session_start();
require_once('session.php');

 $id = $_GET['id'];
 $status = $_GET['status'];


 $file=getSession();
if($file!='0'){
	$filename=$file;
}else{
	$filename="results";
}
if (file_exists('data/'.$filename.'.json')) {
   $jsonString = file_get_contents('data/'.$filename.'.json');
} else {
   $jsonString = '';
}
$data = json_decode($jsonString, true);



foreach ($data as $key1 => $entry) {
	
	foreach ($entry as $key => $value) {
		
	 if ($value['id'] == $id) {

	 	$entry[$key]['status'] = $status;
	 	
    }

	}
 

}
$response['msg'] = $entry;

$newJsonString = json_encode($response);
file_put_contents('data/'.$filename.'.json', $newJsonString);
echo '<script type="text/javascript">window.location="index.php"</script>';