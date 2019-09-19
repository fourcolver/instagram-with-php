<?php
session_start();
require_once('session.php');

$userFbID = $_SESSION['userData']['id'];

$file = getSession();
if ($file != '0') {
    $filename = $file;
} else {
    $filename = "results";
}
if (file_exists('data/' . $filename . '.json')) {
    $jsonString = file_get_contents('data/' . $filename . '.json');
} else {
    $jsonString = '';
}

$data = json_decode($jsonString, true);

// loop through messages and remove message histroy of current user
if (isset($data['msg']) && count($data['msg']) > 0) 
{
  foreach ($data['msg'] as $key => $message) 
  {
    if ($message['token_id'] == $userFbID) {
      unset($data['msg'][$key]);
    }
  }
}

// put the remaining contents to the file again 
$newJsonString = json_encode($data);
file_put_contents('data/'.$filename.'.json', $newJsonString);

echo '<script type="text/javascript">window.location="index.php"</script>';