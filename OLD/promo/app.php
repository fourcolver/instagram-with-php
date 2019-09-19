<?php
/**
 * 			SUITE.SOCIAL © 2018 || Social Inviter
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$headline = 'FREE Android and iOS app for your business!';
$caption = 'Does your business have a mobile app? I bet your competitors already have. Do not get left behind! Get a FREE native Android and iOS app for your business today to grow customers and sales.';
$greeting = 'Hi Business Owner!';
$logo = '<img width="100%" src="https://suite.social/images/logo/strip.jpg">';
$picture = 'https://suite.social/images/mockup/mobile-apps.png';
$promo = 'https://api.whatsapp.com/send?phone=447436905728&text=Mobile%20App';
$website = 'https://suite.social/';
$share = 'https://suite.social/';
$fbpage = 'https://facebook.com/socialgrower';
$content = 'Check this out: https://suite.social/ - you will love it!';
$min_contacts = '5';

$_SESSION['headline'] = $headline;
$_SESSION['caption'] = $caption;
$_SESSION['greeting'] = $greeting;
$_SESSION['logo'] = $logo;
$_SESSION['picture'] = $picture;
$_SESSION['promo'] = $promo;
$_SESSION['website'] = $website;
$_SESSION['share'] = $share;
$_SESSION['fbpage'] = $fbpage;
$_SESSION['content'] = $content;
$_SESSION['min_contacts'] = $min_contacts;

header("Location: //suite.social/whatsapp/offer.php?r=MOBILE-APP");

