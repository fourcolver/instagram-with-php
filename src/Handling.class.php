<?php

/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Handling Tools **
 * ------------------------------------------------------------------------
 */
//require_once("Model_MailChimp.class.php");

class Handling {

    public static function handling_request($email, $profile, $type = NULL) {
        $merge_vars = self::parse_profile($profile, $type);
        try {
            Model_MailChimp::subscribe($email, $merge_vars);
        } catch (Mailchimp_List_AlreadySubscribed $e) {
            return self::handling_this("List_AlreadySubscribed");
        } catch (Mailchimp_Invalid_Email $e) {
            return self::handling_this("Invalid_Email");
        } catch (Mailchimp_List_MergeFieldRequired $e) {
            exit("Please go to http://mailchimp.com/, login, go to your list, then Settings, and put \"First Name\" and \"Last Name\" not required.");
        } catch (Mailchimp_Invalid_ApiKey $e) {
            exit("Your API Key is Invalid!");
        } catch (Mailchimp_List_DoesNotExist $e) {
            exit("The list that you provided does not exists!");
        } catch (Exception $e) {
            Mailchimp_Social_WP::sendError(print_r($e, true), "Handling.class.php", "24");
            return self::handling_this("ERRO");
        }
        $page = self::handling_this();
        return $page;
    }

    public static function handling_request_with_confirmation($email, $profile, $type = NULL, $Configuration) {
        $merge_vars = self::parse_profile($profile, $type);
        $url = "http://suite.social/sender/ssem_api/sync_contact";
        $data = array(
            "api_key" => $Configuration["SocialSender_ApiKey"],
            "first_name" => $merge_vars['FNAME'],
            "last_name" => $merge_vars['LNAME'],
            "mobile" => "",
            "email" => $email,
            "contact_group_id" => $Configuration["SocialSender_GroupID"],
            "date_birth" => isset($merge_vars['BDATE']) ? $merge_vars['BDATE'] : ''
        );

        self::httpSyncData($data);
        $page = self::handling_this(array('success'));
        return $page;
    }

    public static function httpSyncData($params) {
        $url = "http://suite.social/pro/ssem_api/sync_contact";
        $postData = '';
        foreach ($params as $k => $v) {
            $postData .= $k . '=' . $v . '&';
        }
        $postData = rtrim($postData, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $output = curl_exec($ch);

        curl_close($ch);
    }

    private static function parse_profile($profile, $type = NULL) {
        $bdate = '';
        if (is_null($type)) {
            return array();
        }
        if ($type == "facebook") {
            $bdate = @$profile->profile->birthday;
            $bdate = date("Y-m-d", strtotime($bdate));

            $array["FNAME"] = @$profile->profile->first_name;
            $array["LNAME"] = @$profile->profile->last_name;
            if (isset($profile->profile->birthday)) {
                $bdate = date('Y-m-d', strtotime($profile->profile->birthday));
            }
            $array["BDATE"] = $bdate;
        } else if ($type == "google") {
            $array["FNAME"] = @$profile->profile->given_name;
            $array["LNAME"] = @$profile->profile->family_name;
            if (isset($profile->birthday)) {
                $bdate = date('Y-m-d', strtotime($profile->birthday));
            }
            $array["BDATE"] = @$bdate;
        } else if ($type == "microsoft") {
            $array["FNAME"] = @$profile['first_name'];
            $array["LNAME"] = @$profile['last_name'];
            $array["BDATE"] = '';
        } else if ($type == "linkedin") {
            $array["FNAME"] = @$profile->profile->firstName;
            $array["LNAME"] = @$profile->profile->lastName;
        } else if ($type == "youtube") {
            $array["FNAME"] = @$profile->profile->given_name;
            $array["LNAME"] = @$profile->profile->family_name;
            if (isset($profile->birthday)) {
                $bdate = date('Y-m-d', strtotime($profile->birthday));
            }
            $array["BDATE"] = @$bdate;
        }
        return $array;
    }

    private static function handling_this($response) {
        global $responsePage;
        if (isset($response) && !is_null($response)) {
            if ($response == "List_AlreadySubscribed") {
                $page = $responsePage["repeated"];
                //header("Location: ".$responsePage["repeated"]);
            } else if ($response == "Invalid_Email") {
                $page = $responsePage["bad_email"];
            } else {
                $page = $responsePage["error"];
                //header("Location: ".$responsePage["error"]);
            }
        } else {
            $page = $responsePage["success"];
            //header("Location: ".$responsePage["success"]);
        }
        return $page;
    }

    public static function curlHttpRequest($url, $method = "get", $request_fields = array(), $userpwd = "", $header = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        if (!empty($userpwd)) {
            curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
        }

        if ($method == "post") {
            curl_setopt($ch, CURLOPT_POST, true);
            $request_fields = http_build_query($request_fields);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request_fields);
        } else if ($method == "get") {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        } else if ($method == "del") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        $results = curl_exec($ch);

        if (curl_error($ch)) {
            return 'error:' . curl_error($ch);
        }
        return $results;
    }

    public static function returnarray($userinfo, $values) {
        $data = array();
        if ($values == 0) {
            $userinfo = json_decode(str_replace("$", "", json_encode($userinfo)));
            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => $user->title->t,
                    "phone" => $user->gdphoneNumber[0]->uri,
                    "email" => $user->gdemail[0]->address,
                );
            }
        } elseif ($values == 1) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => (empty($user->displayName) ? $user->fileAs : $user->displayName),
                    "phone" => @$user->mobilePhone,
                    "email" => (isset($user->emailAddresses[0]->name) ? $user->emailAddresses[0]->name : ""),
                );
            }
        } elseif ($values == 2) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => $user->merge_fields->FNAME . " " . $user->merge_fields->LNAME,
                    "phone" => "",
                    "email" => $user->email_address,
                );
            }
        } elseif ($values == 3) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => ($user->prefix_name? $user->prefix_name: ($user->first_name . " " . $user->last_name)),
                    "phone" => $user->cell_phone,
                    "email" => $user->email_addresses[0]->email_address,
                );
            }
        } elseif ($values == 4) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => $user->name,
                    "phone" => "",
                    "email" => $user->email,
                );
            }
        } elseif ($values == 5) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => $user->Name,
                    "phone" => "",
                    "email" => $user->EmailAddress,
                );
            }
        } elseif ($values == 6) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => $user->Name,
                    "phone" => "",
                    "email" => $user->EmailAddress,
                );
            }
        } elseif ($values == 7) {

            foreach ($userinfo as $key => $user) {
                $data[] = array(
                    "title" => @$user->fields[0]->value->givenName,
                    "phone" => "",
                    "email" => @$user->fields[2]->value,
                );
            }
        }
        return $data;
    }

}
