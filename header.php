<!DOCTYPE html>
<html lang="en">
    <head>

     <!-- Title -->
     <title><?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : 'WhatsApp Promotion'; ?></title>
     <!-- Meta Data -->
    <meta name="title" content="<?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : 'WhatsApp Promotion'; ?>">
    <meta name="description" content="<?php echo isset($_SESSION['caption']) && !empty($_SESSION['caption'])  ? $_SESSION['caption'] : 'Verify your WhatsApp number and share with contacts to unlock the promotion'; ?>">
    <meta name="keywords" content="whatsApp promotion, whatsApp marketing, content locker, phone verification, whatsapp message, verification code">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Suite.social">	
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />		

	<!-- Google Plus -->
	<!-- Update your html tag to include the itemscope and itemtype attributes. -->
	<!-- html itemscope itemtype="//schema.org/{CONTENT_TYPE}" -->
	<meta itemprop="name" content="<?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : 'WhatsApp Promotion'; ?>">
	<meta itemprop="description" content="<?php echo isset($_SESSION['caption']) && !empty($_SESSION['caption'])  ? $_SESSION['caption'] : 'Verify your WhatsApp number and share with contacts to unlock the promotion'; ?>">
	<meta itemprop="image" content="<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : 'https://suite.social/images/thumb/suite.jpg'; ?>">

	<!-- Twitter -->
	<meta name="twitter:card" content="<?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : 'WhatsApp Promotion'; ?>">
	<meta name="twitter:site" content="@SocialSuite>
	<meta name="twitter:title" content="<?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : 'WhatsApp Promotion'; ?>">
	<meta name="twitter:description" content="<?php echo isset($_SESSION['caption']) && !empty($_SESSION['caption'])  ? $_SESSION['caption'] : 'Verify your WhatsApp number and share with contacts to unlock the promotion'; ?>">
	<meta name="twitter:creator" content="@SocialSuite">
	<meta name="twitter:image:src" content="<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : 'https://suite.social/images/thumb/suite.jpg'; ?>">
	<meta name="twitter:player" content="">

	<!-- Open Graph General (Facebook & Pinterest) -->
	<meta property="og:url" content="<?php echo $current_url; ?>">
	<meta property="og:title" content="<?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : 'WhatsApp Promotion'; ?>">
	<meta property="og:description" content="<?php echo isset($_SESSION['caption']) && !empty($_SESSION['caption'])  ? $_SESSION['caption'] : 'Verify your WhatsApp number and share with contacts to unlock the promotion'; ?>">
	<meta property="og:site_name" content="Social Suite">
	<meta property="og:image" content="<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : 'https://suite.social/images/thumb/suite.jpg'; ?>">
	<meta property="og:type" content="product">
	<meta property="og:locale" content="en_UK">

	<!-- Open Graph Article (Facebook & Pinterest)-->
	<meta property="article:section" content="Marketing">
	<meta property="article:tag" content="Marketing">	

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />	
	<meta name="HandheldFriendly" content="true" />	

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="//suite.social/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="72x72" href="//suite.social/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="//suite.social/images/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="//suite.social/images/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="256x256" href="//suite.social/images/favicon/apple-touch-icon-256x256.png" />
	
	<!-- Chrome for Android web app tags -->
	<meta name="mobile-web-app-capable" content="yes" />
	<link rel="shortcut icon" sizes="256x256" href="//suite.social/images/favicon/apple-touch-icon-256x256.png" />	

    <!-- CSS --> 
    <link rel="stylesheet" href="//suite.social/src/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//suite.social/src/flip/flip.min.css">

    <!-- Social --> 
    <link rel="stylesheet" href="//suite.social/src/css/social-buttons.css">
 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
    <!-- Theme style -->
    <link rel="stylesheet" href="//suite.social/src/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="//suite.social/src/dist/css/skins/skin-black-light.min.css">	
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <!-- Google Font -->
    <!--<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    <link href="//fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://sdk.accountkit.com/en_EN/sdk.js"></script>
    <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> <!-- NEEDED FOR REVEAL -->	

<style>

/**************************************** BODY ****************************************/

body {
    overflow-x: hidden;
    color: #444;
    padding-right:0px !important;
    margin-right:0px !important;
}

a {
    color: #000;
}

a:hover, a:active, a:focus {
    color: #609450;
}

a:visited {
  color: #eee;
}

p {
    margin: 10px 0 10px;
}

.h1, .h2, .h3, h1, h2, h3, h4 {
    margin-top: 15px;
    margin-bottom:15px;
}

  @media screen and (max-width: 735px){
  .h3, h3 {
    font-size: 4vw;
	margin-top: 0px;
}
  }
  
  @media screen and (max-width: 735px){
.jumbotron p {
    font-size: 4vw;
}
  }
  
img {
    border-radius: 5px;
}

.box-title a:link { color: #609450; }

hr {
    border-top: 1px solid #ddd;
}

.navbar-brand {
    padding: 7px 15px;
}

.content-header {
    padding: 5px 15px 0 15px;
}

.main-footer {
    display: none;
}

.list-group {
    font-size: 20px;
}

.main-header {
    <?php echo isset($_SESSION['header']) && !empty($_SESSION['header'])  ? $_SESSION['header'] : 'display:none'; ?>;
}

.input-group .input-group-addon {
    color: #fff;
}

/**************************************** ADMIN UI ****************************************/

.skin-black-light .main-header li.user-header {
    background-color: #404040;
}

.skin-black-light .main-header .navbar {
    background-color: #404040;
}

.skin-black-light .main-header .logo {
    background-color: #404040;
}

.skin-black-light .wrapper, .skin-black-light .main-sidebar, .skin-black-light .left-side {
    background-color: #404040;
}

.skin-black-light .sidebar-menu>li.header {
    color: #999;
    background: #262626;
}

.skin-black-light .sidebar-menu>li.active>a {
    background: #8ec657;
}

.skin-black-light .sidebar-menu>li:hover>a {
    background: #609450;
}

.skin-black-light .sidebar a {
    color: #ccc;
}

.skin-black-light .sidebar-menu>li.active>a {
    border-left-color: #609450;
}

.skin-black-light .sidebar-menu>li>.treeview-menu {
    margin: 0 1px;
    background: #262626;
}

.skin-black-light .sidebar-menu>li:hover>a, .skin-black-light .sidebar-menu>li.active>a, .skin-black-light .sidebar-menu>li.menu-open>a {
    color: #fff;
    background: #8ec657;
}

.skin-black-light .sidebar-menu .treeview-menu>li>a {
    color: #999;
}

.skin-black-light .main-header .logo:hover {
    background-color: #404040;
}

.skin-black-light .main-header .navbar .sidebar-toggle:hover {
    background-color: #609450;
}

.content-wrapper {
    background-color: #FFF;
}

.content-header>.breadcrumb>li>a {
    color: #999;
}
        
.info-box-content {
    color: #333;
}   

.thumbnail {
    background-color: #404040;
    border: 1px solid #404040;
}

.box {
    background: #f5f5f5;
    border-radius: 5px;
}

.box.box-default {
    border-top-color: #8ec657;
}

.box-header.with-border {
    border-bottom: 1px solid #ddd;
}

.box.box-primary {
    border-top-color: #609450;
}

.small-box {
    /*border-radius: 5px;*/
    margin-bottom: 0px;
}

/**************************************** BUTTONS/BADGES ****************************************/

.btn-social>:first-child {
    width: 62px;
    line-height: 74px;
    font-size: 3.4em;
}

.btn-social {
    padding-left: 74px;
}

.btn-flex {
  display: flex;
  align-items: stretch;
  align-content: stretch;
}

.btn-flex .btn:first-child {
   flex-grow: 1;
   text-align: left;
}

.btn-app {
    border-radius: 3px;
    position: relative;
    padding: 5px 5px;
    margin: 0 0 10px 10px;
    min-width: 80px;
    height: 80px;
    width: 50%;
    text-align: center;
    color: #666;
    border: 1px solid #ddd;
    background-color: #f4f4f4;
    font-size: 18px;
}

.btn-success {
    background-color: #8ec657;
    border-color: #8ec657;
}

.btn-primary {
    background-color: #609450;
    border-color: #609450;
}

.btn-success:hover,
.btn-success:active,
.btn-success.hover {
  background-color: #609450;
  border-color: #609450;
}

.btn-primary:hover,
.btn-primary:active,
.btn-primary.hover {
  background-color: #8ec657;
  border-color: #8ec657;
}

.btn-success:focus,
.btn-success.focus {
  color: #fff;
    background-color: #609450;
    border-color: #609450;
}

.btn-primary:focus,
.btn-primary.focus {
  color: #fff;
    background-color: #8ec657;
    border-color: #8ec657;
}

.btn-success:active,
.btn-success.active,
.open > .dropdown-toggle.btn-primary {
  color: #fff;
    background-color: #8ec657;
    border-color: #8ec657;
}

.btn-primary:active,
.btn-primary.active,
.open > .dropdown-toggle.btn-primary {
  color: #fff;
    background-color: #609450;
    border-color: #609450;
}

.btn-success.active.focus, .btn-success.active:focus, .btn-success.active:hover, .btn-success:active.focus, .btn-success:active:focus, .btn-success:active:hover, .open>.dropdown-toggle.btn-success.focus, .open>.dropdown-toggle.btn-success:focus, .open>.dropdown-toggle.btn-success:hover {
    color: #fff;
    background-color: #8ec657;
    border-color: #8ec657;
}

.btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover {
    color: #fff;
    background-color: #609450;
    border-color: #609450;
}

.btn {
    border-radius: 5px;
}

.bg-success {
    background-color: #8ec657;
    color: #fff;
}

.bg-primary {
    color: #fff;
    background-color: #609450;
}

.bg-light-blue, .label-primary, .modal-primary .modal-body {
    background-color: #609450 !important;
}

.bg-black-light, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
    background-color: #8ec657 !important;
}

.bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
    background-color: #8ec657 !important;
}

.alert-info {
    border-color: #8ec657;
}

.alert-success {
    border-color: #8ec657;
}

.list-group-item {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
}

label {
    color: #609450;
}

.badge {
    font-size: 20px;
}

.btn-reddit{color:#fff;background-color:#ff680a;border-color:rgba(0,0,0,0.2)}.btn-reddit:focus,.btn-reddit.focus{color:#fff;background-color:#ff4006;border-color:rgba(0,0,0,0.2)}
.btn-reddit:hover{color:#fff;background-color:#ff4006;border-color:rgba(0,0,0,0.2)}
.btn-reddit:active,.btn-reddit.active,.open>.dropdown-toggle.btn-reddit{color:#fff;background-color:#ff4006;border-color:rgba(0,0,0,0.2)}.btn-reddit:active:hover,.btn-reddit.active:hover,.open>.dropdown-toggle.btn-reddit:hover,.btn-reddit:active:focus,.btn-reddit.active:focus,.open>.dropdown-toggle.btn-reddit:focus,.btn-reddit:active.focus,.btn-reddit.active.focus,.open>.dropdown-toggle.btn-reddit.focus{color:#fff;background-color:#98ccff;border-color:rgba(0,0,0,0.2)}
.btn-reddit:active,.btn-reddit.active,.open>.dropdown-toggle.btn-reddit{background-image:none}
.btn-reddit.disabled:hover,.btn-reddit[disabled]:hover,fieldset[disabled] .btn-reddit:hover,.btn-reddit.disabled:focus,.btn-reddit[disabled]:focus,fieldset[disabled] .btn-reddit:focus,.btn-reddit.disabled.focus,.btn-reddit[disabled].focus,fieldset[disabled] .btn-reddit.focus{background-color:#ff680a;border-color:rgba(0,0,0,0.2)}
.btn-reddit .badge{color:#ff680a;background-color:#000}

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

/**************************************** TABS ****************************************/

.nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
    background-color: #8ec657;
    color: #fff;
    font-size: 24px;
    border-radius: 20px 20px 0px 0px;
}

.nav-tabs-custom>.nav-tabs>li>a {
    font-size: 18px;
}

.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: transparent;
}

.navbar-nav>.messages-menu>.dropdown-menu>li .menu {
    overflow-x: inherit;
}

/**************************************** RESPONSIVE VIDEO ****************************************/

.vcontainer {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%;
}
.video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/**************************************** IMAGE ****************************************/

@media screen and (max-width: 735px){
.image-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: auto;
}
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

/**************************************** TIMER ****************************************/

.tick {
  font-size:1rem; white-space:nowrap; font-family:arial,sans-serif;
  margin: auto;
  width: 50%;
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

/**************************************** MODAL INVITER ****************************************/

#myModal .modal-header{
    background-color: rgb(35, 79, 173);
    color:white;padding:5px 10px;
}

#myModal .modal-body{
    padding: 10px;
    text-align: left;
    height: 82%;
    min-height:200px;
    background-color:#FFF !important;
}

.loadimage{
    clear:both;
    text-align:center;
    float:none;
    padding:20px 20px;
}   

/**************************************** MODAL SHARE ****************************************/

.modal-body {
overflow-x: hidden;
}

.modal.in .modal-dialog {
    width: 95%;
}

.modal {
 overflow-y: auto;
 background: #fff;
}

.modal-content {
    background-color: transparent;
	-webkit-box-shadow: none;
	box-shadow: none;
}

.modal-header {
    padding: 0px;
    border-bottom: 0px solid #fff;
}

.click-to-reveal-block {
  display: none;
}

</style>	

<!-- Hotjar Tracking Code for https://suite.social/promo/offer.php -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1453940,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>	

    </head>