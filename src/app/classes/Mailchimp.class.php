<?php

/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Google **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Mailchimp {

    public static function get_email() {
        global $Configuration;


        if (isset($_GET['code'])) {
            $token = json_decode(Handling::curlHttpRequest("https://login.mailchimp.com/oauth2/token", "post", array(
                        "code" => $_GET['code'],
                        "client_id" => $Configuration["mailchimp_client_id"],
                        "client_secret" => $Configuration["mailchimp_client_secret"],
                        "redirect_uri" => $Configuration["mailchimp_redirect_uri"],
                        "grant_type" => "authorization_code")));

            if (isset($token->access_token)) {
                $user_data = array();

                $request_user_info = self::curl_file_get_contents("https://" . $Configuration['mailchimp_oauth_domain'] . ".api.mailchimp.com/3.0/", $token->access_token);
                $profileinfo = json_decode($request_user_info);
                $user_data['user']['id'] = $profileinfo->login_id;
                $user_data['user']['displayName'] = $profileinfo->username;
                $user_data['user']['gender'] = "";
                $user_data['user']['email'] = $profileinfo->email;
                $user_data['user']['image'] = $profileinfo->avatar_url;

                $mailchimp_list = self::curl_file_get_contents("https://" . $Configuration['mailchimp_oauth_domain'] . ".api.mailchimp.com/3.0/lists", $token->access_token);
                $mailchimp_list = json_decode($mailchimp_list);
                $user_mailchimp_list = array();
                if (!empty($mailchimp_list)) {
                    $total_member_in_list = 0;
                    foreach ($mailchimp_list->lists as $list) {
                        $user_mailchimp_list[] = array(
                            "listid" => $list->id,
                            "list_name" => $list->name,
                            "list_count" => $list->stats->member_count
                        );
                        $total_member_in_list = $total_member_in_list + $list->stats->member_count;
                    }
                }
                $user_data['user']['record_count'] = $total_member_in_list;
                $user_data['list_info'] = $user_mailchimp_list;
                $members = array();
                foreach ($user_mailchimp_list as $mail_list) {
                    if($mail_list['list_count']>0) {
                        $list_members = Mailchimp::curl_file_get_contents("https://us17.api.mailchimp.com/3.0/lists/" . $mail_list['listid'] . "/members?count=" . $mail_list['list_count'], "a43701290a5b0737fb751a2d4f647e77");
                        $list_members=json_decode($list_members);
                        $member = Handling::returnarray($list_members->members, 2);
                        $members[$mail_list['listid']] = $member;
                    }
                }
                $user_data['records'] = $members;
                return json_encode(array("status" => "success", "data" => array(trim($profileinfo->login_id) => $user_data)));
            }
        }
        #Auth URL
//        $scopes = urlencode('https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/contacts.readonly https://www.google.com/m8/feeds/');
        $url = "https://login.mailchimp.com/oauth2/authorize?client_id=" . $Configuration["mailchimp_client_id"] . "&response_type=code&redirect_uri=" . $Configuration["mailchimp_redirect_uri"] . "&access_type=online&approval_prompt=auto";
        return json_encode(array("status" => "url", "data" => array("url" => $url)));
    }

    public static function curl_file_get_contents($url, $accessToken, $type = 0) {
        $curl = curl_init();
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        $headers = array();
        $headers[] = 'Authorization: OAuth ' . $accessToken;
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
