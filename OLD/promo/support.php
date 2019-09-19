<?php
/**
 * 			SUITE.SOCIAL © 2018 || Social Inviter
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$headline = 'FREE Social Support App for Business!';
$caption = 'Many people are talking about your business on social media! It can be hard to keep track, so use our free social support app to view all messages in one place and reply with one click to grow sales or bookings. Login and share to claim this special offer. Expires soon!';
$greeting = 'Hi Business Owner!';
//$logo = '<a href="//suite.social//support" target="_blank"><img height="100px" src="https://suite.social/images/icon/suite_80px.jpg"></a>';
$picture = 'https://suite.social/ssl_proxy.php?url=https://suite.social/images/thumb/support.png';
$promo = 'https://suite.social/business';
$website = 'https://suite.social/#support';
$share = 'https://suite.social/';
$fbpage = 'https://facebook.com/socialgrower';
$content = 'Check this out: https://suite.social/ - you will love it!';
$min_contacts = '25';

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

header("Location: //suite.social/whatsapp/offer.php?r=SALON");

