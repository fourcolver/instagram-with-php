<?php

/**

 * 			SUITE.SOCIAL © 2018 || Social Inviter

 * ------------------------------------------------------------------------

 * 						** Configuration **

 * ------------------------------------------------------------------------

 */

session_start();

$headline = '50% Discount on Social Suite!';

$caption = 'Login to invite your contacts and share to claim this special offer';

$picture = 'https://suite.social/ssl_proxy.php?url=https://suite.social/images/bg/suite-app1.jpg';

$promo = 'https://suite.social/dashboard/members';

$share = 'https://suite.social/local';

$fbpage = 'https://facebook.com/www.suite.social';

$content = 'Check this out: https://suite.social/local - you will love it!';

$min_contacts = '50';



$_SESSION['headline'] = $headline;

$_SESSION['caption'] = $caption;

$_SESSION['picture'] = $picture;

$_SESSION['promo'] = $promo;

$_SESSION['share'] = $share;

$_SESSION['fbpage'] = $fbpage;

$_SESSION['content'] = $content;

$_SESSION['min_contacts'] = $min_contacts;



header("Location: //suite.social/login/index.php?r=SUITE-DISCOUNT");



