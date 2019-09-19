<?php 
require_once ('header.php');

?>

<script src="js/pandalocker.2.3.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/pandalocker.2.3.1.min.css">

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-top-nav">

<div class="wrapper">

  <!-- =================HEADER UNDER HERE====================== -->

  <!-- =================CONTENT====================== -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!---------- Main content ---------->
    <section class="content">    
            
<!------------------------LOGIN------------------------>    
                         
<div class="row">
            <div class="col-md-12">
                <div class="box-default">   
            <div class="box-header with-border text-center">
              <h2>Thanks, you have successfully verified your WhatsApp number!</h2>
              <h4>Share to continue for: <?php echo isset($_SESSION['headline']) && !empty($_SESSION['headline'])  ? $_SESSION['headline'] : '50% Discount off Social Suite!'; ?></h4>
            
<!--- STATS --->        

        <div class="col-md-4">

        <div id="counter">1</div>
		<h3>Visitors so far:</h3>

        </div>		
        <!-- ./col -->
		
        <div class="col-md-4">
						
		<div id="counter">1</div> 
		<h3>You will need:</h3>

        </div>	
        <!-- ./col -->
		
        <div class="col-md-4">

		<div id="counter">2</div>
		<h3>More to claim</h3> 		

        </div>
        <!-- ./col -->			
			
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

<!-- =================FOOTER====================== -->
<?php 
include('footer.php');
?>