<?php

/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Google **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Getresponse {

    public static function get_email() {
        global $Configuration;
        echo "<pre>";
        if (isset($_GET['code'])) {
            $userpwd = $Configuration["getresponse_client_id"] . ":" . $Configuration["getresponse_client_secret"];
            $token = json_decode(Handling::curlHttpRequest("https://api.getresponse.com/v3/token", "post", array(
                        "grant_type" => "authorization_code",
                        "code" => $_GET['code'],
                        "redirect_uri" => $Configuration["getresponse_redirect_uri"])
                            , $userpwd));

            if (isset($token->access_token)) {
                $user_data = array();
                $request_user_info = self::curl_file_get_contents("https://api.getresponse.com/v3/accounts", $token->access_token);
                $request = json_decode($request_user_info);                
                $user_data['user']['id'] = $request->accountId;
                $user_data['user']['displayName'] = $request->firstName . " " . $request->lastName;
                $user_data['user']['gender'] = "";
                $user_data['user']['email'] = $request->email;
                $user_data['user']['image'] = "";
                $url = 'https://api.getresponse.com/v3/campaigns?page=1&perPage=10000';
                $results = json_decode(self::curl_file_get_contents($url, $token->access_token));
                $member = array();
                if (!empty($results)) {
                    $total_member_in_list = 0;
                    foreach ($results as $list) {
                        $url = 'https://api.getresponse.com/v3/contacts?query[campaignId]=' . $list->campaignId . '&page=1&perPage=10000';
                        $contacts = json_decode(self::curl_file_get_contents($url, $token->access_token));
                        $count_contacts = count($contacts);
                        $member[$list->campaignId] = Handling::returnarray($contacts, 4);;
                        $user_cc_list[] = array(
                            "listid" => $list->campaignId,
                            "list_name" => $list->name,
                            "list_count" => $count_contacts
                        );
                        $total_member_in_list = $total_member_in_list + $count_contacts;
                    }
                }             
                $user_data['list_info'] = $user_cc_list;
                $user_data['user']['record_count'] = $total_member_in_list;             
                $user_data['records'] = $member;                                       
                return json_encode(array("status" => "success", "data" => array($request->id => $user_data)));
            }
        }
        #Auth URL       
        $url = "https://app.getresponse.com/oauth2_authorize.html?response_type=code&client_id=" . $Configuration["getresponse_client_id"] . "&redirect_uri=" . $Configuration["getresponse_redirect_uri"] . "&state=xyz";
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
