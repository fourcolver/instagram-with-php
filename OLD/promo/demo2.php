<?php
/**
 * 			SUITE.SOCIAL © 2019 || WhatsApp Promo
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$logo = 'https://suite.social/images/icon/suite_80px.jpg';
$background = 'http://suite.social/user/promo/assets/img/bg_pizza.jpg';
$headline = '50% off deal';
$caption = 'Verify your WhatsApp number and share with contacts to unlock the promotion';
$cta = 'Download';
$share = 'whatsapp://send?text=https://suite.social';
$promo = 'https://suite.social/tools';

$_SESSION['logo'] = $logo;
$_SESSION['background'] = $background;
$_SESSION['headline'] = $headline;
$_SESSION['caption'] = $caption;
$_SESSION['cta'] = $cta;
$_SESSION['share'] = $share;
$_SESSION['promo'] = $promo;

header("Location: ../index.php?r=demo");

