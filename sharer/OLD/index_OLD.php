<?php require_once 'settings.php'; ?> 
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

      <!-- Main content -->
      <section class="content">
	  
<div class="row">
            <div class="col-md-12">
            <div class="box-default">
            <div class="box-header with-border text-center">		
            <h1 style="font-size: 48px;"><b><?php echo $headline; ?></b></h1>
            <h3><?php echo $caption; ?></h3><br>
			  
<!--- STATS --->        

        <div class="col-md-4">

        <div id="counter"><?php echo $total_visits;?></div>
		<h3>Visitors so far:</h3>

        </div>		
        <!-- ./col -->
		
        <div class="col-md-4">
						
		<div id="counter"><?php echo $pending_counts; ?></div> 
		<h3>You will need:</h3>

        </div>	
        <!-- ./col -->
		
        <div class="col-md-4">

		<div id="counter"><?php echo $value['visitor_target']; ?></div>
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
						<p><a href="#embed" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-code"></i> EMBED BUTTON</a></p>
						
						<div align="left" id="how" class="collapse">
						<h2>1. Share on <?php echo $network; ?></h2>
						<p>To unlock this <?php echo $type; ?>, share with contacts on <?php echo $network; ?>.</p>
						<h2>2. Check counter daily</h2>
						<p>The "You will need" counter will decrease the more contacts visit your link (only one visit recorded per person).</p>
						<h2>3. Unlock <?php echo $type; ?></h2>
						<p>Once "Visitors so far" counter reaches targeted number of visitors, you will see the "Congratulations" message then your <?php echo $type; ?> will be shown. Claim immediately since the counter will reset after next visit.</p>				
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
						
<div class="box">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="src/img/profile.jpg" alt="Profile picture">

              <h3 class="profile-username text-center">Hi lucky social media user!</h3>
              
              <p class="text-muted text-center">Click to share on social networks for <?php echo $headline; ?></p>            

        <div class="form-group text-center"> 

            <div class="social-buttons">
                <a style="padding-top:20px; padding-bottom:20px" href="#Share" data-toggle="modal" class="btn btn-block btn-social btn-<?php echo $network; ?>">
                    <i style="padding-top:20px; padding-bottom:20px" class="fas fa-share-alt fa-5x"></i> <h1 id="share">Share on Social Media!</h1>					
                </a>				
            </div>	
								                                                                  
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
        </div> 

<!------------------------EDIT LOCKED CONTENT------------------------>	
	  
<?php
                   
              }else
              { 
                //redirect to target url if counter is greater than target counter
              ?>
			  
<div class="row">
            <div class="col-md-12">
            <div class="box-default">
            <div class="box-header with-border text-center">		
            <h1 style="font-size: 48px;"><b><?php echo $headline; ?></b></h1>
            <h3><?php echo $caption; ?></h3><br>
			  
<!--- STATS --->        

        <div class="col-md-4">

        <div id="counter"><?php echo $total_visits;?></div>
		<h3>Visitors so far:</h3>

        </div>		
        <!-- ./col -->
		
        <div class="col-md-4">
						
		<div id="counter"><?php echo $pending_counts; ?></div> 
		<h3>You will need:</h3>

        </div>	
        <!-- ./col -->
		
        <div class="col-md-4">

		<div id="counter"><?php echo $value['visitor_target']; ?></div>
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
						<p><a href="#embed" data-toggle="collapse" class="btn btn-lg btn-block btn-social btn-github"><i class="fas fa-code"></i> EMBED BUTTON</a></p>
						
						<div align="left" id="how" class="collapse">
						<h2>1. Share on <?php echo $network; ?></h2>
						<p>To unlock this <?php echo $type; ?>, share with contacts on <?php echo $network; ?>.</p>
						<h2>2. Check counter daily</h2>
						<p>The "You will need" counter will decrease the more contacts visit your link (only one visit recorded per person).</p>
						<h2>3. Unlock <?php echo $type; ?></h2>
						<p>Once "Visitors so far" counter reaches targeted number of visitors, you will see the "Congratulations" message then your <?php echo $type; ?> will be shown. Claim immediately since the counter will reset after next visit.</p>				
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
					<p style="font-size: 30px;">You've reached share count of: <?php echo $value['visitor_target']; ?></p>
					<p style="font-size: 30px;text-transform: uppercase;"><b>YOUR <?php echo $type; ?> CODE:</b></p>
					
					<p><div class="social-buttons">
						<a style="padding-top:20px; padding-bottom:20px" href="<?php echo $promo; ?>" target="_blank" class="btn btn-block btn-social btn-<?php echo $network; ?>">
							<i style="padding-top:20px; padding-bottom:20px" class="fas fa-share-alt fa-5x"></i> <h1 id="share">Click here to claim now!</h1>					
						</a>				
					</div></p>						
									
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
		
<!-- =================MODAL====================== -->
		
        <div class="modal fade" id="Share">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div align="center" class="modal-body">
		
	<h3>Share your link on Instagram, Messenger, Snapchat, WeChat or YouTube</h3>
      <div class="form-group">
        <input type="url" class="form-control input-lg" value="<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" placeholder="Share URL">
      </div>
	  	  
<div class="text-center">
      <h3>- OR -</h3>
    </div>	  
	  
<!--******************** SHARE BUTTONS ********************--->

      <div class="row">
        <div class="col-xs-4">
              <p><a href="https://www.facebook.com/sharer.php?u=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-facebook"><i class="fab fa-facebook fa-2x"></i> Facebook</a></p>
			  <p><a href="https://pinterest.com/pin/create/bookmarklet/?media=https:<?php echo $image; ?>&url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-pinterest"><i class="fab fa-pinterest fa-2x"></i> Pinterest</a></p>			 			  
              <p><a href="http://vk.com/share.php?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-instagram"><i class="fab fa-vk fa-2x"></i> VK</a></p>		
              <p><a href="https://www.blogger.com/blog-this.g?u=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&n=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-blogger"><i class="fab fa-blogger fa-2x"></i> Blogger</a></p>
              <p><a href="http://www.livejournal.com/update.bml?subject=<?php echo $headline; ?>&event=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-livejournal"><i class="fas fa-pencil-alt fa-2x"></i> LiveJournal</a></p>	
              <p><a href="https://mail.google.com/mail/?view=cm&fs=1&to&su=Recommendation&body=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>+&ui=2&tf=1&shva=1" target="_blank" class="btn btn-block btn-lg btn-social btn-google"><i class="fas fa-envelope fa-2x"></i> Gmail</a></p>			  
        </div>		

        <div class="col-xs-4">	
			  <p><a href="http://digg.com/submit?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-digg"><i class="fab fa-digg fa-2x"></i> Digg</a></p>
			  <p><a href="https://www.linkedin.com/shareArticle?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-linkedin"><i class="fab fa-linkedin fa-2x"></i> Linkedin</a></p>		
              <p><a href="http://www.stumbleupon.com/submit?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-stumbleupon"><i class="fab fa-stumbleupon fa-2x"></i> Stumbleupon</a></p>	
              <p><a href="https://www.xing.com/app/user?op=share&url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-xing"><i class="fab fa-xing fa-2x"></i> Xing</a></p>
              <p><a href="whatsapp://send?text=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-whatsapp"><i class="fab fa-whatsapp fa-2x"></i> WhatsApp</a></p>	
              <p><a href="https://web.skype.com/share?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-skype"><i class="fab fa-skype fa-2x"></i> Skype</a></p>				  
        </div>		
		
        <div class="col-xs-4">	
              <p><a href="https://twitter.com/intent/tweet?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-twitter"><i class="fab fa-twitter fa-2x"></i> Twitter</a></p>		  
              <p><a href="https://reddit.com/submit?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-reddit"><i class="fab fa-reddit fa-2x"></i> Reddit</a></p>				  
			  <p><a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&title=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-tumblr"><i class="fab fa-tumblr fa-2x"></i> Tumblr</a></p>
              <p><a href="https://share.flipboard.com/bookmarklet/popout?v=2&title=<?php echo $headline; ?>&url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-flipboard"><i class="fab fa-flipboard fa-2x"></i> Flipboard</a></p>			  		  
              <p><a href="https://telegram.me/share/url?url=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>&text=<?php echo $headline; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-telegram"><i class="fab fa-telegram fa-2x"></i> Telegram</a></p>		
              <p><a href="http://compose.mail.yahoo.com/?body=<?php echo $current_url.'?id'.$value['id'].'='.$myip_add; ?>" target="_blank" class="btn btn-block btn-lg btn-social btn-yahoo"><i class="fab fa-yahoo fa-2x"></i> Yahoo Mail</a></p>		
			  
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

	
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
<!-- =================FOOTER====================== -->

<?php require_once 'footer.php'; ?> 

