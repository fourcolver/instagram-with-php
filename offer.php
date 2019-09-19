<?php 
require_once ('config.php'); 
require_once ('header.php');

//current url of file
$uri = $_SERVER['REQUEST_URI'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

//hashing the id so not easy to guess
$hash_char = 's0c1i4l2020#@!';
$hash = md5($_SESSION['PromotionID'].$hash_char);
$current_url = $protocol . $_SERVER['HTTP_HOST'] .  '/promo/offer-app.php?id=' . $_SESSION['dashboard_uid'] . '%26'. $_SESSION['PromotionID'] . '%26code=' . $hash;

?>

<script src="js/pandalocker.2.3.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/pandalocker.2.3.1.min.css">

<?php
/*
if(isset($_SESSION['FacebookUrl']) || isset($_SESSION['TwitterUrl']) || isset($_SESSION['YouTubeUrl']))
{
    $FacebookUrl = $_SESSION['FacebookUrl'];
    $TwitterUrl = $_SESSION['TwitterUrl'];
    $YouTubeUrl = $_SESSION['YouTubeUrl'];
    $LinkedinUrl = $_SESSION['LinkedinUrl'];
}
else
{
    //$FacebookUrl = "https://suite.social";
    //$TwitterUrl = "https://twitter.com/socialsuite";
    //$YouTubeUrl = "UC_of_sqFmklXOV2r6q7-oBA";
    //$LinkedinUrl = "https://www.linkedin.com/company/socialsuite";
}
*/

$FacebookUrl = isset($_SESSION['FacebookUrl']) ? $_SESSION['FacebookUrl'] : '' ;
$TwitterUrl = isset($_SESSION['TwitterUrl']) ? $_SESSION['TwitterUrl'] : '' ;
$YouTubeUrl = isset($_SESSION['YouTubeUrl']) ? $_SESSION['YouTubeUrl'] : '' ;
$LinkedinUrl = isset($_SESSION['LinkedinUrl']) ? $_SESSION['LinkedinUrl'] : '' ;


?>

<!-- 2. Generate And Paste Locker Code -->
<script>
jQuery(document).ready(function ($) 
{
  
    <?php 
    //if hidelocker is set to 1 then no locker
    if($_SESSION['hidelocker'] == 0) 
    { 
    ?>
    
      $('.to-lock').sociallocker(
      {
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
              url: '<?php echo $FacebookUrl; ?>'
           }
        },
        twitter:{
           follow:{
              url: '<?php echo $TwitterUrl; ?>'
           }
        },
        youtube:{
           subscribe:{
              channelId: '<?php echo $YouTubeUrl; ?>',
              clientId: '829404683676-kqe8n9hv25bk4l87niogr7kdn0jommq3.apps.googleusercontent.com'
           }
        },
        linkedin:{
           share:{
              title: 'follow',
              url: '<?php echo $LinkedinUrl; ?>'
           }
        },
        buttons:{
           order: ["facebook-like","twitter-follow","youtube-subscribe","linkedin-share"],
           counters: false,
           lazy: true
        }
      });
      
    <?php } ?>

    <?php 
    
    if($FacebookUrl == '')  echo "$('.onp-sl-facebook-like').hide();";
    if($TwitterUrl == '')   echo "$('.onp-sl-twitter-follow').hide();";
    if($YouTubeUrl == '')   echo "$('.onp-sl-youtube-subscribe').hide();"; 
    if($LinkedinUrl == '')  echo "$('.onp-sl-linkedin-share').hide();";
    
    ?>
   
});
</script>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-top-nav">

<div id="fb-root"></div>
<script>(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id))
			return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1382960475264672";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<script>

	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// initialize Account Kit with CSRF protection
	AccountKit_OnInteractive = function () {
		AccountKit.init(
				{
					appId: 102018820150735,
					state: "abcd",
					version: "v1.1"
				}
		//If your Account Kit configuration requires app_secret, you have to include it above
		);
	};

	// login callback
	function loginCallback(response) {
		console.log(response);
		if (response.status === "PARTIALLY_AUTHENTICATED") {
			document.getElementById("code").value = response.code;
			document.getElementById("csrf_nonce").value = response.state;
			document.getElementById("my_form").submit();
		} else if (response.status === "NOT_AUTHENTICATED") {
			// handle authentication failure
			console.log("Authentication failure");
		} else if (response.status === "BAD_PARAMS") {
			// handle bad parameters
			console.log("Bad parameters");
		}
	}
  
	// phone form submission handler
	function phone_btn_onclick() {    
      // you can add countryCode and phoneNumber to set values
      AccountKit.login('PHONE', {}, // will use default values if this is not specified
          loginCallback);
	}
  
	// email form submission handler
	function email_btn_onclick() {
		// you can add emailAddress to set value
		AccountKit.login('EMAIL', {}, loginCallback);
	}
  
	// destroying session
	function logout() {
		document.location = 'offer.php';
	}
</script>

<div class="wrapper">

  <!-- =================HEADER UNDER HERE====================== -->

  <!-- =================CONTENT====================== -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!---------- Main content ---------->
    <section class="content">    
            
<!------------------------LOGIN------------------------>    

                    <?php if (@$page == 'error') { ?>
                    
<div class="row">
            <div class="col-md-12">
                <div class="box-default">
                    <div class="box-body">

                        <div class="col-md-6">      
                            <h3><b>Something went wrong! Sorry! Click back to try again.</b></h3>
                        </div>

                        <div class="col-md-6">                      
                            <p><a href="offer.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left"></i> GO BACK</a></p>                            
                        </div>

                    </div>
                </div>
            </div>                      
        </div>
                    
                    <?php } elseif (@$page == 'repeated') { ?>

<div class="row">
            <div class="col-md-12">
                <div class="box-default">
                    <div class="box-body">

                        <div class="col-md-6">      
                            <h3><b>You have already subscribed!</b></h3>
                        </div>

                        <div class="col-md-6">                      
                            <p><a href="offer.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left"></i> GO BACK</a></p>                            
                        </div>

                    </div>
                </div>
            </div>                      
        </div>                                                          
                        <?php
                    } elseif (@$page == 'success' || @$_GET['msg'] == 'success') {
        
                        /// LOGIN CHECK
                        if (!isset($_SESSION['dashboard_uid'])) {
                            session_destroy(); 
                            
                            header("Location: $base_url");
                        }                                                                
                        ?>                       
                        
<div class="row">
            <div class="col-md-12">
                <div class="box-default">   
            <div class="box-header with-border text-center">
              <h2>Thanks, you have successfully verified your WhatsApp number!</h2>
              <h4>Share to continue for: <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount off Social Suite!'; ?></h4>
            </div>
            <!-- /.box-header -->               
                    <div class="box-body">

                        <div class="col-md-6">
                <?php
                    $profile_pic = '//suite.social/images/profile/default.jpg';
                    if(isset($_SESSION['image']) && !empty($_SESSION['image'])){
                        $profile_pic = $_SESSION['image'];
                    }       
                ?>
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $profile_pic; ?>" alt="User profile picture">

              <h3 class="text-center">Hi <?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])){ echo $_SESSION['name']; }else{ echo 'Your Name'; } ?>!</h3>

              <!--<p class="text-muted text-center"><?php echo isset($_SESSION['share_headline']) && !empty($_SESSION['share_headline'])  ? $_SESSION['share_headline'] : 'WhatsApp user'; ?>!</p>-->
 
              <div class="text-center">
              <div id="hide-button" class="click-to-reveal">
			  
				  <div class="social-buttons">
					<a id="countshare" href="#Share" data-toggle="modal" style="padding-top:20px; padding-bottom:20px" class="btn btn-block btn-social btn-google">
					  <i style="padding-top:20px; padding-bottom:20px" class="fas fa-share-alt"></i> <h1 id="share" class="text-center">SHARE TO CONTINUE!</h1>					
					</a>				
				  </div>			  
			  
              <p class="text-muted">Click the button to open a window to share on social networks. Once you shared, close the window and you will see a button to continue.</p>
              </div>
                <input type="hidden" name="parentid" id="parentid" value="<?php echo $_GET['parentid']; ?>">
                <input type="hidden" name="promoid" id="promoid" value="<?php echo $_SESSION['PromotionID']; ?>">
                <div class="click-to-reveal-block">

              <div id="showMe">
                  <h1>Thanks for sharing!</h1>
				  
				  <div class="social-buttons">
					<a href="javascript:void(0);"onClick="popup('<?php echo isset($_SESSION['promo']) && !empty($_SESSION['promo'])  ? $_SESSION['promo'] : 'https://suite.social/'; ?>')" style="padding-top:20px; padding-bottom:20px" class="btn btn-block btn-social btn-whatsapp">
					  <i style="padding-top:20px; padding-bottom:20px" class="fab fa-whatsapp fa-5x"></i> <h1 id="share" class="text-center">CLICK TO CONTINUE!</h1>					
					</a>				
				  </div>				  
				  				  
                  <p class="text-muted">
                    Click the button to continue for: <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount off Social Suite!'; ?>
                  </p>
                  
                  <?php
                  /* changeback to use button URL */
                  /* changeback to use button URL */
                  /* changeback to use button URL */
                  /*
                  if($_SESSION['promo'] == '') {
                  ?>
                  
                    <a href="#" onClick="popup('https://suite.social/';')" class="btn btn-lg btn-social btn-whatsapp" >
                    <i class="fab fa-whatsapp"></i> CLICK TO CONTINUE!</a>	
                    <p class="text-muted">
                      Click the button to continue for: 50% Discount off Social Suite!
                    </p>
                    
                  <?php 
                  } else { 
                  
                    echo $_SESSION['promo'];
                  
                  } 
                  
                  */
                  ?>
              </div>

              </div>  
              </div>                        
                                                                                    
                        </div>

                        <div class="col-md-6">  
                        <img width="100%" src="<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : '//suite.social/images/banner/home1.jpg'; ?>" alt="picture">
                        <!--<p><?php echo isset($_SESSION['button_link']) && !empty($_SESSION['button_link'])  ? $_SESSION['button_link'] : '<a href="//suite.social/dashboard.php" class="btn btn-primary btn-lg btn-block">OR GO TO DASHBOARD <i class="fa fa-arrow-right"></i></a>'; ?></p>-->                         
                        </div>

                    </div>
                </div>
                
            </div>                      
        </div>                                              
                    <?php } elseif (@$page == 'bad_email') { ?>
                        
<div class="row">
            <div class="col-md-12">
                <div class="box-default">
                    <div class="box-body">

                        <div class="col-md-6">      
                            <h3><b>Your number is wrong! Click back to try again.</b></h3>
                        </div>

                        <div class="col-md-6">                      
                            <p><a href="offer.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left"></i> GO BACK</a></p>                            
                        </div>

                    </div>
                </div>
            </div>                      
        </div>
		
                   <?php } elseif (@$page == 'phone_verified') { ?>
                        <div class="action_block bad_email">

                            <form method="POST" id="form-phone-verified" enctype="multipart/form-data">
                                <p>
                                    <input type="hidden" name="phone" value="<?php echo (isset($phone) && $phone != '') ? $phone : ''; ?>" />
                                    <input type="hidden" name="user_ac_id" value="<?php echo (isset($user_ac_id) && $user_ac_id != '') ? $user_ac_id : ''; ?>" />
                                </p>									
                                
                                <p>
                                  <input type="text" name="firstname" required="required" class="form-control input-lg" placeholder="Enter your full name..."/>
                                </p>
                                <p>
                                  <input type="text" name="passcode" required="required" class="form-control input-lg" placeholder="Set password (TIP: Use the same code sent to you by mobile)"/>
                                </p>
                                
                                <?php if($_SESSION['show_profile_url'] == 1) { ?>
                                <p><input type="link" name="profile_url" class="form-control input-lg" placeholder="Enter your social profile URL, e.g. https://instagram.com/USERNAME"/></p>
                                <?php } ?>																							
                                
                                <?php if($_SESSION['show_profile_picture'] == 1) { ?>
                                <div class="btn btn-lg btn-success">
                                  <i class="fas fa-image"></i> <b>OR Upload Picture</b>
                                  <p><input type="file" name="profile_picture" class="form-control input-lg"></p>
                                </div>
                                <?php } ?>
                                
                                <p><input type="submit" class="btn btn-danger btn-lg" name="get_content" value="Submit and Share" /></p>
                                <?php if(isset($_GET['id'])){
                                        $url = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                                        $parts = parse_url($url);
                                        $ids = explode('=', $parts['query']);
                                        $id = $ids[1];
                                }else{ $id = ""; } ?>
                                <input type="hidden" name="parantID" id="parantID" value="<?php echo $id; ?>">
                            </form>

                        </div>
                        
                     <?php } else
            if ($set == 1) {

                        header("Location: $base_url");?>

                     <!--<script type="text/javascript">

                        $(opener.document).find("#myModal .modal-body").html("<?php //echo $html ?>");

                        close();

                    </script> -->

                     <?php } else { ?>
                    
<!------------------------------ /LOGIN ------------------------------> 

<?php if(empty($_SESSION['html'])) {?>
<div class="row">
        <div class="box-default">
            <div class="box-header with-border text-center">
              <?php echo isset($_SESSION['logo']) && !empty($_SESSION['logo']) ? $_SESSION['logo'] : ''; ?>			
              
              <h1>
                <b><?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount off Social Suite!'; ?></b>
              </h1>
              
              <h4>
                <?php echo isset($_SESSION['caption']) && !empty($_SESSION['caption'])  ? $_SESSION['caption'] : 'Login with WhatsApp and share to claim the offer. Hurry, offer ends soon!'; ?>
              </h4>
			  
<!--- TIMER --->            
<br>
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
        // - 'every january the 12th at 12:00'
        // - 'every 12th of january at 12:00'

        // create the schedule counter
        Tick.count.schedule('every hour').onupdate = function(value) {
            tick.value = value;
        }
    }
</script> 		  
			  
            </div>
            <!-- /.box-header -->               
                    <div class="box-body">
                    
                        <div class="col-md-6">      
                        <a href="#"><img width="100%" src="<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : '//suite.social/images/banner/home1.jpg'; ?>" alt="picture"></a>
                        <p><a href="#how" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-question-circle"></i> HOW IT WORKS!</a></p>
						<!--<p><a class="btn btn-lg btn-block btn-social btn-github" href="<?php echo isset($_SESSION['website']) && !empty($_SESSION['website'])  ? $_SESSION['website'] : 'https://suite.social'; ?>" target="_blank"><i class="fa fa-link"></i> <?php echo isset($_SESSION['button']) && !empty($_SESSION['button'])  ? $_SESSION['button'] : 'OR CLICK HERE FOR MORE INFO!'; ?></a></p>-->
                        
						<div align="left" id="how" class="collapse">
						<h3>1. Click the button to proceed</h3>
						<h3>2. Verify your WhatsApp number</h3>
						<h3>3. Share with friends on social networks</h2>
						<p>Once you followed the steps, you can access: <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount off Social Suite!'; ?></p>				
						</div>						
						
						</div>                  

                        <div class="col-md-6">
                            
<div class="box">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="//suite.social/images/profile/default.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo isset($_SESSION['greeting']) && !empty($_SESSION['greeting'])  ? $_SESSION['greeting'] : 'Hi lucky Social Media user!'; ?></h3>
              
              <p class="text-muted text-center">To get started, click the button below for <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount off Social Suite!'; ?></p>            

<!--==================== Login ====================-->

        <div class="to-lock" style="text-align: center;">

        <div class="form-group text-center">
		  
          <div class="social-buttons">
            <a href="javascript:void(0);" onClick="phone_btn_onclick();" style="padding-top:20px; padding-bottom:20px" class="btn btn-block btn-social btn-whatsapp">
              <i style="padding-top:20px; padding-bottom:20px" class="fab fa-whatsapp fa-5x"></i> 
              <h1 class="text-center" id="share"><?php echo isset($_SESSION['cta']) && !empty($_SESSION['cta'])  ? $_SESSION['cta'] : 'Claim'; ?> with WhatsApp</h1>					
            </a>
            
            <a href="#loginModal" data-toggle="modal"><h4>Already have account? <u>Login here</h4></u></a><p><br>            
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form name="loginform" id="loginform" method="post" action="sharer.php">
                      <div class="box-body">
                        <div class="form-group">
                          <h4>Enter Mobile Number</h4>
                          <input type="text" class="form-control" name="number" value="" placeholder="+xxxxxxxxxxxx" required>
                        </div>
                        <div class="form-group">
                          <h4>Enter Password</h4>
                          <p>
                              <input type="password" name="passcode" class="form-control" id="passcode" placeholder="******" required>                          
                              <input type="hidden" name="admin_id" value="<?php echo $_SESSION['dashboard_uid']; ?>">
                              <input type="hidden" name="promo_id" value="<?php echo $_SESSION['PromotionID']; ?>">
                          </p>
                        </div>
                        <div class="box-footer actions">
                          <button type="submit" name="Login" id="Login" class="btn btn-primary">Login <i class="fas fa-paper-plane"></i></button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>	
                      </div>						              	
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
		  		  
          <form action="" method="POST" id="my_form"><input type="hidden" name="code" id="code"><input type="hidden" name="csrf_nonce" id="csrf_nonce"></form>		  
                                                                    
          </div>
		  
        </div>
                                
<!--==================== /Login ====================-->
              
            </div>
            <!-- /.box-body -->
          </div>     
		  <p class="text-muted text-center">You can unsubscribe at anytime. Your number is kept safe and secure.</p>
		  
                                                                                    
                        </div>


                    </div>
                </div>              
                                   
        </div>  

<?php } ?>

<?php if(isset($_SESSION['html'])) {?>
    <div class="row" id="google_contacts_section">
        <div class="col-md-12">
            <?php echo $_SESSION['html']; ?>
        </div>
    </div>
<?php } ?>                              
                                
                    <?php } ?>
          
          
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- Share Modal -->
        <div class="modal fade" id="Share">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div align="center" class="modal-body">
		
	<!--<h3>Please share the URL on Instagram, Messenger, Snapchat, WeChat or YouTube</h3>
      <div class="form-group">
        <input type="url" class="form-control input-lg" value="<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" placeholder="Share URL">
      </div>
	  
<div class="text-center">
      <h3>- OR -</h3>
    </div>
	
<p><div class="fb-like" data-href="<?php echo isset($_SESSION['fbpage']) && !empty($_SESSION['fbpage'])  ? $_SESSION['fbpage'] : 'https://facebook.com/socialgrower'; ?>" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div></p>
		  
<div class="text-center">
      <h3>- OR -</h3>
    </div>-->  
	  
<!--******************** SHARE BUTTONS ********************--->

      <div class="row">
        <div class="col-sm-4">
              <p><a href="https://www.facebook.com/sharer.php?u=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-facebook"><i class="fab fa-facebook fa-2x"></i> Facebook</a></p>
			  <p><a href="https://pinterest.com/pin/create/bookmarklet/?media=https:<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : 'https://suite.social/images/bg/suite-app1.jpg'; ?>&url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-pinterest"><i class="fab fa-pinterest fa-2x"></i> Pinterest</a></p>			 			  
              <p><a href="http://vk.com/share.php?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-instagram"><i class="fab fa-vk fa-2x"></i> VK</a></p>		
              <p><a href="https://www.blogger.com/blog-this.g?u=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&n=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-blogger"><i class="fab fa-blogger fa-2x"></i> Blogger</a></p>
              <p><a href="http://www.livejournal.com/update.bml?subject=<?php echo $headline; ?>&event=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-livejournal"><i class="fas fa-pencil-alt fa-2x"></i> LiveJournal</a></p>	
              <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to&su=Recommendation&body=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>+&ui=2&tf=1&shva=1" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-google"><i class="fas fa-envelope fa-2x"></i> Gmail</a></p>			  
        </div>		

        <div class="col-sm-4">
              <p><a href="https://plus.google.com/share?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-google"><i class="fab fa-google-plus fa-2x"></i> Google+</a></p>		
			  <p><a href="https://www.linkedin.com/shareArticle?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-linkedin"><i class="fab fa-linkedin fa-2x"></i> Linkedin</a></p>		
              <p><a href="http://www.stumbleupon.com/submit?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-stumbleupon"><i class="fab fa-stumbleupon fa-2x"></i> Stumbleupon</a></p>	
              <p><a href="https://www.xing.com/app/user?op=share&url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-xing"><i class="fab fa-xing fa-2x"></i> Xing</a></p>
              <p><a href="https://wa.me/?text=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-whatsapp"><i class="fab fa-whatsapp fa-2x"></i> WhatsApp</a></p>	
              <p><a href="https://web.skype.com/share?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-skype"><i class="fab fa-skype fa-2x"></i> Skype</a></p>				  
        </div>		
		
        <div class="col-sm-4">	
              <p><a href="https://twitter.com/intent/tweet?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-twitter"><i class="fab fa-twitter fa-2x"></i> Twitter</a></p>		  
              <p><a href="https://reddit.com/submit?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-reddit"><i class="fab fa-reddit fa-2x"></i> Reddit</a></p>				  
			  <p><a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-tumblr"><i class="fab fa-tumblr fa-2x"></i> Tumblr</a></p>
              <p><a href="https://share.flipboard.com/bookmarklet/popout?v=2&title=<?php echo $headline; ?>&url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-flipboard"><i class="fab fa-flipboard fa-2x"></i> Flipboard</a></p>			  
              <!--<p><a href="#" target="_blank" class="btn btn-block btn-social btn-digg"><i class="fa fa-digg fa-2x"></i> Digg</a></p>-->			  
              <p><a href="https://telegram.me/share/url?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-telegram"><i class="fab fa-telegram fa-2x"></i> Telegram</a></p>		
              <p><a href="http://compose.mail.yahoo.com/?body=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social ctm-share-promo btn-yahoo"><i class="fab fa-yahoo fa-2x"></i> Yahoo Mail</a></p>		
			  
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
		
<!-------------------- IF KIOSK MODE -------------------->

        <div class="modal fade" id="qrcode">
          <div class="modal-dialog">
            <div class="modal-content text-center">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h2 style="font-size: 36px;" class="text-success">Scan to share on <?php echo $network; ?> to make it happen!</h2>						
                <h3>For free code reader for your mobile, visit: www.i-nigma.mobi</h3>
              </div>
              <div class="modal-body">			  
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                            <img width="50%" src="http://chart.apis.google.com/chart?cht=qr&chs=500x500&chl=<?php echo $current_url; ?>" alt="WHATSAPP" />
                        </div>
                    </div>						
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success pull-right" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
   
 <!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
    <div class="container">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">         
          </div>
        </div>
      </div>
    </div>  
</div>

<script>
$(document).ready(function(){
  
  if($('#uploadBtn').length == 1)
  {
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
  }

  <?php 
  /* linkedin follow button */
  /* linkedin follow button */
  /* linkedin follow button */
  if($LinkedinUrl != ''){ 
  ?>

    $('.onp-sl-linkedin .onp-sl-control-inner-wrap .onp-sl-social-button').html('');
    $('.onp-sl-linkedin .onp-sl-control-inner-wrap .onp-sl-social-button').load("/promo/linkedin_follow.php");
    
    //dummy button to open linkedin company then
    //open the locker
    //$('.onp-sl-linkedin .onp-sl-control-inner-wrap .onp-sl-social-button').html('');
    //$('.onp-sl-linkedin .onp-sl-control-inner-wrap .onp-sl-social-button').html('<img src="/promo/img/linkedin-follow.jpg">');

  <?php } ?>

  $('#countshare').click(function(){
      var action = 'add-share-count';
      var parentid = $("#parentid").val();
      var promoid = $("#promoid").val();
      var formURL = 'sharecount-ajax.php';
      $.ajax({
          url : formURL,
          type: "POST",
          data : {action : action, parentid: parentid, promoid: promoid},
          dataType : "text",
          success:function(data) {
              //alert(data)
              
              <?php if($_SESSION['kiosk_mode'] == 1){ ?>
              
              //if it is in mobile and kiosk mode activated
              //then don't show the QR CODE
              if(!window.mobileAndTabletcheck())
              {
                  $('#qrcode').modal('show');
              }
              
              <?php } ?>
          }
      });
  });
  
})

window.mobileAndTabletcheck = function() 
{
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};
</script>

<!-- =================FOOTER====================== -->
<?php 
include('footer.php');
?>