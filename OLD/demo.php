<?php
error_reporting(E_ALL);
/**
 * 			SUITE.SOCIAL © 2018 || Social Promotion
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$banner1 = 'http://localhost/promo/assets/img/bg.jpg';
$banner2 = 'http://localhost/promo/assets/img/bg.jpg';
$headline = 'Your Promotion here';
$caption = 'And get regular offers by email';
$content = '<div style="background: #3b5998;" class="coupon"><h1 class="text-center">PROMO CODE:<br><b>2-FOR-1-DEAL</b></h1><p style="color:white" class="text-center">Show to cashier to redeem or enter online if applicable. Expires soon!</p></div>';
$button = 'Claim';
$redirect = 'offer.php?msg=success';
$terms = 'http://localhost/promo/terms';
$footer = 'Connect with one social account to unlock the offer and for newsletter subscription to get exclusive deals & discounts. You can unsubscribe at anytime. Please accept all app permissions.';
$fbpage = 'socialgrower';
$gppage = 'https://plus.google.com/u/0/109209232149937004051';
$analytics = 'UA-24390400-6';
$youtube = 'UCtVd0c0tGXuTSbU5d8cSBUg';
$messenger = 'PROMO';
$apiKey = '12-3LXSCAu1490721049XvjR4PN';
$groupId = '3';

$_SESSION['banner1'] = $banner1;
$_SESSION['banner2'] = $banner2;
$_SESSION['headline'] = $headline;
$_SESSION['caption'] = $caption;
$_SESSION['content'] = $content;
$_SESSION['button'] = $button;
$_SESSION['redirect'] = $redirect;
$_SESSION['terms'] = $terms;
$_SESSION['footer'] = $footer;
$_SESSION['fbpage'] = $fbpage;
$_SESSION['gppage'] = $gppage;
$_SESSION['analytics'] = $analytics;
$_SESSION['youtube'] = $youtube;
$_SESSION['messenger'] = $messenger;
$_SESSION['api_key'] = $apiKey;
$_SESSION['group_id'] = $groupId;
$_SESSION['twitter_follow_user_name'] = $twitter_follow_user_name;
$_SESSION['instagram_follow_user_id'] = $instagram_follow_user_id;

header("Location: offer.php");
