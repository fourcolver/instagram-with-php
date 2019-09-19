<?php
	
//current url of file
$uri = $_SERVER['REQUEST_URI'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];		
		
/// GENERAL	
$logo = 'https://suite.social/images/logo/suite.jpg';	
$website = 'https://suite.social';	

/// SOCIAL
$facebook = 'socialgrower';	
$twitter = 'socialsuite';	
$youtube = 'UCPnGqt2k5XS8gxuy0tPHkpg';	
$tumblr = 'suitesocial';	
$pinterest = 'suitesocial';	
$linkedin = '15793141';	
	
/// DISCOUNT	
$image = 'https://suite.social/images/mockup/publisher.gif';	
$headline = 'Headline here';
$caption = 'Caption here';
$link = 'https://api.whatsapp.com/send?phone=447876806121&text=I%20want%20to%20get%2050%20percent%20off%20social%20suite%20and%20become%20an%20affiliate';	
$currency = '€'; // The currency symbol.
$price = '199';	// How much the original price was.
$discount = '99'; // How much they can buy at.

/********** DO NOT EDIT **********/
$network = 'facebook';
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

<?php require_once 'header.php'; ?> 

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
                        <p><a class="btn btn-lg btn-block btn-social btn-github" href="<?php echo $website; ?>" target="_blank"><i class="fa fa-link"></i> VISIT OUR WEBSITE!</a></p>											
						</div>                  

                        <div class="col-md-6">
						
<div class="box text-center">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="https://suite.social/sharer/src/img/profile.jpg" alt="Profile picture">

              <h3 class="profile-username text-center">Hi lucky user! Thanks for visiting.</h3>
              
              <p class="text-muted text-center">Click to refer on social, email or SMS for <?php echo $headline; ?></p>  

<!---TIMER--->

<h4><?php echo  $type; ?> ends in:</h4>	
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
        Tick.count.schedule('every last day of the month at 12:00').onupdate = function(value) {
            tick.value = value;
        }
    }
</script>	

        <div class="to-lock" style="text-align: center;">

            <p><div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="#Whatsapp" data-toggle="modal" class="btn btn-block btn-social btn-whatsapp">
                    <i style="padding-top:20px; padding-bottom:20px" class="fab fa-whatsapp fa-5x"></i> <h1 id="share">Claim via WhatsApp!</h1>					
                </a>				
            </div></p>

            <div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="#Messenger" data-toggle="modal" class="btn btn-block btn-social btn-messenger">
                    <i style="padding-top:20px; padding-bottom:20px" class="fab fa-facebook-messenger fa-5x"></i> <h1 id="share">Claim via Messenger!</h1>					
                </a>				
            </div>

        </div>			
								                                                                                
            </div>
            <!-- /.box-body -->
          </div>
		  
                                                                                    
                        </div>

                    </div>
                </div>              
                                     
        </div> 

<!------------------------EDIT LOCKED CONTENT------------------------>	
	  		
<!-- ================= WHATSAPP ====================== -->
		
        <div class="modal fade" id="Whatsapp">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
		
	<h3>1. Enter your WhatsApp Number</h3>
	<h3>2. Click the button to send the link to your WhatsApp account</h3>
	<h3>3. Click the link on WhatsApp to verify your number and claim the offer</h3>
      <div class="form-group">
        <input type="text" class="form-control input-lg" value="" placeholder="WhatsApp number without +">
      </div>  
	  
<!--******************** SHARE BUTTONS ********************--->

      <div class="row">

        <div class="col-xs-12">
              <p><a href="whatsapp://send?text=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-whatsapp"><i class="fab fa-whatsapp fa-2x"></i> Verify via WhatsApp</a></p>				  
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

<!-- ================= MESSENGER ====================== -->
		
        <div class="modal fade" id="Messenger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
		
	<h3>1. Enter your Facebook username</h3>
	<h3>2. Click the button to send the link to your Messenger account</h3>
	<h3>3. Click the link on Messenger to verify and claim the offer</h3>
      <div class="form-group">
        <input type="text" class="form-control input-lg" value="" placeholder="Facebook username only">
      </div> 
	  	  
<!--******************** SHARE BUTTONS ********************--->

      <div class="row">
        <div class="col-xs-12">
              <p><a href="https://www.facebook.com/sharer.php?u=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-messenger"><i class="fab fa-facebook-messenger fa-2x"></i> Verify via Messenger</a></p>		  
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

