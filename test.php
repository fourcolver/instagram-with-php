<?php
	function getRealIpAddr() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	function get_location_using_ip($ip_address='') {
		//$access_key = 'aa5b956f8b180299e74758bb24c0314b';

		// Initialize CURL:
		if($ip_address!=''){
			//$ch = curl_init('https://ipapi.co/'.$ip_address.'/json/');
			$ch = curl_init('https://www.iplocate.io/api/lookup/'.$ip_address);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Store the data:
			$json = curl_exec($ch);
			curl_close($ch);

			// Decode JSON response:
			$api_result = json_decode($json, true);

			// Output the "capital" object inside "location"
			return $api_result;
		}
		else
		{
			return "";
		}
	}

$ip_address = getRealIpAddr();
echo "Rahul...".$ip_address."<br>";
echo "Rahul..... <pre>".print_r(get_location_using_ip($ip_address))."</pre><br>";
?>