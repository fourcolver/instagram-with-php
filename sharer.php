<?php 

session_start(); 
require_once("functions.php");

//if there is cookies
//then assign it into session
if(isset($_COOKIE['PromotionID']))
{
    foreach($_COOKIE as $key => $value)
    {
        $_SESSION[$key] = $value;
    }
}

//if came from user login
//then check promouserdata
//find match number and passcode
//if match then display stats counter
if(isset($_POST))
{
    $filename = 'promouserdata.json';
    $file_content = file_get_contents($filename);
    $data = json_decode($file_content, true);
    
    foreach($data as $row)
    {      
        //echo "<pre>";
        //print_r($row);
        //print_r($_POST);
        //echo "</pre>";
        
        if(
            $row['user']['number'] == $_POST['number'] &&
            $row['user']['promoid'] == $_POST['promo_id'] &&
            $row['user']['referadminid'] == $_POST['admin_id'] &&
            $row['user']['passcode'] == $_POST['passcode']
        )
        {
            //all data will be assigned to $_SESSION
            get_promodata_by_id($_POST['promo_id']);
            
            //assignes phone number
            $_SESSION['verified_phone'] = $_POST['number'];
        }
        else
        {
            
        }
        
    }
    
    //no number and passcode match found
    //so lets throw the error
    if(!isset($_SESSION['verified_phone']))
    {
        echo "Phone number and password not match";
        die();
    }
}

//if empty verified phone
//means it came from the sharer
//before he verified the phone address
//we will insert new count data if ip address in not match with existing data
if($_SESSION['verified_phone'] == '')
{
    $id = $_GET['id'];
    $data = explode("_", $id);
    $admin_id = $data[0];
    $promo_id = $data[1];
    $refcode = $data[2];
    
    //check refcode
    //if filename is exist then it is correct referal code
    $filename = 'referral_'.$refcode.'.json';
    if(file_exists($filename))
    {
        //record the share based on its ip
        $file_content = file_get_contents($filename);
        $data = json_decode($file_content, true);
        $new_data = array();
        
        if(count($data) == 0)
        {
            $data = array();
            $new_data['ip_address'] = get_client_ip();
            $new_data['admin_id'] = $admin_id;
            $new_data['promo_id'] = $promo_id;
            $new_data['date'] = time();
        }
        else
        {
            foreach($data as $row)
            {
                //if ip exist along with admin and promo id1
                //then skip inserting
                if( 
                    $row['ip_address'] == get_client_ip() && 
                    intval($row['admin_id']) == intval($admin_id) && 
                    intval($row['promo_id']) == intval($promo_id)
                  )
                {
                   //do nothing data already available
                   //echo "do nothing";
                   break;
                }
                else
                {
                    $new_data['ip_address'] = get_client_ip();
                    $new_data['admin_id'] = $admin_id;
                    $new_data['promo_id'] = $promo_id;
                    $new_data['date'] = time();
                    break;
                }
            }
        }

        //we have new available data to be inserted in json
        //push into the array
        //save into json
        if(count($new_data) != 0)
        {
            array_push($data, $new_data);
            file_put_contents($filename, json_encode($data));
        }

        header('Location: https://suite.social/promo/offer-app.php?id='.$admin_id.'&'.$promo_id);
    }
    else
    {
        echo "Sorry wrong referal code";
        die();
    }
}
//verified phone is exist
//then it is owner of the referal code
//lets show the count share number
else
{
    //creating session share json data
    $data = '';
    
    //echo "<pre>";
    //print_r($_SESSION);
    //echo "</pre>";
    
    //creating filename by phone, adminid, and promoid
    $secret = 'su1t3SOCI4L!';
    $refcode = md5($_SESSION['verified_phone'].$_SESSION['dashboard_uid'].$_SESSION['PromotionID'].$secret);
    $filename = 'referral_'.$refcode.'.json';
    $share_url = 'https://wa.me/?text=https://suite.social/promo/sharer.php?id='.$_SESSION['dashboard_uid'].'_'.$_SESSION['PromotionID'].'_'.$refcode;
    
    if($_SESSION['visitor_target'] == '')
    {
        $_SESSION['visitor_target'] = 0;
    }
    
    //if file not exist then create empty file
    if(!file_exists($filename))
    {
        file_put_contents($filename, json_encode($data));  
        $visitor_so_far = 0;
        $visitor_needed = 0;
        $visitor_target = $_SESSION['visitor_target'];
    }
    else
    {
        //load file
        $file_content = file_get_contents($filename);
        $data = json_decode($file_content, true);
        $visitor_so_far = 0;
        $visitor_needed = 0;
        
        //if data not empty
        //then calculate the number visitor
        if(is_array($data))
        {
            foreach($data as $row)
            {
                if( 
                    intval($row['admin_id']) == intval($_SESSION['dashboard_uid']) && 
                    intval($row['promo_id']) == intval($_SESSION['PromotionID'])
                  )
                {
                    $visitor_so_far += 1;
                }
            }
        }
        
        $visitor_target = $_SESSION['visitor_target'];
        $visitor_needed = $visitor_target - $visitor_so_far;
        
        //if negative
        //like visitor already more than targeted
        //then show needed as 0
        if($visitor_needed <= 0)
            $visitor_needed = 0;
        
    }
}
?>
  
<html>
<head>
  <!-- Title -->
  <title>Social Sharer - Your  Headline Here</title>
  <!-- Meta Data -->
  <meta name="title" content="Your  Headline Here">
  <meta name="description" content="Your Caption Here">
  <meta name="keywords" content="whatsapp share, whatsapp content locker, whatsapp friend inviter, whatsapp share counter, whatsapp social locker, whatsapp social marketing, whatsapp social offer, whatsapp social promotion, whatsapp social referral, whatsapp social sharing, whatsapp link share, whatsapp visitor counter">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="author" content="https://suite.social/tools/sharer/whatsapp/coupon/">	
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">	
  <!-- Twitter -->
  <meta name="twitter:card" content="<?php echo $_SESSION['headline']; ?>">
  <meta name="twitter:title" content="<?php echo $_SESSION['headline']; ?>">
  <meta name="twitter:description" content="<?php echo $_SESSION['caption']; ?>">
  <meta name="twitter:image:src" content="<?php echo $_SESSION['picture']; ?>">
  <!-- Open Graph General (Facebook & Pinterest) -->
  <meta property="og:url" content="https://suite.social/tools/sharer/whatsapp/coupon/">
  <meta property="og:title" content="<?php echo $_SESSION['headline']; ?>">
  <meta property="og:description" content="<?php echo $_SESSION['caption']; ?>">
  <meta property="og:image" content="<?php echo $_SESSION['picture']; ?>">
  <meta property="og:type" content="product">
  <!-- Open Graph Article (Facebook & Pinterest) -->
  <meta property="article:section" content="Marketing">
  <meta property="article:tag" content="Marketing">    
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">	
  <meta name="HandheldFriendly" content="true">	
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/tools/sharer/whatsapp/src/img/favicon.ico">    
  <!-- CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- Social --> 
  <link rel="stylesheet" href="/tools/sharer/whatsapp/src/css/social-buttons.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="/tools/sharer/whatsapp/src/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/tools/sharer/whatsapp/src/css/skins/skin-black-light.min.css">
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
   background: #00a416;
   margin: 10px;   
   box-shadow: 0 0 0 4px #00a416, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
   text-shadow: -1px -1px #00a416;
}
</style>
</head> 
<body class="hold-transition skin-black-light layout-top-nav">

  <!-- Full Width Column -->
  <div class="content-wrapper">  
    <div style="width:100%" class="container">
      <div class="row">
        <div class="box-default">
          <div class="box-header with-border text-center">		
            <h1 style="font-size: 48px;">
              <b><?php echo $_SESSION['headline']; ?></b>
            </h1>
            <h3><?php echo $_SESSION['caption']; ?></h3><br>
                <!--- STATS --->        
                <div class="col-md-4">
                  <div id="counter"><?php echo $visitor_so_far; ?></div>
                  <h3>Visitors so far:</h3>
                </div>		
                <!-- ./col -->
                <div class="col-md-4">
                  <div id="counter"><?php echo $visitor_needed; ?></div> 
                  <h3>You will need:</h3>
                </div>	
                <!-- ./col -->
                <div class="col-md-4">
                  <div id="counter"><?php echo $visitor_target; ?></div>
                  <h3>More to claim</h3> 		
                </div>
                <!-- ./col -->
          </div>
          
          <!-- /.box-header --> 
          <div class="box-body">
            <div class="col-md-6">      
              <p>
                <a href="<?php echo $_SESSION['website']; ?>"" target="_blank">
                  <img width="100%" src="<?php echo $_SESSION['picture']; ?>" alt="Image">
                </a>
              </p>
              <p><a class="btn btn-lg btn-block btn-social btn-github" href="<?php echo $_SESSION['website']; ?>" target="_blank"><i class="fa fa-link"></i> VISIT OUR WEBSITE!</a></p>
              <p><a href="#how" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-question-circle"></i> HOW IT WORKS!</a></p>
              <p><a href="#embed" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-code"></i> EMBED NOW</a></p>
              <div align="left" id="how" class="collapse">
                <h2>1. Share on whatsapp</h2>
                <p>To unlock this Coupon, share with contacts on whatsapp.</p>
                <h2>2. Check counter daily</h2>
                <p>The "You will need" counter will decrease the more contacts visit your link (only one visit recorded per person).</p>
                <h2>3. Unlock Coupon</h2>
                <p>Once "Visitors so far" counter reaches targeted number of visitors, you will see the "Congratulations" message then your Coupon will be shown. Claim immediately since the counter will reset after next visit.</p>				
              </div>
              <div id="embed" class="collapse">					
                <div align="center">
                  <br><br><img width="320px" src="/tools/sharer/whatsapp/src/img/coupon.png" alt="Offer">
                  <h4>Copy the image for your website, blog or sales page.</h4>               	
                  <textarea rows="3" class="form-control">&lt;a href="https://suite.social/tools/sharer/whatsapp/coupon/?id1=367221616" target="_blank"&gt;&lt;img width="320px" src="/tools/sharer/whatsapp/src/img/coupon.png" alt="Image"&gt;&lt;/a&gt;</textarea>				
                </div>
              </div>						
						</div>                  
            
            <div class="col-md-6">
              <div class="box">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="/tools/sharer/whatsapp/src/img/profile.jpg" alt="Profile picture">
                  <h3 class="profile-username text-center">Hi lucky whatsapp user!</h3>
                  
                  <?php 
                  //if visitor number reach the target
                  //then show the promo content
                  if($visitor_needed == 0) { 
                  ?>
                    <br><br>
                    <div class="social-buttons text-center">
                      <?php echo $_SESSION['promo']; ?>
                    </div>
                  <?php 
                  } 
                  //if visitor not yet reach 
                  //he can share the share url
                  else 
                  { 
                  ?>
                    <p class="text-muted text-center">Click to share on whatsapp for Your  Headline Here</p>            
                    <div class="social-buttons">
                      <a style="padding-top:20px; padding-bottom:20px" href="<?php echo $share_url; ?>" target="_blank" class="btn btn-block btn-social btn-whatsapp">
                      <i style="padding-top:20px; padding-bottom:20px" class="fab fa-whatsapp fa-5x"></i> <h1 id="share">Share on whatsapp!</h1>					
                      </a>				
                    </div>	
                  <?php 
                  } 
                  ?>
                </div>
              <!-- /.box-body -->
              </div>     
              <p class="text-muted text-center">You must accept cookies in your browser.</p>
              <br>
            </div>
          </div>
        </div>              
      </div> 
      <!------------------------EDIT LOCKED CONTENT------------------------>	
      <br>
    </div>
  </div>
  <!-- /.container -->
  <!-- /.content-wrapper -->
  
  <!-- =================FOOTER====================== -->
  <footer class="main-footer text-center">
    <div class="container">
	  <strong>© 2019 - <a href="https://suite.social">https://suite.social</a></strong> - All Rights Reserved.
    </div>
    <!-- /.container -->
  </footer>
  
  <!-- jQuery 3 -->
  <script src="/tools/sharer/whatsapp/src/js/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="/tools/sharer/whatsapp/src/js/bootstrap.min.js"></script>
</body>
</html>