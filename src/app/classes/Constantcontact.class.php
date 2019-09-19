<?php

/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Google **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class constantcontact {

    public static function get_email() {
        global $Configuration;


        if (isset($_GET['access_token'])) {
            $user_data = array();
            $access_token = $_GET['access_token'];
            $request_user_info = self::curl_file_get_contents("https://api.constantcontact.com/v2/account/info?api_key=" . $Configuration["constantcontact_client_id"], $access_token);
            $profileinfo = json_decode($request_user_info);
            $id = base64_encode($profileinfo->email);
            $user_data['user']['id'] = $id;
            $user_data['user']['displayName'] = $profileinfo->first_name . " " . $profileinfo->last_name;
            $user_data['user']['gender'] = "";
            $user_data['user']['email'] = $profileinfo->email;
            $user_data['user']['image'] = $profileinfo->company_logo;
            $cc_list = self::curl_file_get_contents("https://api.constantcontact.com/v2/lists?api_key=" . $Configuration["constantcontact_client_id"], $access_token);
            $cc_list = json_decode($cc_list);
            $user_cc_list = array();
            if (!empty($cc_list)) {
                $total_member_in_list = 0;
                foreach ($cc_list as $list) {
                    $user_cc_list[] = array(
                        "listid" => $list->id,
                        "list_name" => $list->name,
                        "list_count" => $list->contact_count
                    );
                    $total_member_in_list = $total_member_in_list + $list->contact_count;
                }
            }
            $user_data['user']['record_count'] = $total_member_in_list;
            $user_data['list_info'] = $user_cc_list;
            $members = array();
            foreach ($user_cc_list as $mail_list) {
                if ($mail_list['list_count'] > 0) {
                    $list_members = self::curl_file_get_contents("https://api.constantcontact.com/v2/lists/" . $mail_list['listid'] . "/contacts?limit=50&api_key=" . $Configuration["constantcontact_client_id"], $access_token);
                    $list_members = json_decode($list_members);
                    $member = Handling::returnarray($list_members->results, 3);
                    $members[$mail_list['listid']] = $member;
                }
            }
            $user_data['records'] = $members;

            return json_encode(array("status" => "success", "data" => array(trim($profileinfo->login_id) => $user_data)));
        }


        #Auth URL
//        $scopes = urlencode('https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/contacts.readonly https://www.google.com/m8/feeds/');echo 

        if ($_COOKIE['ctct'] == 0) {
            $url = "https://oauth2.constantcontact.com/oauth2/oauth/siteowner/authorize?response_type=token&client_id=" . $Configuration["constantcontact_client_id"] . "&redirect_uri=" . urlencode($Configuration["constantcontact_redirect_uri"]);
            return json_encode(array("status" => "url", "data" => array("url" => $url)));
        } else {
            return true;
        }
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
