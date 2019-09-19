<?php

/**
 * 			SUITE.SOCIAL © 2018 || Social Subscribe
 * ------------------------------------------------------------------------
 * 						** Configuration	**
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Facebook {

    public static function get_email() {
        global $Configuration;

        if (isset($_GET['code'])) {
            $user_data = array();
            $token = Handling::curlHttpRequest("https://graph.facebook.com/oauth/access_token?client_id=" . $Configuration['facebook_appid'] . "&redirect_uri=" . $Configuration['facebook_redirect_url'] . $Configuration['facebook_redirect_url_slug'] . "&client_secret=" . $Configuration['facebook_appsecret'] . "&code=" . $_GET['code'] . "&scope=user_birthday,email");
            $token = json_decode($token);
            $token = $token->access_token;
            if (!empty($token)) {
                $request = json_decode(Handling::curlHttpRequest("https://graph.facebook.com/me?fields=id,email,first_name,last_name,birthday,name,gender,picture&access_token=" . $token));
                $user_data['user']['id'] = $request->id;
                $user_data['user']['displayName'] = $request->first_name . " " . $request->last_name;
                $user_data['user']['gender'] = $request->gender;
                $user_data['user']['birthday'] = $request->birthday;
                $user_data['user']['email'] = $request->email;
                $user_data['user']['image'] = $request->picture->data->url;
                $user_data['user']['record_count'] = "";
                $user_data['records'] = "";
                //$resquest_response = json_encode(array("status" => "success", "data" => array($request->id => $user_data)));
                $resquest_response = json_encode(array("status" => "success", "data" => $user_data));
                return $resquest_response;
            }
        }

        #Auth URL
        $url = "https://www.facebook.com/v2.12/dialog/oauth?client_id=" . $Configuration['facebook_appid'] . "&redirect_uri=" . $Configuration['facebook_redirect_url'] . $Configuration['facebook_redirect_url_slug'] . "&response_type=code&scope=user_birthday,email";
        return json_encode(array("status" => "url", "data" => array("url" => $url)));
    }

}
