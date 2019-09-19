<?php
if( !session_id() ){
	session_start();
}
require_once("functions.php");


if(isset($_GET['id']))
{
    $url = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $parts = parse_url($url);
    $ids = explode('=', $parts['query']);
    $id = $ids[1];
    $GetDataId = explode("&", $id);
    $userID = $GetDataId[0];
    $PromotionID = $GetDataId[1];
    
    //all data will be assigned to $_SESSION
    get_promodata_by_id($PromotionID);

    if($_SESSION['PromotionID'] == $PromotionID)
    {
        //hashing the id so not easy to guess
        //hashing the id so not easy to guess
        //hashing the id so not easy to guess
        $hash_char = 's0c1i4l2020#@!';
        $hash = md5($PromotionID.$hash_char);
        
        if($_GET['code'] == $hash)
        {
            header("Location: https://suite.social/promo/offer.php?msg=success&parentid=".$PromotionID);
        }
        else
        {   
            //if there is cookies
            //then it is sharer and user must be already login
            if(isset($_COOKIE['PromotionID']))
            {
                header("Location: https://suite.social/promo/sharer.php");
            }
            else
            {
                header("Location: https://suite.social/promo/offer.php?id=".$id);
            }
        }
        
    }
}



/*$headline = 'FREE Android and iOS app for your business!';
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

header("Location: //suite.social/whatsapp/offer.php?r=MOBILE-APP");*/
?>