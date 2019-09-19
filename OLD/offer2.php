<?php 
require_once ('config.php'); 
require_once ('header.php');

//current url of file
$uri = $_SERVER['REQUEST_URI'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
?>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-top-nav">

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
		document.location = 'logout.php';
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
                <div class="box box-default">
                    <div class="box-body">

                        <div class="col-md-6">      
                            <h3><b>Something went wrong! Sorry! Click back to try again.</b></h3>
                        </div>

                        <div class="col-md-6">                      
                            <p><a href="index.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left"></i> GO BACK</a></p>                            
                        </div>

                    </div>
                </div>
            </div>                      
        </div>
                    
                    <?php } elseif (@$page == 'repeated') { ?>

<div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-body">

                        <div class="col-md-6">      
                            <h3><b>You have already subscribed!</b></h3>
                        </div>

                        <div class="col-md-6">                      
                            <p><a href="index.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left"></i> GO BACK</a></p>                            
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
                <div class="box box-default">   
            <div class="box-header with-border text-center">
              <h2>Thanks, you have successfully verified your WhatsApp number!</h2>
              <h4>Share to continue for: <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount!'; ?></h4>
            </div>
            <!-- /.box-header -->               
                    <div class="box-body">

                        <div class="col-md-6">
                <?php
                    $profile_pic = '//suite.social/src/dist/img/avatar04.png';
                    if(isset($_SESSION['image']) && !empty($_SESSION['image'])){
                        $profile_pic = $_SESSION['image'];
                    }       
                ?>
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $profile_pic; ?>" alt="User profile picture">

              <h3 class="text-center">Hi <?php if(isset($_SESSION['name']) && !empty($_SESSION['name'])){ echo $_SESSION['name']; }else{ echo 'Your Name'; } ?>!</h3>

              <!--<p class="text-muted text-center"><?php echo isset($_SESSION['share_headline']) && !empty($_SESSION['share_headline'])  ? $_SESSION['share_headline'] : 'WhatsApp user'; ?>!</p>-->
 
<div class="text-center">
<div id="hide-button" class="click-to-reveal">
 <button class="btn btn-danger btn-lg" id="countshare" href="#Share" data-toggle="modal"><i class="fa fa-share-alt"></i> CLICK HERE AND SHARE TO CONTINUE!</button>
<p class="text-muted">Click the button to open a popup window to share on social networks. Once you shared, close the popup window then wait few seconds and you will see a green button to continue.</p>
</div>
 
 <div class="click-to-reveal-block">

<div id="showMe">
    <h1>Thanks for sharing!</h1>
<a href="#" onClick="popup('<?php echo isset($_SESSION['promo']) && !empty($_SESSION['promo'])  ? $_SESSION['promo'] : 'https://suite.social/tools'; ?>')" class="btn btn-lg btn-social btn-whatsapp" ><i class="fa fa-whatsapp"></i> CLICK HERE TO CONTINUE NOW!!</a>	
<p class="text-muted">Click the button to continue for: <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount!'; ?></p>

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
                <div class="box box-default">
                    <div class="box-body">

                        <div class="col-md-6">      
                            <h3><b>Your email is wrong! Click back to try again.</b></h3>
                        </div>

                        <div class="col-md-6">                      
                            <p><a href="index.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left"></i> GO BACK</a></p>                            
                        </div>

                    </div>
                </div>
            </div>                      
        </div>
		
                   <?php } elseif (@$page == 'phone_verified') { ?>
                        <div class="action_block bad_email">

                                <form method="POST">
                                    <p><input type="hidden" name="phone" value="<?php echo (isset($phone) && $phone != '') ? $phone : ''; ?>" />
									<input type="hidden" name="user_ac_id" value="<?php echo (isset($user_ac_id) && $user_ac_id != '') ? $user_ac_id : ''; ?>" />
									</p>									
									
                                    <p><input type="text" name="firstname" required="required" class="form-control input-lg" placeholder="Enter your full name..."/></p>
                                    <p><input type="submit" class="btn btn-success btn-lg" name="get_content" value="Submit and Proceed" /></p>
                                </form>

                        </div>
                        
                     <?php } else
            if ($set == 1) {

                        header("Location: $base_url");
?>

                     <!--<script type="text/javascript">

                        $(opener.document).find("#myModal .modal-body").html("<?php //echo $html ?>");

                        close();

                    </script> -->

                     <?php

            } else { ?>
                    
<!------------------------------ /LOGIN ------------------------------> 

<?php if(empty($_SESSION['html'])) {?>
<div class="row">
            <div class="col-md-12">
                <div class="box box-default">
            <div class="box-header with-border text-center">
			<?php echo isset($_SESSION['logo']) && !empty($_SESSION['logo'])  ? $_SESSION['logo'] : ''; ?>			
              <h2><b><?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount!'; ?></b></h2>
              <p><?php echo isset($_SESSION['caption']) && !empty($_SESSION['caption'])  ? $_SESSION['caption'] : 'Login with WhatsApp and share to claim the offer. Hurry, offer ends soon!'; ?></p>
			  
<!--- TIMER --->            
<br>
<div style="width: 50%" class="tick" data-did-init="handleTickInit">

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
                        <p><a class="btn btn-success btn-lg btn-block" href="<?php echo isset($_SESSION['website']) && !empty($_SESSION['website'])  ? $_SESSION['website'] : 'https://suite.social'; ?>" target="_blank"><i class="fa fa-link"></i> <?php echo isset($_SESSION['button']) && !empty($_SESSION['button'])  ? $_SESSION['button'] : 'CLICK HERE TO VISIT OUR WEBSITE!'; ?></a></p>
                        </div>                  

                        <div class="col-md-6">
                            
<div class="box box-default">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="//suite.social/bookings/images/default.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo isset($_SESSION['greeting']) && !empty($_SESSION['greeting'])  ? $_SESSION['greeting'] : 'Hi lucky WhatsApp user!'; ?></h3>
              
              <p class="text-muted text-center">Login with WhatsApp and share for <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount!'; ?></p>            

<!--==================== Login ====================-->

        <div class="form-group text-center">                         
							
        <a style="cursor:pointer;" onClick="phone_btn_onclick();">
		  <p><button class="btn btn-social btn-whatsapp"><i class="fa fa-whatsapp"></i> <h1>Claim with WhatsApp</h1></button></p>
          </a>
          <form action="" method="POST" id="my_form"><input type="hidden" name="code" id="code"><input type="hidden" name="csrf_nonce" id="csrf_nonce"></form>		  
                                                                    
          </div>
                                
<!--==================== /Login ====================-->
              
            </div>
            <!-- /.box-body -->
          </div>     
		  <p class="text-muted text-center">You can unsubscribe to our offers at anytime. Your data is kept safe and secure, we NEVER sell, share or rent your contact details with anyone else.</p>
		  
                                                                                    
                        </div>


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
		
	<h3>Please share the URL on Instagram, Messenger, Snapchat, WeChat or YouTube</h3>
      <div class="form-group">
        <input type="url" class="form-control input-lg" value="<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" placeholder="Share URL">
      </div>
	  
<div class="text-center">
      <h3>- OR -</h3>
    </div>	
	
<p><div class="fb-like" data-href="<?php echo isset($_SESSION['fbpage']) && !empty($_SESSION['fbpage'])  ? $_SESSION['fbpage'] : 'https://facebook.com/socialgrower'; ?>" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div></p>
		  
<div class="text-center">
      <h3>- OR -</h3>
    </div>	  
	  
<!--******************** SHARE BUTTONS ********************--->

      <div class="row">
        <div class="col-xs-4">
              <p><a href="https://www.facebook.com/sharer.php?u=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-facebook"><i class="fa fa-facebook fa-2x"></i> Facebook</a></p>
			  <p><a href="https://pinterest.com/pin/create/bookmarklet/?media=https:<?php echo isset($_SESSION['picture']) && !empty($_SESSION['picture'])  ? $_SESSION['picture'] : 'https://suite.social/images/banner/home1.jpg'; ?>&url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-pinterest"><i class="fa fa-pinterest fa-2x"></i> Pinterest</a></p>			 			  
              <p><a href="http://vk.com/share.php?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-instagram"><i class="fa fa-vk fa-2x"></i> VK</a></p>		
              <p><a href="https://www.blogger.com/blog-this.g?u=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&n=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-blogger"><i class="fa fa-rss fa-2x"></i> Blogger</a></p>
              <p><a href="http://www.livejournal.com/update.bml?subject=<?php echo $headline; ?>&event=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-livejournal"><i class="fa fa-pencil fa-2x"></i> LiveJournal</a></p>	
              <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to&su=Recommendation&body=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>+&ui=2&tf=1&shva=1" target="_blank" class="btn btn-block btn-lg btn-social btn-google"><i class="fa fa-envelope fa-2x"></i> Gmail</a></p>			  
        </div>		

        <div class="col-xs-4">
              <p><a href="https://plus.google.com/share?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-google"><i class="fa fa-google-plus fa-2x"></i> Google+</a></p>		
			  <p><a href="https://www.linkedin.com/shareArticle?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-linkedin"><i class="fa fa-linkedin fa-2x"></i> Linkedin</a></p>		
              <p><a href="http://www.stumbleupon.com/submit?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-stumbleupon"><i class="fa fa-stumbleupon fa-2x"></i> Stumbleupon</a></p>	
              <p><a href="https://www.xing.com/app/user?op=share&url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-xing"><i class="fa fa-xing fa-2x"></i> Xing</a></p>
              <p><a href="whatsapp://send?text=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-whatsapp"><i class="fa fa-whatsapp fa-2x"></i> WhatsApp</a></p>	
              <p><a href="https://web.skype.com/share?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-skype"><i class="fa fa-skype fa-2x"></i> Skype</a></p>				  
        </div>		
		
        <div class="col-xs-4">	
              <p><a href="https://twitter.com/intent/tweet?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-twitter"><i class="fa fa-twitter fa-2x"></i> Twitter</a></p>		  
              <p><a href="https://reddit.com/submit?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-reddit"><i class="fa fa-reddit fa-2x"></i> Reddit</a></p>				  
			  <p><a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-tumblr"><i class="fa fa-tumblr fa-2x"></i> Tumblr</a></p>
              <p><a href="https://share.flipboard.com/bookmarklet/popout?v=2&title=<?php echo $headline; ?>&url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-flipboard"><i class="fa fa-clipboard fa-2x"></i> Flipboard</a></p>			  
              <!--<p><a href="#" target="_blank" class="btn btn-block btn-social btn-digg"><i class="fa fa-digg fa-2x"></i> Digg</a></p>-->			  
              <p><a href="https://telegram.me/share/url?url=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-telegram"><i class="fa fa-telegram fa-2x"></i> Telegram</a></p>		
              <p><a href="http://compose.mail.yahoo.com/?body=<?php echo isset($_SESSION['share']) && !empty($_SESSION['share'])  ? $_SESSION['share'] : 'https://suite.social'; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-yahoo"><i class="fa fa-yahoo fa-2x"></i> Yahoo Mail</a></p>		
			  
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

$('#showMe').hide(0).delay(15000).show(0);

$(document).ready(function() {
  $("#hide-button").click(function () {
   $("#show-button").show()
   $("#hide-button").hide()
  });
 }); 

jQuery(function() {
  jQuery(".click-to-reveal").click(function() {
    jQuery(this)
      .children()
      .toggleClass("rotate");
    jQuery(this)
      .next("div.click-to-reveal-block")
      .toggle();
  });
});

jQuery(function() {
  jQuery(".faqs h3").click(function() {
    jQuery(this)
      .next("div")
      .toggle();
  });
});

</script>

<!-- =================FOOTER====================== -->

<?php 
include('footer.php');
?>