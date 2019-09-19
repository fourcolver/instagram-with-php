<!DOCTYPE html>
<html>
<head>

  <!-- Title -->
  <title>Social Sharer - <?php echo $headline; ?></title>

  <!-- Meta Data -->
  <meta name="title" content="<?php echo $headline; ?>">
  <meta name="description" content="<?php echo $caption; ?>">
  <meta name="keywords" content="<?php echo $network; ?> share, <?php echo $network; ?> content locker, <?php echo $network; ?> friend inviter, <?php echo $network; ?> share counter, <?php echo $network; ?> social locker, <?php echo $network; ?> social marketing, <?php echo $network; ?> social offer, <?php echo $network; ?> social promotion, <?php echo $network; ?> social referral, <?php echo $network; ?> social sharing, <?php echo $network; ?> link share, <?php echo $network; ?> visitor counter">
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
  <link rel="shortcut icon" type="image/x-icon" href="src/img/favicon.ico">

  <!-- Css -->
  <link rel="stylesheet" href="src/css/bootstrap.min.css">
  <link rel="stylesheet" href="src/css/normalize.css">
   
  <!-- Social --> 
  <link rel="stylesheet" href="//suite.social/src/css/social-buttons.css">
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="src/css/AdminLTE.min.css">
  <link rel="stylesheet" href="src/css/skins/skin-black-light.min.css">

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
    font-size: 3.4em;
}

@media screen and (max-width: 735px){
#share {
	font-size: 26px;
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

</style>

</head>