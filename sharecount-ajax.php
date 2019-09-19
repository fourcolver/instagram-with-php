<?php
if( !session_id() ){
	session_start();
}

if(isset($_POST['action'])) 
{
	$action = $_POST['action'];
  
	if($action == "add-share-count") 
  {
		$parentid = $_POST['parentid'];
    $promoid = $_POST['promoid'];
		$json_arr = file_get_contents('sharecount.json');
		$sharedata = json_decode($json_arr, true);
    
		if(!empty($sharedata)) {
			$cnt = count($sharedata) - 1;
			$cnt1 = $sharedata[$cnt]['id'];
			$cnt = $cnt1 + 1;

			$TotalRow = count($sharedata);
			$DataExist = 0;
			for($i=0;$i<$TotalRow;$i++) {
		    	if($sharedata[$i]['AdminID'] == $parentid && $sharedata[$i]['promoid'] == $promoid) {
		    		$ShareCount = $sharedata[$i]['ShareCount'] + 1;
		    		$sharedata[$i]['ShareCount'] = $ShareCount;
		    		$DataExist = 1;
		    		break;
		    	}
			}
			if($DataExist == 0) {
				$sharecntdata = array('id' => $cnt, 'AdminID' => $parentid, 'promoid' => $promoid, 'ShareCount' => 1);
				$sharedata[] = $sharecntdata;
				file_put_contents('sharecount.json', json_encode($sharedata));
			}
			else
			{
				$sharedata = $sharedata;
				file_put_contents('sharecount.json', json_encode($sharedata));
			}
			
		}
		else
		{
			$json_arr = array();
			$sharedata = array('id' => 1, 'AdminID' => $parentid, 'promoid' => $promoid, 'ShareCount' => 1);
			$json_arr[] = $sharedata;
			file_put_contents('sharecount.json', json_encode($json_arr));
		}
		echo "Done...";
	}
  elseif($action == "reset")
  {
    $parentid = $_SESSION['dashboard_uid'];
		$json_arr = file_get_contents('sharecount.json');
		$sharedata = json_decode($json_arr, true); 
    
    foreach($sharedata as $key => $value)
    {
      if($value['AdminID'] == $parentid) 
      {
        $sharedata[$key]['ShareCount'] = 0;
      }
    }
    
    file_put_contents('sharecount.json', json_encode($sharedata));
  }
}
?>