<?php
class sharelock{

	 
	//constructor defined for class
	function __construct($id=0)
	{        
        $id = (int)$id;
	}
    

    //function to check visitor counts and store in file. beside this function checks if ip is duplicate or new. if there is new ip ip is stored in repective txt file
    function header($id,$ip,$string,$reset)
    {
		if($reset=='0') {
	    @session_start();
	    $id = $id;
	    $ipadd1 = $_SERVER['REMOTE_ADDR']; //10.10.10.01
 		$ipadd=str_replace(".", "", $ipadd1); //10101001
	    $visitor_file=$id.'_'.$string.'.txt'; //hirer file
		$visitor1_file=$id.'_'.$ipadd.'.txt'; //visitor file
	    
		if(file_exists($visitor_file))
	    {
	    	$cnt=file_get_contents($visitor_file);
			$cnt1=0;
			
	    }
	    else
	    { 
	    	$cnt=0;
			$cnt1=0;
	    }

	    if($ip=='1')
		{
           $ok = false;
	        
	        if($string != '')
	        {
			    $filename='visitor_'.$string.'.txt';
	        	foreach(glob($filename) as $filenm)
				{
				  foreach(file($filenm) as $fli=>$fl)
				  {
				  	$arr_list=explode(';',$fl);
				  	
					if (in_array($ipadd1, $arr_list))				    
				    {	
				    $cnt12=file_get_contents($visitor1_file);
					return $cnt12;
					}
				    
					else
				    {
						$i_ip=$ipadd1.';';
	        			file_put_contents($filename,$i_ip,FILE_APPEND) ;
						$count = $cnt+1;
						$filename_1=$id.'_'.$string.'.txt';
						$fh = fopen($filename_1, 'w+');
                        fwrite($fh, $count); 
						$filename1='visitor_'.$ipadd.'.txt';
				
      				if($string != $ipadd)
					{
					if(file_exists($visitor1_file))
					{
						$cnt2=file_get_contents($visitor1_file);
						return $cnt2; 
					}
					else
					{
						$fh = fopen($filename1, 'w+');
						file_put_contents($filename1,$i_ip,FILE_APPEND);
						return $count1 = $cnt1 + 1;
					}
				    }
				 
				     else
				    {
						$cnt2=file_get_contents($visitor1_file);
						return $cnt2; 
				    }
				    }
				}
		    }    	
	    }
	        else
	        {  
				$filename_2='visitor_'.$ipadd.'.txt';
			
			if(file_exists($visitor1_file))
			{
				$cnt2=file_get_contents($visitor1_file);
				return $cnt2;
			}
			else
			{
				$strr=$ipadd.';';
	        	$fh = fopen($filename_2, 'a+');
	        	file_put_contents($filename_2,$strr,FILE_APPEND);
	        	return $count = $cnt+1;
			}
	        }				       
		}
		else
		{
			if(isset($_SESSION['sharelock-detect']))
	        {
	        
	            if (!isset($_COOKIE['sharelock-detect']))
	            {
	                $domain_name = preg_replace('/^www\./','',$_SERVER['SERVER_NAME']);
	                setcookie('sharelock-detect', '', time() - 86400 * 1, '/', $domain_name);
	                setcookie('sharelock-detect', '1', time() + 86400 * 1, '/', $domain_name);
	                $_SESSION['sharelock-detect'] = 1;
	            }	
	            
	        } 
	        else
	        {
	            $domain_name = preg_replace('/^www\./','',$_SERVER['SERVER_NAME']);
	            setcookie('sharelock-detect', '', time() - 86400 * 1, '/', $domain_name);
	            setcookie('sharelock-detect', '1', time() + 86400 * 1, '/', $domain_name);
	            $_SESSION['sharelock-detect'] = 1;		
	        }
       
       	 	$hash = md5($id . $this->get_URL());
       	 	//echo $_COOKIE[$hash];
        
	        if (!isset($_COOKIE[$hash]))
	        {
	        	
				if((isset($_COOKIE['sharelock-detect'])) && (isset($_SESSION['sharelock-detect'])))
				{
					$domain_name = preg_replace('/^www\./','',$_SERVER['SERVER_NAME']);
					setcookie($hash, '', time() - 86400 * 1, '/', $domain_name);
					setcookie($hash, '1', time() + 86400 * 1, '/', $domain_name);	
					return $count = $cnt;         	
				}  
				else
				{
					return $count = $cnt+1; 
				}					
	        }
	        else
	        {
	        	return $count = $cnt;
	        } 
	      
	    }                
    }
	else{ 
		$cnt=1;
		$ipadd = $_SERVER['REMOTE_ADDR'];
		$strr=str_replace(".", "", $ipadd);
	    $str=$ipadd.';';
	    $filename_N='visitor_'.$strr.'.txt';
	    $fh = fopen($filename_N, 'w+');
	    file_put_contents($filename_N,$str,FILE_APPEND);
	    $filename_N1=$id.'_'.$strr.'.txt';
		$fh_1 = fopen($filename_N1, 'w+');
		file_put_contents($filename_N1,$cnt,FILE_APPEND);
		}
	}
	
    //function to retrieve url
	private function get_URL(){
		$URL = 'http';
		if (isset($_SERVER["HTTPS"]) && ( $_SERVER["HTTPS"] == "on" ) ) {
			$URL = $URL . "s";
		}
		$URL = $URL . "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$URL = $URL . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$URL = $URL . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $URL;
	}
}
?>