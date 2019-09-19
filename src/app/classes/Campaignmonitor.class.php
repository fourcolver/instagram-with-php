<?php

/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Google **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Campaignmonitor {

    public static function get_email() {
        global $Configuration;
        if (isset($_GET['code'])) {			           
            $token = json_decode(Handling::curlHttpRequest("https://api.createsend.com/oauth/token", "post", array(
                        "grant_type" => "authorization_code",
                        "code" => $_GET['code'],
						"client_id"=>$Configuration["campaignmonitor_client_id"],
						"client_secret"=>$Configuration["campaignmonitor_client_secret"],
                        "redirect_uri" => $Configuration["campaignmonitor_redirect_uri"])
                            ));									
            if (isset($token->access_token)) {				
                $user_data = array();
                $request_user_info = self::curl_file_get_contents("https://api.createsend.com/api/v3.1/primarycontact.json", $token->access_token);							
                $request = json_decode($request_user_info);   
				$user_email=$request->EmailAddress;				
				$request_user_info = self::curl_file_get_contents("https://api.createsend.com/api/v3.1/admins.json?email=".$user_email, $token->access_token);							
                $request = json_decode($request_user_info);   				
				$id=base64_encode($request->EmailAddress."_campaignmonitor");
				$name=$request->Name;			
                $user_data['user']['id'] = $id;
                $user_data['user']['displayName'] = $name;
                $user_data['user']['gender'] = "";
                $user_data['user']['email'] = $request->EmailAddress;
                $user_data['user']['image'] = "";
                $url = 'https://api.createsend.com/api/v3.1/clients.json';
                $clients = json_decode(self::curl_file_get_contents($url, $token->access_token));						
				$lists=array();				
				$subscriber_list=array();
				$subscriber_list_listid=array();
				$total_records=0;
				if(!empty($clients)){
					foreach($clients as $client){
						 $url = 'https://api.createsend.com/api/v3.1/clients/'.$client->ClientID.'/lists.json';
						 $client_lists = json_decode(self::curl_file_get_contents($url, $token->access_token));								 
						 
						 foreach($client_lists as  $client_list){							  
							  $url = 'https://api.createsend.com/api/v3.1/lists/'.$client_list->ListID.'/active.json?page=1&pagesize=1000';
							  $subsribers = json_decode(self::curl_file_get_contents($url, $token->access_token));							 
							  $subscriber_list=$subsribers->Results;
							  if($subsribers->NumberOfPages>1){
								  for($page=2;$page<=$subsribers->NumberOfPages;$page++){
									  $url = 'https://api.createsend.com/api/v3.1/lists/'.$client_list->ListID.'/active.json?page=1&pagesize=1000';
									  $subsribers = json_decode(self::curl_file_get_contents($url, $token->access_token));
									  $subscriber_list=array_merge($subscriber_list,$$subsribers->Results);
								  }
							  }
							 							  
							  $lists[] = array(
									"listid" => $client_list->ListID,
									"list_name" => $client_list->Name,
									"list_count" => count($subscriber_list)
								);
								$total_records=$total_records+count($subscriber_list);
								$subscriber_list_listid[$client_list->ListID]= Handling::returnarray($subscriber_list, 5);
						 }
						 
					}
				}
				$user_data['list_info']=$lists;
				$user_data['user']['record_count']=$total_records;
				$user_data['records'] = $subscriber_list_listid;				 			
                return json_encode(array("status" => "success", "data" => array(trim($id) => $user_data)));
            }
        }
        #Auth URL       
		$scope="ManageLists,ViewReports,AdministerAccount";        
		$url="https://api.createsend.com/oauth?type=web_server&client_id=" . $Configuration["campaignmonitor_client_id"] . "&redirect_uri=" . $Configuration["campaignmonitor_redirect_uri"] . "&scope=".$scope."&state=123456";
        return json_encode(array("status" => "url", "data" => array("url" => $url)));
    }

    public static function curl_file_get_contents($url, $accessToken, $type = 0) {
        $curl = curl_init();
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        $headers = array();
        $headers[] = 'Authorization: Bearer ' . $accessToken;
        $headers[] = 'Content-Type: application/json';
        \ curl_setopt($curl, CURLOPT_URL, $url); //The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); //The number of seconds to wait while trying to connect.
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, FALSE); //To follow any "Location: " header that the server sends as part of the HTTP header.
        curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
        curl_setopt($curl, CURLOPT_TIMEOUT, 500); //The maximum number of seconds to allow cURL functions to execute.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //To stop cURL from verifying the peer's certificate.
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $contents = curl_exec($curl);
        echo curl_error($curl);
        curl_close($curl);
        return $contents;
    }

}
