<?php
	
//current url of file
$uri = $_SERVER['REQUEST_URI'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];		
		
/// GENERAL	
$logo = 'https://suite.social/images/logo/suite.jpg';	
$website = 'https://suite.social';	

/// SOCIAL
$whatsapp = 'https://api.whatsapp.com/send?phone=447876806121&text=Click%20this%20link%20in%20whatsapp%20to%20verify:%20https://suite.social/promo/ref.php';	
$facebook = 'socialgrower';	
$twitter = 'socialsuite';	
$youtube = 'UCPnGqt2k5XS8gxuy0tPHkpg';	
$tumblr = 'suitesocial';	
$pinterest = 'suitesocial';	
$linkedin = '15793141';	
	
/// DISCOUNT	
$image = 'https://suite.social/images/mockup/publisher.jpg';	
$headline = 'Headline here';
$caption = 'Caption here';
$link = 'https://api.whatsapp.com/send?phone=447876806121&text=I%20want%20to%20get%2050%20percent%20off%20social%20suite%20and%20become%20an%20affiliate';	
$currency = '€'; // The currency symbol.
$price = '199';	// How much the original price was.
$discount = '99'; // How much they can buy at.

/********** DO NOT EDIT **********/
$color = '#3b5998';
$shareurl = '';
$type = 'Discount';

$_SESSION['logo'] = $logo;
$_SESSION['website'] = $website;	
$_SESSION['network'] = $network;
$_SESSION['color'] = $color;
$_SESSION['shareurl'] = $shareurl;
$_SESSION['type'] = $type;
$_SESSION['image'] = $image;
$_SESSION['headline'] = $headline;
$_SESSION['caption'] = $caption;	
$_SESSION['link'] = $link;		
$_SESSION['currency'] = $currency;	
$_SESSION['price'] = $price;
$_SESSION['discount'] = $discount;
?>

<!DOCTYPE html>
<html>
<head>

  <!-- Title -->
  <title>Social Sharer - <?php echo $headline; ?></title>

  <!-- Meta Data -->
  <meta name="title" content="<?php echo $headline; ?>">
  <meta name="description" content="<?php echo $caption; ?>">
  <meta name="keywords" content="social media share, social media content locker, social media friend inviter, social media share counter, social media social locker, social media social marketing, social media social offer, social media social promotion, social media social referral, social media social sharing, social media link share, social media visitor counter">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="author" content="<?php echo $current_url; ?>">	
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />	
		 
  <!-- Twitter -->
  <meta name="twitter:card" content="<?php echo $headline; ?>">
  <meta name="twitter:title" content="<?php echo $headline; ?>">
  <meta name="twitter:description" content="<?php echo $caption; ?>">
  <meta name="twitter:image:src" content="<?php echo $image; ?>">
  
  <!-- Open Graph General (Facebook & Pinterest) -->
  <meta property="og:url" content="<?php echo $current_url; ?>">
  <meta property="og:title" content="<?php echo $headline; ?>">
  <meta property="og:description" content="<?php echo $caption; ?>">
  <meta property="og:image" content="<?php echo $image; ?>">
  <meta property="og:type" content="product">

  <!-- Open Graph Article (Facebook & Pinterest) -->
  <meta property="article:section" content="Marketing">
  <meta property="article:tag" content="Marketing">    
  
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />	
  <meta name="HandheldFriendly" content="true" />	
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="https://suite.social/promo/sharer/src/img/favicon.ico">

  <!-- CSS -->
  <link rel="stylesheet" href="https://suite.social/promo/sharer/src/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://suite.social/promo/sharer/css/normalize.css">
  <link rel="stylesheet" href="https://suite.social/promo/sharer/src/flip/flip.min.css" >
	
  <!-- JQuery -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>	
   
  <!-- Social --> 
  <link rel="stylesheet" href="https://suite.social/promo/sharer/src/css/social-buttons.css">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="https://suite.social/promo/sharer/src/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://suite.social/promo/sharer/src/css/skins/skin-black-light.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>

/**************************************** BODY ****************************************/

a:hover, a:active, a:focus {
    color: #609450;
}

a {
    color: #000;
}
  
.content-wrapper {
    padding-top: 0px;
    background-color: #fff;
}

h1 {
	margin-top: 10px;
    margin-bottom: 10px;
	text-align: center;
}

img {
    border-radius: 5px;
}

.box {
    background: #f5f5f5;
    border-radius: 5px;
}

/**************************************** BUTTONS ****************************************/

.btn-social>:first-child {
    width: 62px;
    line-height: 60px;
    font-size: 3.5em;
}

@media screen and (max-width: 735px){
#share {
	font-size: 26px;
}
  }
  
@media only screen and (min-device-width : 320px) and (max-device-width : 480px){ 
#share {
	font-size: 16px;
}
.btn-social>:first-child {
    line-height: 30px;
    font-size: 2.5em;
}
  }
  
.btn-reddit{color:#fff;background-color:#ff680a;border-color:rgba(0,0,0,0.2)}.btn-reddit:focus,.btn-reddit.focus{color:#fff;background-color:#ff4006;border-color:rgba(0,0,0,0.2)}
.btn-reddit:hover{color:#fff;background-color:#ff4006;border-color:rgba(0,0,0,0.2)}
.btn-reddit:active,.btn-reddit.active,.open>.dropdown-toggle.btn-reddit{color:#fff;background-color:#ff4006;border-color:rgba(0,0,0,0.2)}.btn-reddit:active:hover,.btn-reddit.active:hover,.open>.dropdown-toggle.btn-reddit:hover,.btn-reddit:active:focus,.btn-reddit.active:focus,.open>.dropdown-toggle.btn-reddit:focus,.btn-reddit:active.focus,.btn-reddit.active.focus,.open>.dropdown-toggle.btn-reddit.focus{color:#fff;background-color:#98ccff;border-color:rgba(0,0,0,0.2)}
.btn-reddit:active,.btn-reddit.active,.open>.dropdown-toggle.btn-reddit{background-image:none}
.btn-reddit.disabled:hover,.btn-reddit[disabled]:hover,fieldset[disabled] .btn-reddit:hover,.btn-reddit.disabled:focus,.btn-reddit[disabled]:focus,fieldset[disabled] .btn-reddit:focus,.btn-reddit.disabled.focus,.btn-reddit[disabled].focus,fieldset[disabled] .btn-reddit.focus{background-color:#ff680a;border-color:rgba(0,0,0,0.2)}
.btn-reddit .badge{color:#ff680a;background-color:#000}

/**************************************** MODAL ****************************************/
	
.modal-dialog {
  width: 95%;
}

.modal-body {
    background: #F9F9F9;
}

.bg-green {
    background-color: #1f1f1f !important;
    color: #fff !important;
}

.widget-user-2 .widget-user-header {
    padding-top: 0px;
}

.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #609450;
}


/**************************************** COUNTER/PROMO ****************************************/

#counter {
	color: #fff;
	font-size: 5.7vw;
	font-weight: bold;
	padding:5px; 
	border:5px solid #fff;
	border-radius: 10px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);	
	background: #333232;
	background: -moz-linear-gradient(top,  #333232 0%, #333232 50%, #333232 50%, #000000 50%, #333232 100%);
	background: -webkit-linear-gradient(top,  #333232 0%,#333232 50%,#333232 50%,#000000 50%,#333232 100%);
	background: linear-gradient(to bottom,  #333232 0%,#333232 50%,#333232 50%,#000000 50%,#333232 90%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#333232', endColorstr='#333232',GradientType=0 );
}

#promo {
   color: #fff;
   font-size: 5.7vw;
   font-weight: bold;	
   padding: 10px;	
   border: 2px dashed #fff;
   border-radius: 10px;  
   background: <?php echo $color; ?>;
   margin: 10px;   
   box-shadow: 0 0 0 4px <?php echo $color; ?>, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
   text-shadow: -1px -1px <?php echo $color; ?>;
}

/**************************************** TIMER ****************************************/

.tick {
  font-size:1rem; white-space:nowrap; font-family:arial,sans-serif;
  margin: auto;
  width: 100%;
}

@media screen and (max-width: 735px){
.tick {
  font-size:1rem; white-space:nowrap; font-family:arial,sans-serif;
  margin: auto;
  width: 100% !important;
}
  }

.tick-flip,.tick-text-inline {
  font-size:2.5em;
}

.tick-label {
  margin-top:1em;font-size:1em;
}

.tick-char {
  width:1.5em;
}

.tick-text-inline {
  display:inline-block;text-align:center;min-width:1em;
}

.tick-text-inline+.tick-text-inline {
  margin-left:-.325em;
}

.tick-group {
  margin:0 .5em;text-align:center;
}

.tick-flip-panel-text-wrapper {
   line-height: 1.45 !important; 
}

.tick-flip {
   border-radius:0.12em !important; 
}

</style>

<!-- 1. Include jQuery and the plugin files in to your page -->
<script src="js/libs/jquery.min.js"></script>
<script src="js/libs/jquery.ui.highlight.min.js"></script>
<script src="js/pandalocker.2.3.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/pandalocker.2.3.1.min.css">

<!-- 2. Generate And Paste Locker Code -->
<script>
jQuery(document).ready(function ($) {
   $('.to-lock').sociallocker({
	text:{
	   header: 'This offer is locked',
	   message: 'Please support us, only 3 steps away from claiming this offer. Use one of the buttons below to unlock first.'
	},
	theme: 'secrets',
	overlap:{
	   position: 'scroll'
	},
	googleAnalytics: true,
	facebook:{
	   like:{
	      url: 'https://suite.social'
	   }
	},
	twitter:{
	   follow:{
	      url: 'https://twitter.com/socialsuite'
	   }
	},
	youtube:{
	   subscribe:{
	      channelId: 'UC_of_sqFmklXOV2r6q7-oBA',
	      clientId: '829404683676-kqe8n9hv25bk4l87niogr7kdn0jommq3.apps.googleusercontent.com'
	   }
	},
	buttons:{
	   order: ["facebook-like","twitter-follow","youtube-subscribe"],
	   counters: false,
	   lazy: true
	}
   });
});
</script>

</head>

<body class="hold-transition skin-black-light layout-top-nav">

  <!-- Full Width Column -->
  <div class="content-wrapper">  
  
    <div style="width:100%" class="container">
  
<div class="row">
            <div class="box-default">
            <div class="box-header with-border text-center">
		    <p><a href="<?php echo $website; ?>" target="_blank"><img height="80px" src="<?php echo $logo; ?>" alt="Logo"></a></p>
            <h1 style="font-size: 48px;"><b><?php echo $headline; ?></b></h1>
            <h3><?php echo $caption; ?></h3><br>						  
            </div>
            <!-- /.box-header --> 
			
                    <div class="box-body">
                        <div class="col-md-6">      
						<p><a href="<?php echo $website; ?>" target="_blank"><img width="100%" src="<?php echo $image; ?>" alt="Image"></a></p>
						
						<p><strong>Only 3 steps to claim this offer!</strong></p>
						<p>1. Like/follow</p>
						<p>2. Enter WhatsApp number</p>
						<p>3. Share with friends</p>

                        <!--<p><a class="btn btn-lg btn-block btn-social btn-github" href="<?php echo $website; ?>" target="_blank"><i class="fa fa-link"></i> VISIT OUR WEBSITE!</a></p>-->						
									
						</div>                  

                        <div class="col-md-6">
						
<div class="box text-center">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="src/img/profile.jpg" alt="Profile picture">

              <h3 class="profile-username text-center">Hi lucky user! Thanks for visiting.</h3>
              
              <p class="text-muted text-center">Only 3 steps to claim <?php echo $headline; ?></p>  

<!---TIMER--->

<h4>Offer ends in:</h4>	
<div class="tick" data-did-init="handleTickInit">

    <div data-repeat="true" data-layout="horizontal fit" data-transform="preset(d, h, m, s) -> delay">

        <div class="tick-group">

            <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">

                <span data-view="flip"></span>

            </div>

            <span data-key="label" data-view="text" class="tick-label"></span>

        </div>

    </div>

</div>
<hr>

<script>
    function handleTickInit(tick) {

        // define the countdown schedule using natural language,
        // you can find some example schedules below.

        // - 'every hour'
        // - 'every minute'
        // - 'every 2 hours'
        // - 'every 10 minutes'
        // - 'every 45 seconds'
        // - 'till 10 every hour'
        // - 'from 13 every hour'
        // - 'from 12 till 15 every hour'
        // - 'every hour wait 10 minutes'
        // - 'every day at 13:15:40'
        // - 'every day at 11'
        // - 'every day at 11 wait 2 hours'
        // - 'every monday at 12'
        // - 'every sunday at 11 wait 2 hours'
        // - 'sunday every hour from 10 till 12'
        // - 'sunday every hour wait 10 minutes'
        // - 'every 1st day of the month at 12:00'
        // - 'every 2nd day of the month at 12:00'
        // - 'every first day of the month at 12:00'
        // - 'every last day of the month at 12:00'
        // - 'every 1st day of the month at 11:55 wait 10 minutes'
        // - 'every 2nd day of the month from 10 till 14 every hour wait 10 minutes'
        // - 'every januari the 12th at 12:00'
        // - 'every 12th of januari at 12:00'

        // create the schedule counter
        Tick.count.schedule('every hour').onupdate = function(value) {
            tick.value = value;
        }
    }
</script>	

        <div class="to-lock" style="text-align: center;">
		
            <div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="<?php echo $whatsapp; ?>" class="btn btn-block btn-social btn-whatsapp">
                    <i style="padding-top:20px; padding-bottom:20px" class="fas fa-share-alt fa-5x"></i> <h1 id="share">WhatsApp us!</h1>					
                </a>				
            </div>
		
<?php

$ref=$_SERVER['HTTP_REFERER'];
$ref_site = parse_url($ref, PHP_URL_HOST);

$data_array = array
(
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Social Suite sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "suite.social",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Facebook sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "facebook.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Pinterest sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "pinterest.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified VK sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "vk.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Livejournal sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "livejournal.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Linkedin sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "linkedin.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Stumbleupon sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "stumbleupon.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Xing sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "xing.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified WhatsApp sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "wa.me",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Skype sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "skype.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Twitter sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "twitter.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Twitter sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "t.co",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Reddit sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "reddit.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Tumblr sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "tumblr.com",
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Flipboard sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "flipboard.com",	  		  
"<div class='alert alert-success fade in alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>SUCCESS!</strong> You have verified Telegram sharing, click the button below to claim offer.</div><div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Claim' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-gift fa-5x'></i> <h1 id='share'>CLAIM NOW!</h1></a></div>" => "telegram.me"
);

if (in_array("$ref_site" ,  $data_array))
{
echo array_search("$ref_site" , $data_array);
} else {
echo "<div class='social-buttons'><a style='padding-top:20px; padding-bottom:20px' href='#Share' data-toggle='modal' class='btn btn-block btn-social btn-facebook'><i style='padding-top:20px; padding-bottom:20px' class='fas fa-share-alt fa-5x'></i> <h1 id='share'>Share to unlock offer!</h1></a></div>";
}

?>
            <!--<div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="#Share" data-toggle="modal" class="btn btn-block btn-social btn-<?php echo $network; ?>">
                    <i style="padding-top:20px; padding-bottom:20px" class="fas fa-share-alt fa-5x"></i> <h1 id="share">Share with friends!</h1>					
                </a>				
            </div>-->

        </div>			
								                                                                                
            </div>
            <!-- /.box-body -->
          </div>
		  
                                                                                    
                        </div>

                    </div>
                </div>              
                                     
        </div> 

<!-- ====================================================================== MODALS ====================================================================== -->

<!----------------------------------------Claim---------------------------------------->
		
        <div class="modal fade" id="Claim">
          <div class="modal-dialog">
            <div class="modal-content">
			
              <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
				<h2 style="font-size: 72px; font-weight: 300;" class="text-danger">Claim <?php echo $headline; ?></h2>
				
              </div>			
			
      <div class="modal-body">
	  
<div class="row">
            <div class="col-md-12">
                <div>
                    <div class="box-body">

            <div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="<?php echo $link; ?>" class="btn btn-block btn-social btn-google">
                    <i style="padding-top:20px; padding-bottom:20px" class="fas fa-gift fa-5x"></i> <h1 id="share">CLICK HERE TO CLAIM NOW!</h1>					
                </a>				
            </div>

                    </div>
                </div>
            </div>						
        </div>		
	
      </div>
              <!--<div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>-->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal --> 

<!----------------------------------------SHARE---------------------------------------->
		
        <div class="modal fade" id="Share">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div align="center" class="modal-body">
		
	<h3>1. Share on preferred social network</h3>
	<h3>2. Click the link in the post to verify sharing</h3>
	<h3>3. Your offer will be unlocked</h3>
	<br>
	  	  	  
<!--******************** SHARE BUTTONS ********************--->

      <div class="row">
        <div class="col-xs-4">
              <p><a href="https://www.facebook.com/sharer.php?u=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-facebook"><i class="fab fa-facebook fa-2x"></i> Facebook</a></p>
			  <p><a href="https://pinterest.com/pin/create/bookmarklet/?media=https:<?php echo $image; ?>&url=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-pinterest"><i class="fab fa-pinterest fa-2x"></i> Pinterest</a></p>			 			  
              <p><a href="http://vk.com/share.php?url=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-instagram"><i class="fab fa-vk fa-2x"></i> VK</a></p>		
              <p><a href="https://www.blogger.com/blog-this.g?u=<?php echo $current_url; ?>&n=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-blogger"><i class="fab fa-blogger fa-2x"></i> Blogger</a></p>
              <p><a href="http://www.livejournal.com/update.bml?subject=<?php echo $headline; ?>&event=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-livejournal"><i class="fas fa-pencil-alt fa-2x"></i> LiveJournal</a></p>	
              <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to&su=Recommendation&body=<?php echo $current_url; ?>+&ui=2&tf=1&shva=1" target="_blank" class="btn btn-block btn-lg btn-social btn-google"><i class="fas fa-envelope fa-2x"></i> Gmail</a></p>			  
        </div>		

        <div class="col-xs-4">	
			  <p><a href="http://digg.com/submit?url=<?php echo $current_url; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-digg"><i class="fab fa-digg fa-2x"></i> Digg</a></p>
			  <p><a href="https://www.linkedin.com/shareArticle?url=<?php echo $current_url; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-linkedin"><i class="fab fa-linkedin fa-2x"></i> Linkedin</a></p>		
              <p><a href="http://www.stumbleupon.com/submit?url=<?php echo $current_url; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-stumbleupon"><i class="fab fa-stumbleupon fa-2x"></i> Stumbleupon</a></p>	
              <p><a href="https://www.xing.com/app/user?op=share&url=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-xing"><i class="fab fa-xing fa-2x"></i> Xing</a></p>
              <p><a href="https://wa.me/?text=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-whatsapp"><i class="fab fa-whatsapp fa-2x"></i> WhatsApp</a></p>	
              <p><a href="https://web.skype.com/share?url=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-skype"><i class="fab fa-skype fa-2x"></i> Skype</a></p>				  
        </div>		
		
        <div class="col-xs-4">	
              <p><a href="https://twitter.com/intent/tweet?url=<?php echo $current_url; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-twitter"><i class="fab fa-twitter fa-2x"></i> Twitter</a></p>		  
              <p><a href="https://reddit.com/submit?url=<?php echo $current_url; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-reddit"><i class="fab fa-reddit fa-2x"></i> Reddit</a></p>				  
			  <p><a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $current_url; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-tumblr"><i class="fab fa-tumblr fa-2x"></i> Tumblr</a></p>
              <p><a href="https://share.flipboard.com/bookmarklet/popout?v=2&title=<?php echo $headline; ?>&url=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-flipboard"><i class="fab fa-flipboard fa-2x"></i> Flipboard</a></p>			  		  
              <p><a href="https://telegram.me/share/url?url=<?php echo $current_url; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-telegram"><i class="fab fa-telegram fa-2x"></i> Telegram</a></p>		
              <p><a href="http://compose.mail.yahoo.com/?body=<?php echo $current_url; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-yahoo"><i class="fab fa-yahoo fa-2x"></i> Yahoo Mail</a></p>		
			  
        </div>		
		
      </div>
					  
              </div>
              <!--<div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>-->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal --> 	

    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- =================FOOTER====================== -->

<?php require_once 'footer.php'; ?> 

