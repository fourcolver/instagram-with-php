<?php 
/**
 * Plugin constants
 */
error_reporting('0');

define('BASE_URL','./'); //please update this

define('BASE', __DIR__);

require_once 'src/pluginreader.php'; 
$reader = new pluginReader();

if (isset($_FILES["zip_file"]["name"]) && $_FILES["zip_file"]["name"]) {
    $reader->readPlugin();
}
if(isset($_GET['action']) && $_GET['action'] == 'getcontent'){
    //sorry no sanitization this time
    $pluginname = $_GET['plgname'];
    print $reader->getPluginContent($pluginname); exit;
}

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $pluginname = $_GET['plgname'];
    echo $reader->deletePlugin($pluginname);
}

//load the plugins for display purpose, reading from files
$plugins = $reader->getAllPlugins();

//count number of promotions
$directory = "promo/";
$filecount = 0;
$files = glob($directory . "*.{php}",GLOB_BRACE);
if ($files){
 $filecount = count($files);
}

?>

<!DOCTYPE html>
<html>
<head>

    <!-- Title -->
    <title>Social Promotion Manager</title>

    <!-- Meta Data -->
    <meta name="title" content="Social Promotion Manager">
    <meta name="description" content="Allows visitors to like/follow your social profiles, verify there WhatsApp number and share with friends to claim your promotion.">
    <meta name="keywords" content="content locker, follow locker, like locker, phone verification, verification codeviral marketing, whatsapp message, whatsapp promotion">
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
	<meta itemprop="name" content="Social Promotion Manager">
	<meta itemprop="description" content="Allows visitors to like/follow your social profiles, verify there WhatsApp number and share with friends to claim your promotion.">
	<meta itemprop="image" content="//suite.social/images/thumb/suite.jpg">
	
	<!-- Twitter -->
	<meta name="twitter:card" content="Social Promotion Manager">
	<meta name="twitter:site" content="@socialgrower">
	<meta name="twitter:title" content="Social Promotion Manager">
	<meta name="twitter:description" content="Allows visitors to like/follow your social profiles, verify there WhatsApp number and share with friends to claim your promotion.">
	<meta name="twitter:creator" content="@socialgrower">
	<meta name="twitter:image:src" content="//suite.social/images/thumb/suite.jpg">
	<meta name="twitter:player" content="">
	
	<!-- Open Graph General (Facebook & Pinterest) -->
	<meta property="og:url" content="//suite.social">
	<meta property="og:title" content="Social Promotion Manager">
	<meta property="og:description" content="Allows visitors to like/follow your social profiles, verify there WhatsApp number and share with friends to claim your promotion.">
	<meta property="og:site_name" content="Social Suite">
	<meta property="og:image" content="//suite.social/images/thumb/suite.jpg">
	<meta property="og:type" content="product">
	<meta property="og:locale" content="en_UK">

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
    <link rel="shortcut icon" type="image/x-icon" href="//suite.social/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="72x72" href="//suite.social/images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="//suite.social/images/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="//suite.social/images/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="256x256" href="//suite.social/images/favicon/apple-touch-icon-256x256.png" />
	
	<!-- Chrome for Android web app tags -->
	<meta name="mobile-web-app-capable" content="yes" />
	<link rel="shortcut icon" sizes="256x256" href="//suite.social/images/favicon/apple-touch-icon-256x256.png" />

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://suite.social/src/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Social --> 
    <link rel="stylesheet" href="https://suite.social/src/css/social-buttons.css">

    <!-- Flip --> 
	<link rel="stylesheet" href="https://suite.social/src/flip/flip.min.css">

    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="//suite.social/src/src/bower_components/font-awesome/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
    <!-- Theme style -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>		
    <link rel="stylesheet" href="https://suite.social/src/dist/css/AdminLTE.min.css">
    
	<!-- AdminLTE Skins -->
    <link rel="stylesheet" href="https://suite.social/src/dist/css/skins/skin-black-light.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  	
	<!-- DataTables -->
    <!--<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />-->
	<link rel="stylesheet" href="//suite.social/src/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		
	<!-- Google Font -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<!-- <script src="https://sdk.accountkit.com/en_EN/sdk.js"></script> -->
<style type="text/css">

/**************************************** BODY ****************************************/

a:hover, a:active, a:focus {
    color: #609450;
}

a {
    color: #000;
}

.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 20px;
    margin-bottom: 20px;
}

  @media screen and (max-width: 735px){
  .h3, h3 {
    font-size: 4vw;
	margin-top: 0px;
}
  }
  
  @media screen and (max-width: 735px){
  .h1, h1 {
    font-size: 7vw;
}
  }
  
  @media screen and (max-width: 735px){
.jumbotron p {
    font-size: 4vw;
}
  }
  
.content-wrapper {
    background-color: transparent;
}

.input-group .input-group-addon {
    color: #fff;
}

/**************************************** ADMIN UI ****************************************/

.main-header .fa-bars {
    float: left;
    padding: 18px 15px;
    color: #333;
    border-right: 1px solid #d2d6de;
}

.chat {
    overflow-y: scroll;
    height: 300px;
}

.box-header .box-title {
    font-size: 30px;
	margin-top: 0;
	margin-bottom: 10px;
    line-height: 2;
}

/**************************************** BUTTONS & LABELS ****************************************/

.btn-social {
    padding-left: 84px;
}

.btn-social>:first-child {
    width: 74px;
    line-height: 80px;
    font-size: 4.6em;
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
    font-weight: normal;
}

.text-primary {
    color: #609450;;
}

.info-box {
    color: #fff;
}

/**************************************** TABS ****************************************/

.nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
    background-color: #8ec657;
    color: #fff;
    font-size: 24px;
    border-radius: 10px 10px 0px 0px;
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

/**************************************** FORMS/TABLES ****************************************/

.form-group.has-success label {
    color: #609450;
}

.form-group.has-success .form-control, .form-group.has-success .input-group-addon {
    border-color: #609450;
}

.form-group.has-success .help-block {
    color: #609450;
}

.input-group .input-group-addon {
    color: #444;
}

.form-horizontal .form-group {
    margin-right: 0px;
    margin-left: 0px;
}

.form-group {
    margin-bottom: 0px;
}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #F5F5F5;
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    background-color: #609450;
    border-color: #609450;
}

/**************************************** TIMER ****************************************/

.tick {
    font-size: 1rem;
    white-space: nowrap;
    font-family: arial,sans-serif;
    margin: auto;
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
table.dataTable thead .sorting:after {
    opacity: 0 !important;
    content: "\e150";
}

/**************************************** IMAGE ****************************************/

@media screen and (max-width: 735px){
.image-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: auto;
}
  }
  
.thumbnail {
    padding: 0px;
    margin-bottom: 0px;
}
  
.thumbnail:hover {
    border: 0;
    position:relative;
    top:-25px;
    left:-35px;
    width:250px;
    height:auto;
    display:block;
    z-index:999;
}
  
</style>	

<!-- Jquery -->
<script src="//code.jquery.com/jquery-1.12.4.js"></script>	
<!--<script src="//suite.social/src/bower_components/jquery/dist/jquery.min.js"></script>-->
<script src="js/popper.min.js"></script>
				
</head>

<body class="hold-transition skin-black-light sidebar-collapse sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Promotion</b> Manager</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="fas fa-bars" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	  
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		
          <!-- Sharelocks Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-users"></i>
              <span class="label label-success"><?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{
               //echo file_get_contents( "share_count.txt" );
                $data = file_get_contents('promouserdata.json');
                $promotion = json_decode($data, true);
                $Usercnt = 0;
                if(!empty($promotion)) {
                    
                    //remove duplicate phone number
                    $new_infos = array();
                    foreach ($promotion as $key => $info) 
                    {
                      $new_infos[$info['user']['promoid'].$info['user']['number']] = $info;
                    }
                    $promotion = $new_infos;
                    
                    foreach ($promotion as $key => $value) {
                        if($value['user']['referadminid'] == $_SESSION['dashboard_uid']) { $Usercnt++;}
                    }
                }
                echo $Usercnt;
              } ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Users Verified</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fas fa-users text-primary"></i> <?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{
               //echo file_get_contents( "share_count.txt" );
                $data = file_get_contents('promouserdata.json');
                $promotion = json_decode($data, true);
                $Usercnt = 0;
                if(!empty($promotion)) {
                  
                    //remove duplicate phone number
                    $new_infos = array();
                    foreach ($promotion as $key => $info) 
                    {
                      $new_infos[$info['user']['promoid'].$info['user']['number']] = $info;
                    }
                    $promotion = $new_infos;
                    
                    foreach ($promotion as $key => $value) {
                        if($value['user']['referadminid'] == $_SESSION['dashboard_uid']) { $Usercnt++;}
                    }
                }
                echo $Usercnt;
              } ?> Users
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="users.php">View all</a></li>
            </ul>
          </li>

          <!-- Visitors Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fab fa-whatsapp"></i>
              <span class="label label-success"><?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{ 
	              	//echo file_get_contents( "share_count.txt" );
                  $share = array();
                  
	              	$sharecountdata = file_get_contents('sharecount.json');
	                $sharecount = json_decode($sharecountdata, true);
	                $Sharecnt = 0;
	                if(!empty($sharecount)) 
                  {
	                    $TotalRow = count($sharecount);
                      $Sharecnt = 0;
                      for($i=0;$i<$TotalRow;$i++) 
                      {
                          //this will be used in datatable in campaign/promo
                          $share[$sharecount[$i]['promoid']] = $sharecount[$i]['ShareCount'];
                          
                          if($sharecount[$i]['AdminID'] == $_SESSION['dashboard_uid']) 
                          {
                            $Sharecnt += $sharecount[$i]['ShareCount'];
                          }
                      }
	                }
                  
	                echo $Sharecnt;
              	} ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Total Shares</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fas fa-users text-primary"></i> 
                      <?php 
                      
                      if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin']))
                      { 
                        echo "0"; 
                      }
                      else
                      { 
                        echo $Sharecnt;
                      } ?> Shares
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="users.php">View all</a></li>
            </ul>
          </li>
		  
          <!-- Users Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-gift"></i>
              <span class="label label-success"><?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{ 
                //echo $filecount;
                $data = file_get_contents('promotiondata.json');
                $promotion = json_decode($data, true);
                $Promocnt = 0;
                if(!empty($promotion)) {
                    foreach ($promotion as $key => $value) {
                        if($value['UserID'] == $_SESSION['dashboard_uid']) { $Promocnt++;}
                    }
                }
                echo $Promocnt;
              } ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Total Promotions</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fas fa-users text-primary"></i> <?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{ 
                //echo $filecount;
                $data = file_get_contents('promotiondata.json');
                $promotion = json_decode($data, true);
                $Promocnt = 0;
                if(!empty($promotion)) {
                    foreach ($promotion as $key => $value) {
                        if($value['UserID'] == $_SESSION['dashboard_uid']) { $Promocnt++;}
                    }
                }
                echo $Promocnt;
              } ?> Promotions
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="index.php">View all</a></li>
            </ul>
          </li>	

          <!-- Plugins Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-plug"></i>
              <span class="label label-success total_plugins"><?php echo (sizeof($plugins)) ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Total Plugins</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fas fa-users text-primary"></i> <?php echo (sizeof($plugins)) ?> Plugins
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="plugins.php">View all</a></li>
            </ul>
          </li>		  
		  
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="//suite.social/images/profile/Admin.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="//suite.social/images/profile/Admin.png" class="img-circle" alt="User Image">

                <p>
                  WhatsApp Admin
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
		  
          <!-- Control Sidebar Toggle Button 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="//suite.social/images/profile/Admin.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>WhatsApp Admin</p>
          <!-- Status -->
          <a href="#"><i class="fas fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
		<li><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
		<li><a href="index.php"><i class="fas fa-gift"></i> <span>Promotion</span></a></li>	
		<li><a href="users.php"><i class="fas fa-users"></i> <span>Users</span></a></li>
		<li><a href="javascript:void(0);" onclick="alert('Add coupons, embed video, audio, ebooks and more. Coming soon!');"><i class="fas fa-plug"></i> <span>Plugins</span></a></li>
		<li><a href="//suite.social/#contact" target="_blank"><i class="fas fa-envelope"></i> <span>Contact</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->  
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
	
    <!-- Main content -->
    <section class="content">	

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{
               //echo file_get_contents( "share_count.txt" );
                $data = file_get_contents('promouserdata.json');
                $promotion = json_decode($data, true);
                $Usercnt = 0;
                if(!empty($promotion)) {
                  
                    //remove duplicate phone number
                    $new_infos = array();
                    foreach ($promotion as $key => $info) 
                    {
                      $new_infos[$info['user']['promoid'].$info['user']['number']] = $info;
                    }
                    $promotion = $new_infos;
                                
                    foreach ($promotion as $key => $value) {
                        if($value['user']['referadminid'] == $_SESSION['dashboard_uid']) { $Usercnt++;}
                    }
                }
                echo $Usercnt;
              } ?></h3>

              <p>Users Verified</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="users.php" class="small-box-footer">View users <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                <?php 
                  if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin']))
                  { 
                    echo "0"; 
                  }
                  else
                  { 
                    echo $Sharecnt;
                  } ?>
              </h3>
              <p>Total Shares</p>
            </div>
            <div class="icon">
              <i class="fab fa-whatsapp"></i>
            </div>
            <a href="javascript:reset_share_stats();" onclick="return confirm('Are you sure want to restart the stats counter?')" class="small-box-footer">
              Reset Stats <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{ 
                //echo $filecount;
                $data = file_get_contents('promotiondata.json');
                $promotion = json_decode($data, true);
                $Promocnt = 0;
                if(!empty($promotion)) {
                    foreach ($promotion as $key => $value) {
                        if($value['UserID'] == $_SESSION['dashboard_uid']) { $Promocnt++;}
                    }
                }
                echo $Promocnt;
              } ?></h3>

              <p>Total Promotions</p>
            </div>
            <div class="icon">
              <i class="fas fa-gift"></i>
            </div>
            <a href="index.php" class="small-box-footer">Create Promo <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3 class="total_plugins"><?php if(!isset($_SESSION['dashboard_uid']) && !isset($_SESSION['dashboard_uid_admin'])){ echo "0"; }else{ echo (sizeof($plugins)); } ?></h3>

              <p>Total Plugins</p>
            </div>
            <div class="icon">
              <i class="fas fa-plug"></i>
            </div>
            <a href="javascript:void(0);" onclick="alert('Add coupons, embed video, audio, ebooks and more. Coming soon!');" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


