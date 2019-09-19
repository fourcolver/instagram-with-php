<?php
error_reporting(E_ALL);
/**
 * 			SUITE.SOCIAL © 2018 || Social Login
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$headline = 'WhatsApp Marketing Tool - Schedule Bulk Messages (PRE-LAUNCH).';
$caption = 'Send or schedule single or bulk WhatsApp messages (reminders, promotions, bookings, events etc) to unlimited customers without having their phone number in your phone address book!';
$screen = '//suite.social/images/post/whatsapp.jpg';
$button_image = '<p><a href="#videoWhatsapp" data-toggle="modal" class="btn btn-success btn-lg btn-block"><i class="fa fa-youtube-play"></i> WATCH VIDEO!</a></p>';
$tool = 'WhatsApp Tool';
$share_headline = 'WhatsApp Marketer!';
$share_visitors = '1';
$share_need = '98';
$share_out = '99';
$share_offer = '2 weeks free early bird access!';
$url = 'https://api.whatsapp.com/send?phone=447505542592&text=I%20would%20like%203-Month%20Access%20to%20your%20WhatsApp%20Marketing%20tool'; // WHATSAPP LINK
$display_networks = 'display:none';
$display_whatsapp = 'display:none';
$display_email = '';
$display_autoresponders = '';
$button_link = '<a href="https://suite.social/whatsapp/sales.php " class="btn btn-primary btn-lg btn-block">OR ORDER NOW! <i class="fa fa-arrow-right"></i></a>';
$timer = 'display';

$_SESSION['headline'] = $headline;
$_SESSION['caption'] = $caption;
$_SESSION['screen'] = $screen;
$_SESSION['tool'] = $tool;
$_SESSION['share_headline'] = $share_headline;
$_SESSION['share_visitors'] = $share_visitors;
$_SESSION['share_need'] = $share_need;
$_SESSION['share_out'] = $share_out;
$_SESSION['share_offer'] = $share_offer;
$_SESSION['url'] = $url;
$_SESSION['display_networks'] = $display_networks;
$_SESSION['display_whatsapp'] = $display_whatsapp;
$_SESSION['display_email'] = $display_email;
$_SESSION['display_autoresponders'] = $display_autoresponders;
$_SESSION['button_link'] = $button_link;
$_SESSION['button_image'] = $button_image;
$_SESSION['timer'] = $timer;

header("Location: //suite.social/login/index.php?r=WHATSAPP-LAUNCH");
