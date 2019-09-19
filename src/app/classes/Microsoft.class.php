<?php

/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Microsoft    **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Microsoft {

    public static function getEmail($code = null) {
        global $Configuration;
//        $url = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=" . $Configuration['microsoft_client_id'] . "&response_type=code&redirect_uri=" . $Configuration['microsoft_redirect_uri'] . "&response_mode=query&scope=openid%20offline_access%20https%3A%2F%2Fgraph.microsoft.com%2Fmail.read&state=12345";
       $scope="https://graph.microsoft.com/mail.read https://graph.microsoft.com/Contacts.Read https://graph.microsoft.com/User.Read ";
        $url = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=" . $Configuration['microsoft_client_id'] . "&response_type=code&redirect_uri=" . $Configuration['microsoft_redirect_uri'] . "&response_mode=query&scope=".$scope."&state=12345";
        return json_encode(array("status" => "url", "data" => array("url" => $url)));
    }
    
    

}
