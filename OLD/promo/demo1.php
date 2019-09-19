<?php
/**
 * 			SUITE.SOCIAL © 2019 || WhatsApp Promo
 * ------------------------------------------------------------------------
 * 						** Configuration **
 * ------------------------------------------------------------------------
 */
session_start();
$logo = '';
$background = '';
$headline = '';
$caption = 'Login with WhatsApp number and share to unlock the promotion';
$cta = '';
$share = 'whatsapp://send?text=';
$promo = '';

$_SESSION['logo'] = $logo;
$_SESSION['background'] = $background;
$_SESSION['headline'] = $headline;
$_SESSION['caption'] = $caption;
$_SESSION['cta'] = $cta;
$_SESSION['share'] = $share;
$_SESSION['promo'] = $promo;

header("Location: ../index.php?r=demo");

