<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** MailChimp Class    **
 * ------------------------------------------------------------------------
 */
require_once("MailChimp/mailchimp.php");

class Model_MailChimp{
    public static function subscribe($email, $merge_vars) {
        global $Configuration;
        $instance = new Mailchimp($Configuration["Mailchimp_ApiKey"]);
        return $instance->lists->subscribe($Configuration["Mailchimp_ListID"], array("email" => $email), $merge_vars, 'html', false);
    }

    public static function subscribe_with_confirmation($email, $merge_vars) {
        global $Configuration;
        $instance = new Mailchimp($Configuration["Mailchimp_ApiKey"]);
        return $instance->lists->subscribe($Configuration["Mailchimp_ListID"], array("email" => $email), $merge_vars);
    }
}