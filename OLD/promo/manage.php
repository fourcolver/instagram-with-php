<?php
/**
 * 			SUITE.SOCIAL © 2018 || Social Inviter
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$headline = 'FREE Social Media Management!';
$caption = 'Are you too busy, confused, overwhelmed or stressed about social media? Get free social media management, marketing, monitoring and messaging to grow traffic, customers & sales 24-7 while you focus on running your business and serving customers. Join the best. Offer ends soon!';
$greeting = 'Hi Business Owner!';
$logo = '<img width="100%" src="https://suite.social/images/logo/strip.jpg">';
$picture = 'https://suite.social/ssl_proxy.php?url=https://suite.social/images/banner/home1.jpg';
$promo = 'https://suite.social/business';
$website = 'https://suite.social/#hire';
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

header("Location: //suite.social/whatsapp/index.php?r=MANAGEMENT");

