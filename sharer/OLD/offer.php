<?php

	///////////////////////// SHARELOCK HEADER - START //////
    require_once "sharelock.class.php";
	
    //define array for sharelock
    /*-----------------------------------Array details-----------------------------------*/
	
    # "id"=>"1" - sets the unique sharelock id - change the id for new sharing pages with different share count.
    # "visitor_target"=>"5" - sets total no of targeted visitors - how many visitors are required to unlock your offer for each user.
	# "ip"=>"1" - Check ip detection set to 1 (for yes) or 0 (for no)
	# "reset"=>"1" - Resets the counter after user reaches visitor target, set to 1 (for yes) or 0 (for no)
	
    /*-----------------------------------Array details end-----------------------------------*/
		
    $data=array(
    '0'=>array("id"=>"1","visitor_target"=>"5","url"=>"","theme"=>"","ip"=>"1","reset"=>"1"),
    );
    $sharelock = new sharelock();
	
    //current url of file
    $uri = $_SERVER['REQUEST_URI'];
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];		
		
	///////////////////////// SHARELOCK SETTINGS - START //////	

/// GENERAL		
$website = 'http://www.YourWebsite.com';	
	
/// DISCOUNT	
$image = '../src/img/discount.png';	
$headline = 'Your Headline Here';
$caption = 'The more you share, the cheaper you buy!';
$link = 'https://YourPaymentLink.com';	
$currency = '$'; // The currency symbol.
$price = '10';	// How much the original price was.
$discount = '5'; // How much they can buy at.

/********** DO NOT EDIT **********/
$network = 'facebook';
$color = '#3b5998';
$shareurl = 'https://wa.me/?text=';
$type = 'Discount';

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
	
	///////////////////////// SHARELOCK SETTINGS - END //////	

?>

<?php require_once 'header.php'; ?> 

<body class="hold-transition skin-black-light layout-top-nav">

<?php
//print_r($data);
//echo $_SERVER['REMOTE_ADDR'];
//$string=isset($_GET['id']) ? $_GET['id'] : '';
$myip=$_SERVER['REMOTE_ADDR'];
$myip_add=str_replace(".", "", $myip);

    foreach($data as $key=>$value)
    { 
	$string=isset($_GET['id'.$value['id']]) ? $_GET['id'.$value['id']] : '';
    $total_visits=$sharelock->header($value['id'],$value['ip'],$string,$reset='0'); //retrieve value of counter
    $pending_counts=$value['visitor_target']-$total_visits; //retrieve value of visitor target
    $filenamev=$value['id'].'_'.$myip_add.'.txt';  //saves visitor IP address in txt file
    $fh = fopen($filenamev, 'w+');
    fwrite($fh, $total_visits); //checks if counter is less then target counter or not               
    if($value['visitor_target']>$total_visits) //list sharelock if counter is less than target counter
    { 
                				
    /*Shortcodes that list all the sharelock mentioned on the top of page in an array*/

    # echo $value['visitor_target']; - is the visitor target value
    # echo $total_visits; - is the number of visitors
    # echo $pending_counts; - is the total number of visitors              
    # echo $value['url']; - is the current url to share				
?>

  <!-- Full Width Column -->
  <div class="content-wrapper">  
  
    <div style="width:100%" class="container">
  
<div class="row">
            <div class="box-default">
            <div class="box-header with-border text-center">		
            <h1 style="font-size: 48px;"><b><?php echo $headline; ?></b></h1>
            <h3><?php echo $caption; ?></h3><br>
						  
<!--- STATS --->        

        <div class="col-md-4">

		<div id="counter"><span style="text-decoration:line-through;color:#999"><?php echo $currency;?><?php echo $price;?></span> <span><?php echo $currency;?><?php echo $discount;?></span></div>
		<h3>Target Discount:</h3>

        </div>		
        <!-- ./col -->
		
        <div class="col-md-4">
						
		<div id="counter"><?php echo $currency;?><?php echo $total_visits;?></div>
		<h3>Discount so far:</h3>

        </div>	
        <!-- ./col -->
		
        <div class="col-md-4">

		<div id="counter"><?php echo $currency;?><?php echo $pending_counts; ?></div>
		<h3>More to claim</h3> 		

        </div>
        <!-- ./col -->
	  
            </div>
            <!-- /.box-header --> 
			
                    <div class="box-body">
                        <div class="col-md-6">      
                        <p><a href="<?php echo $website; ?>" target="_blank"><img width="100%" src="<?php echo $image; ?>" alt="Image"></a></p>
                        <p><a class="btn btn-lg btn-block btn-social btn-github" href="<?php echo $website; ?>" target="_blank"><i class="fa fa-link"></i> VISIT OUR WEBSITE!</a></p>
						<p><a href="#how" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-question-circle"></i> HOW IT WORKS!</a></p>
						<p><a href="#embed" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-code"></i> EMBED NOW!</a></p>
						
						<div align="left" id="how" class="collapse">
						<h2>1. Share with friends.</h2>
						<p>To reduce price, share with friends on social, email or SMS.</p>
						<h2>2. Check the discount daily</h2>
						<p>"Your Discount" counter will decrease the more people visit your link (only one visit is recorded per person).</p>
						<h2>3. Unlock <?php echo  $discountType; ?></h2>
						<p>Once you reach targeted price, you will see the "Congratulations" message then your <?php echo  $type; ?> will be unlocked. Claim immediately since the counter will reset after next visit.</p>				
						</div>

						<div id="embed" class="collapse">					
						<div align="center">
						<br><br><img width="320px" src="<?php echo $image; ?>" alt="Offer">

						<h4>Copy the image for your website, blog or sales page.</h4>               	
						<textarea rows="3" class="form-control"><a href="<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank"><img width="320px" src="<?php echo $image ?>" alt="Image"></a></textarea>				
			
						</div>
						</div>						
						
						</div>                  

                        <div class="col-md-6">
						
<div class="box text-center">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="src/img/profile.jpg" alt="Profile picture">

              <h3 class="profile-username text-center">Hi lucky social media user!</h3>
              
              <p class="text-muted text-center">Click to share on social, email or SMS for <?php echo $headline; ?></p>  

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

            <div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="<?php echo $shareurl; ?><?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-social btn-<?php echo $network; ?>">
                    <i style="padding-top:20px; padding-bottom:20px" class="fas fa-share-alt fa-5x"></i> <h1 id="share">Share with friends now!</h1>					
                </a>				
            </div>									                                                                
              
            </div>
            <!-- /.box-body -->
          </div>     
		  <p class="text-muted text-center">You must accept cookies in your browser.</p>
		<?php if($string == ''){ ?>
		
		<?php }else{ 
		$param='?';		
		$pos = strpos($current_url, $param);
		$endpoint = $pos + strlen($param);
		$newStr = substr($current_url,0,$endpoint );
		?>
		<p><input class="form-control" type="text" value="<?php echo $newStr.'id'.$value['id'].'='.$myip_add; ?>" /></p>	
	<?php } ?>	
		<br>
		  
                                                                                    
                        </div>

                    </div>
                </div>              
                                     
        </div> 

<!------------------------EDIT LOCKED CONTENT------------------------>	
	  
<?php
                   
              }else
              { 
                //redirect to target url if counter is greater than target counter
              ?>
			  
<div class="row">
            <div class="box-default">
            <div class="box-header with-border text-center">		
            <h1 style="font-size: 48px;"><b><?php echo $headline; ?></b></h1>
            <h3><?php echo $caption; ?></h3><br>
			  
<!--- STATS --->        

        <div class="col-md-4">

		<div id="counter"><span style="text-decoration:line-through;color:#999"><?php echo $currency;?><?php echo $price;?></span> <span><?php echo $currency;?><?php echo $discount;?></span></div>
		<h3>Target Discount:</h3>

        </div>		
        <!-- ./col -->
		
        <div class="col-md-4">
						
		<div id="counter"><?php echo $currency;?><?php echo $total_visits;?></div>
		<h3>Discount so far:</h3>

        </div>	
        <!-- ./col -->
		
        <div class="col-md-4">

		<div id="counter"><?php echo $currency;?><?php echo $pending_counts; ?></div>
		<h3>More to claim</h3> 		

        </div>
        <!-- ./col -->
	  
            </div>
            <!-- /.box-header --> 
			
                    <div class="box-body">
                        <div class="col-md-6">      
                        <p><a href="<?php echo $website; ?>" target="_blank"><img width="100%" src="<?php echo $image; ?>" alt="Image"></a></p>
                        <p><a class="btn btn-lg btn-block btn-social btn-github" href="<?php echo $website; ?>" target="_blank"><i class="fa fa-link"></i> VISIT OUR WEBSITE!</a></p>
						<p><a href="#how" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-question-circle"></i> HOW IT WORKS!</a></p>
						<p><a href="#embed" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-code"></i> EMBED NOW!</a></p>
						
						<div align="left" id="how" class="collapse">
						<h2>1. Share on with friends</h2>
						<p>To reduce price, share with friends on social, email or SMS.</p>
						<h2>2. Check the discount daily</h2>
						<p>"Your Discount" counter will decrease the more people visit your link (only one visit is recorded per person).</p>
						<h2>3. Unlock <?php echo  $type; ?></h2>
						<p>Once you reach targeted price, you will see the "Congratulations" message then your <?php echo  $type; ?> will be unlocked. Claim immediately since the counter will reset after next visit.</p>				
						</div>

						<div id="embed" class="collapse">					
						<div align="center">
						<br><br><img width="320px" src="<?php echo $image; ?>" alt="Offer">

						<h4>Copy the image for your website, blog or sales page.</h4>               	
						<textarea rows="3" class="form-control"><a href="<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank"><img width="320px" src="<?php echo $image ?>" alt="Image"></a></textarea>				
			
						</div>
						</div>						
						
						</div>                  

                        <div class="col-md-6">
						
<div class="box text-center">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="src/img/profile.jpg" alt="Profile picture">

              <h2>Congratulations <?php echo $network; ?> user!</h2><br>           

					<div id="promo">
					<p style="font-size: 30px;">You've reached the discounted price of: <?php echo $currency;?><?php echo $discount;?></p>
					
					<div class="social-buttons">
						<a style="padding-top:20px; padding-bottom:20px" href="<?php echo $link;?>" target="_blank" class="btn btn-block btn-social btn-default">
							<i style="padding-top:20px; padding-bottom:20px" class="fas fa-credit-card fa-5x"></i> <h1 id="share">CLICK HERE TO CLAIM!</h1>					
						</a>				
					</div>					

					</div>
              
            </div>
            <!-- /.box-body -->
          </div>     
		  <p class="text-muted text-center">Show to cashier to redeem or enter online if applicable. Expires soon!</p>
              <?php 
			  $reset_visits=$sharelock->header($value['id'],$value['ip'],$string,$reset='1');  
              }            
            }
          ?> 
		<br>
		  
                                                                                    
                        </div>

                    </div>
                </div>              
                                     
        </div>

    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- =================FOOTER====================== -->

<?php require_once 'footer.php'; ?> 

