<?php 
if( !session_id() ){
	session_start();
}
//current url of file
$uri = $_SERVER['HTTP_HOST'];
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$current_url = $protocol . $_SERVER['HTTP_HOST'];	

require_once 'header-admin.php'; 
?>

<script src="js/pandalocker.2.3.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/pandalocker.2.3.1.min.css">

<!-- include summernote css/js -->
<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<style>
.note-editor.note-frame .note-editing-area .note-codable {
    color: #888;
    background-color: #fff;
    height: 100px !important;
}
.IN-widget{
    display: none;
}
</style>
    
<!-- 2. Generate And Paste Locker Code -->
<script>
	jQuery(document).ready(function ($) 
  {    
    
    /* disable this change back to standard field
    $('#promo').on('summernote.init', function() {
      // toggle promo to codeview
      $('#promo').summernote('codeview.toggle');
      $('#promo').summernote('code', '');
    });
    
    //enable summernote editor
    $('#promo').summernote();
    $('.note-codable').on('blur', function() {
      if ($('#promo').summernote('codeview.isActivated')) {
        $('[name="promo"]').val($('#promo').summernote('code'));
      }
    });
    */
    
	  $('.to-lock').sociallocker({
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
            url: 'https://suite.social'
         }
      },
      twitter:{
         follow:{
            url: 'https://twitter.com/socialsuite'
         }
      },
      linkedin:{
         share:{
            url: 'https://www.linkedin.com/company/suitesocial',
            title: 'follow'
         }
      },
      youtube:{
         subscribe:{
            channelId: 'UC_of_sqFmklXOV2r6q7-oBA',
            clientId: '829404683676-kqe8n9hv25bk4l87niogr7kdn0jommq3.apps.googleusercontent.com'
         }
      },
      buttons:{
         order: ["facebook-like","twitter-follow","youtube-subscribe","linkedin-share"],
         counters: false,
         lazy: true
      }
	   });
     
      //override linked share to custom action
      //override linked share to custom action
      //override linked share to custom action
      $('.onp-sl-linkedin .onp-sl-control-inner-wrap .onp-sl-social-button').html('');
      $('.onp-sl-linkedin .onp-sl-control-inner-wrap .onp-sl-social-button').load("/promo/linkedin_follow.php");
	});
</script>

<script src="https://sdk.accountkit.com/en_EN/sdk.js"></script>
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

<?php
$responsePage = array("success" => "success",
    "error" => "error",
    "repeated" => "repeated",
    "bad_email" => "bad_email",
    "phone_verified" => "phone_verified",
    "forgotPassword" => "forgotPassword",
);
$page = '';
if (isset($_POST["code"]) && isset($_POST["code"])) {
    //$_SESSION["code"] = $_POST["code"];
    //$_SESSION["csrf_nonce"] = $_POST["csrf_nonce"];
    $ch = curl_init();
    error_reporting(-1);
    // Set url elements
    $fb_app_id = '102018820150735';
    $ak_secret = '668b3f6885046eef0d3dfb2e42fbb6de';

    $token = "AA|$fb_app_id|$ak_secret";

    // Get access token
    $url = 'https://graph.accountkit.com/v1.1/access_token?grant_type=authorization_code&code='.$_POST["code"].'&access_token='.$token;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    $info = json_decode($result);

    // Get account information
    $url = 'https://graph.accountkit.com/v1.1/me/?access_token=' . $info->access_token;


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    $final = json_decode($result);
	
	/*echo "<pre>";
	print_r($final);
	print_r($final->id);
	print_r($final->phone->number);
	echo "</pre>";*/

	$data = file_get_contents('userdata.json');
	$userdata = json_decode($data, true);
	if(!empty($userdata)) {
		$timeout = 8035200;  //2678400; //604800;
		$now = time();
		$IsRepeated = "0";
    	foreach ($userdata as $key => $value) {
	    	if($value['user']['email'] == $final->phone->number) {
	    		$user_ac_id = isset($final->id) ? $final->id : '';
			    $phone = isset($final->phone->number) ? $final->phone->number : '';
			    $page = $responsePage['forgotPassword'];
			    
			    $_SESSION['dashboard_uid'] = $value['user']['id'];
			    $_SESSION['name'] = $value['user']['displayName'];
			    $_SESSION['image'] = "images/default.jpg";
//				$_SESSION['discard_after'] = $now + $timeout;
				$_SESSION['dashboard_uid_admin'] = 'adminuser';
				//die();
			    //header("Location: index.php?msg=success");
				$group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';
			    $api_key = isset($_SESSION['api_key']) ? $_SESSION['api_key'] : '';
			    $IsRepeated = "1";
	    	}
		}
		if($IsRepeated == "0")
		{
			$user_ac_id = isset($final->id) ? $final->id : '';
		    $phone = isset($final->phone->number) ? $final->phone->number : '';
		    $page = $responsePage['phone_verified'];
		}
	}
	else
	{
		$user_ac_id = isset($final->id) ? $final->id : '';
	    $phone = isset($final->phone->number) ? $final->phone->number : '';
	    $page = $responsePage['phone_verified'];
	}
	
}
function getRealIpAddr() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
	  $ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

$_SESSION['locationType'] = "0";
function get_location_using_ip($ip_address='') {
	//$access_key = 'aa5b956f8b180299e74758bb24c0314b';
	// Initialize CURL:
	if($ip_address!=''){
		$ch = curl_init('https://ipapi.co/'.$ip_address.'/json/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Store the data:
		$json = curl_exec($ch);
		// Decode JSON response:
		$api_result = json_decode($json, true);
		$_SESSION['locationType'] = "1";

		if(isset($api_result['error'])) {
			$ch = curl_init('https://www.iplocate.io/api/lookup/'.$ip_address);
			//$ch = curl_init('https://www.iplocate.io/api/lookup/192.168.1.1');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($ch);
			$api_result = json_decode($json, true);
			$_SESSION['locationType'] = "2";
		}
		if(empty($api_result['country'])) {
			$ch = curl_init('https://extreme-ip-lookup.com/json/'.$ip_address);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($ch);
			$api_result = json_decode($json, true);
			$_SESSION['locationType'] = "3";
		}
		if(empty($api_result['country'])) {
			$ch = curl_init('https://extreme-ip-lookup.com/json/'.$ip_address);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($ch);
			$api_result = json_decode($json, true);
			$_SESSION['locationType'] = "3";
		}
		curl_close($ch);
		// Output the "capital" object inside "location"
		return $api_result;
	}
	else
	{
		return "";
	}
}
function get_calling_code_by_ccode($countrycode='') {
	
	// Initialize CURL:
	if($countrycode!=''){
		$ch = curl_init('https://restcountries.eu/rest/v2/alpha/'.$countrycode);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response:
		$api_result = json_decode($json, true);

		// Output the "capital" object inside "location"
		return $api_result;
	}
	else
	{
		return "";
	}
}

if (isset($_POST['get_content'])) {
	$timeout = 8035200;  //2678400; //604800;
	$now = time();
	// server should keep session data for AT LEAST 1 hour
	ini_set('session.gc_maxlifetime', $timeout);
	// each client should remember their session id for EXACTLY 1 hour
	session_set_cookie_params($timeout);

    $data = file_get_contents('userdata.json');
	$infos = json_decode($data, true);
    if(!empty($infos)) {
		$cnt = count($infos) - 1;
		$cnt1 = $infos[$cnt]['user']['id'];
		$cnt = $cnt1 + 1;
	}else{
		$cnt = 1;
	}

	$ip_address = getRealIpAddr();
	$ip_addressData = get_location_using_ip($ip_address);
	if(isset($_SESSION['locationType'])) {
		if($_SESSION['locationType'] == "1")
		{
			$UserLocation = $ip_addressData['city'].", ".$ip_addressData['country_name'];
		}
		if($_SESSION['locationType'] == "2" || $_SESSION['locationType'] == "3")
		{
			$UserLocation = $ip_addressData['city'].", ".$ip_addressData['country'];
		}
	}else{
		$UserLocation = "";
	}

    $user_data = array();
    $user_data['user']['id'] = $cnt;  //isset($_POST['user_ac_id']) ? $_POST['user_ac_id'] : rand(10,100);
    $user_data['user']['displayName'] = $_POST['firstname'];
    $user_data['user']['gender'] = "";
    $user_data['user']['email'] = $_POST['phone'];
    $user_data['user']['pin'] = $_POST['PINNumber'];
    $user_data['user']['location'] = $UserLocation;
    $user_data['user']['image'] = '';
    $user_data['user']['record_count'] = "";
    $user_data['records'] = "";
	$user_data['user']['service'] = "WhatsApp";
	$user_data['user']['interest'] = isset($_GET['r'])?$_GET['r']:''; 

    //$values = array("data" => json_encode(array($user_data['user']['id'] => $user_data)), "service_type" => 5);
    //$dbobj->insert("user_data", $values);

    // read json file
	$data = file_get_contents('userdata.json');
	// decode json
	$json_arr = json_decode($data, true);

	/*$cnt = count($json_arr) - 1;
	$cnt1 = $json_arr[$cnt]['Code'];
	$cnt = $cnt1 + 1;*/

	// add data
	$json_arr[] = $user_data;
	// encode json and save to file
	file_put_contents('userdata.json', json_encode($json_arr));
	
	$_SESSION['dashboard_uid'] = $user_data['user']['id'];
    $_SESSION['name'] = $user_data['user']['displayName'];
    $_SESSION['image'] = "images/default.jpg";
//	$_SESSION['discard_after'] = $now + $timeout;
	$_SESSION['dashboard_uid_admin'] = 'adminuser';
	//die();
    //header("Location: index.php?msg=success");
	$group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';
    $api_key = isset($_SESSION['api_key']) ? $_SESSION['api_key'] : '';
    $page = $responsePage['success'];
    /* ?>
    <script type="text/javascript">
    	window.location.href = "https://suite.social/promo/index.php?msg=success";
    </script>
    <?php */
}
$IsloginMsg = "";
if (isset($_POST['Login'])) {
	$MobileNumber = $_POST['MobileNumber'];
	$Password = $_POST['Password'];
	$data = file_get_contents('userdata.json');
	$userdata = json_decode($data, true);
	$IsloginMsg = "";
	if(!empty($userdata)) {
		$timeout = 8035200;  //2678400; //604800;
		$now = time();
    	foreach ($userdata as $key => $value) {
    		if($value['user']['email'] == $MobileNumber && $value['user']['pin'] === $Password) {
	    		$_SESSION['dashboard_uid'] = $value['user']['id'];
			    $_SESSION['name'] = $value['user']['displayName'];
			    $_SESSION['image'] = "images/default.jpg";
//				$_SESSION['discard_after'] = $now + $timeout;
				$_SESSION['dashboard_uid_admin'] = 'adminuser';
				//die();
			    //header("Location: index.php?msg=success");
				$group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';
			    $api_key = isset($_SESSION['api_key']) ? $_SESSION['api_key'] : '';

			    $IsloginMsg = "You have now logged in!";
			    $_SESSION['IsloginMsg'] = "You have now logged in!";
			    break;
	    	}
	    	else
	    	{
	    		$IsloginMsg = "invalid username or password...";
	    		$_SESSION['IsloginMsg'] = "invalid username or password...";
	    	}
		}
	}
	else
	{
		$IsloginMsg = "you are not register...";
	    $_SESSION['IsloginMsg'] = "you are not register...";
	}
	?>
	<script type="text/javascript">
        window.location.replace("https://suite.social/promo/index.php");
    </script>
	<?php
}
$IsUpdatePINMsg = "";
if (isset($_POST['updatePassword'])) {
	$MobileNumber = $_POST['phone'];
	$updatePIN = $_POST['updatePIN'];
	$IsUpdate = "0";
	$data = file_get_contents('userdata.json');
	$userdata = json_decode($data, true);
	$IsUpdatePINMsg = "";
	if(!empty($userdata)) {
		$timeout = 8035200;  //2678400; //604800;
		$now = time();
    	foreach ($userdata as $key => $value) {
	    	if($value['user']['email'] == $MobileNumber) {
	    		$userdata[$key]['user']['pin'] = $updatePIN;
	    		$_SESSION['dashboard_uid'] = $value['user']['id'];
			    $_SESSION['name'] = $value['user']['displayName'];
			    $_SESSION['image'] = "images/default.jpg";
//				$_SESSION['discard_after'] = $now + $timeout;
				$_SESSION['dashboard_uid_admin'] = 'adminuser';
				//die();
			    //header("Location: index.php?msg=success");
				$group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';
			    $api_key = isset($_SESSION['api_key']) ? $_SESSION['api_key'] : '';
			    $IsUpdate = "1";
			    $IsUpdatePINMsg = "You have updated your account!";
	    	}
		}
		if($IsUpdate = "1")
		{
			$json_arr = $userdata;
			file_put_contents('userdata.json', json_encode($json_arr));
		}
	}
	else
	{
		$IsUpdatePINMsg = "somthing went wrong...";
	}
}

//$_SESSION['dashboard_uid'] = '1';
//$_SESSION['dashboard_uid_admin'] = 'adminuser';
?>
      <!-- ================== CONTENT ======================== -->

      				<?php if ($page == 'error') { ?>
                    
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
                    
                    <?php } elseif ($page == 'repeated') { ?>
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
                    }  elseif ($page == 'phone_verified') { ?>
                        <div class="action_block bad_email">
                            <form method="POST">
                                <p><input type="hidden" name="phone" value="<?php echo (isset($phone) && $phone != '') ? $phone : ''; ?>" />
								<input type="hidden" name="user_ac_id" value="<?php echo (isset($user_ac_id) && $user_ac_id != '') ? $user_ac_id : ''; ?>" />
								</p>
                                <p><input type="text" name="firstname" required="required" class="form-control input-lg" placeholder="Enter your full name..."/></p>
                                <p><input type="text" name="PINNumber" required="required" class="form-control input-lg" placeholder="Please enter generated code you received again to set as password..."/></p>
                                <p><input type="submit" class="btn btn-success btn-lg" name="get_content" value="Register" /></p>
                            </form>
                        </div>
                     <?php } elseif ($page == 'success' || @$_GET['msg'] == 'success') {
        
	                        /// LOGIN CHECK
	                        /*if (!isset($_SESSION['dashboard_uid'])) {
	                            session_destroy(); 
	                            
	                            header("Location: $base_url");
	                        }*/                                                                
	                        ?>                       
                        
							<div class="row">
								<div class="col-md-12">
									<div class="box-default">   
										<div class="box-header with-border text-center">
											<!--<h2>Thanks, you have successfully verified your WhatsApp number!</h2>-->
											<h2>You have now registered!</h2>
										</div>
									</div>

								</div>                      
							</div>                                              
                    <?php }elseif ($page == 'forgotPassword') { ?>
                        <div class="action_block">
                            <form method="POST">
                                <p><input type="hidden" name="phone" value="<?php echo (isset($phone) && $phone != '') ? $phone : ''; ?>" />
								<input type="hidden" name="user_ac_id" value="<?php echo (isset($user_ac_id) && $user_ac_id != '') ? $user_ac_id : ''; ?>" />
								</p>
								<p><input type="text" name="firstname" required="required" class="form-control input-lg" placeholder="Enter your full name..."/></p>
                                <p><input type="text" name="updatePIN" id="updatePIN" required="required" class="form-control input-lg" placeholder="Please enter generated code you received again to set as password..."/></p>
                                <p><input type="submit" class="btn btn-success btn-lg" name="updatePassword" id="updatePassword" value="Update Password" /></p>
                            </form>
                        </div>
                     <?php } ?>

                    <?php if(isset($_SESSION['IsloginMsg']) && !empty($_SESSION['IsloginMsg'])){ ?>
                     	<div class="row">
							<div class="col-md-12">
								<div class="box-default">   
									<div class="box-header with-border text-center">
										<h2><?php echo $_SESSION['IsloginMsg']; ?></h2>
									</div>
								</div>
							</div>
						</div> 
                     	<?php
                     	unset($_SESSION['IsloginMsg']);
                    } ?>
                    <?php if($IsUpdatePINMsg != ""){ ?>
                     	<div class="row">
							<div class="col-md-12">
								<div class="box-default">   
									<div class="box-header with-border text-center">
										<h2><?php echo $IsUpdatePINMsg; ?></h2>
									</div>
								</div>
							</div>
						</div> 
                     	<?php
                    } ?>
	  
	        <!-- Main row -->
      <div class="row">
	  	  
        <!-- Left col -->
        <?php
        /*if(isset($_SESSION['dashboard_uid']))
		{
			echo $_SESSION['dashboard_uid'];
			echo $_SESSION['dashboard_uid_admin'];
		}
		else
		{
			echo "Nothing...";
		}*/
        ?>
        <section class="col-lg-6 col-md-6">
          	<div class="box box-success">
	            <div class="box-header with-border">
	                <h2 class="box-title">Create Promotion</h2>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
	            <form name="socialWall" id="socialWall" method="post" action="promo/create.php" enctype="multipart/form-data">
	                <div class="box-body">
			          <div class="form-group">
			            <h4>Campaign Name <br><small>Enter name of your business or promotion. No spaces (- hyphen allowed).</small></h4>
			            <input type="text" class="form-control" name="wallTitle" id="wallTitle" value="demo" placeholder="Enter campaign name..." required>
			          </div>
	                				
						<?php
						echo '<div class="form-group">';
						echo '<h4>Logo<br>';
						echo '<small>Enter logo URL (TIP: if paste in URL, click spacebar to see live preview).</small></h4>';
						echo '<p><input name="logo" type="url" onBlur="loadcheckfly();" onKeyUp="loadcheckfly();" id="logo" class="form-control" value="" placeholder="Enter Logo URL"></p>';							       		
				        echo '</div>';									
						?>	

						<?php
						echo '<div class="form-group">';
						echo '<h4>Banner<br>';
						echo '<small>Enter Banner URL (TIP: if paste in URL, click spacebar to see live preview).</small></h4>';
						echo '<p><input name="background" type="url" onBlur="loadcheckfly();" onKeyUp="loadcheckfly();" id="background" class="form-control" value="" placeholder="Enter Banner URL"></p>';							       		
				        echo '</div>';									
						?>				
					
	                	<div class="form-group">
		                  <h4>Headline<br>
						  <small>Enter your promotional headline (e.g. 30% off coupon).</small></h4>
						  <p><input type="text" name="headline" class="form-control headlineinput" id="headline" placeholder="Enter Headline"></p>				  
		                </div>
					
		        <div class="form-group">
		            <h4>Caption<br>
                <small>Explain what user must to do to claim.</small></h4>
                <p><input type="text" name="caption" id="caption" class="form-control captioninput" value="Like/follow then login with WhatsApp and share to unlock promotion" placeholder="Enter Caption"></p>				        
            </div>
					
						<a href="#social" data-toggle="collapse" class="btn btn-block btn-success"><i class="fas fa-share-alt"></i> Like/Follow Locker</a>

						<div id="social" class="collapse">
              <div class="input-group">
                <h4 style="float: left">Hide locker feature?</h4>
                <input type="checkbox" name="hidelocker" id="hidelocker" value="1" style="margin-top: 14px;margin-left: 10px;">
              </div>
              
						  <h4>Facebook Like</h4>
              <div class="input-group">
                <span id="facebook" class="input-group-addon"><i class="fab fa-facebook"></i></span>              
                <input type="phone" class="form-control" name="FacebookUrl" id="FacebookUrl" value="https://suite.social" placeholder="Enter URL to like" >
              </div>

						  <h4>Twitter Follow</h4>
              <div class="input-group">
                <span id="twitter" class="input-group-addon"><i class="fab fa-twitter"></i></span>              
                <input type="text" class="form-control" name="TwitterUrl" id="TwitterUrl" value="https://twitter.com/socialsuite" placeholder="Enter Twitter Profile URL">
              </div>

              <h4>YouTube Subscribe</h4>
              <div class="input-group">
                <span id="youtube" class="input-group-addon"><i class="fab fa-youtube"></i></span>              
                <input type="text" class="form-control" name="YouTubeUrl" id="YouTubeUrl" value="UC_of_sqFmklXOV2r6q7-oBA" placeholder="Enter Channel ID" >
              </div>
              
              <h4>Linkedin Follow</h4>
              <div class="input-group">
                <span id="linkedin" class="input-group-addon"><i class="fab fa-linkedin"></i></span>              
                <input type="text" class="form-control" name="LinkedinUrl" id="LinkedinUrl" value="15793141" placeholder="Enter Your Linkedin URL" >
              </div>

            </div>				
					
		                <div class="form-group">
		                  <h4>Button CTA<br>
						  <small>Enter button call to action (e.g. Claim, Download etc).</small></h4>
						  <p><input type="text" name="cta" id="cta" class="form-control actioninput" placeholder="Claim"></p>				  
		                </div>				
						
		                <div class="form-group">
		                  <h4>Share URL<br>
						  <small>Enter the URL users will share.</small></h4>
						  <p><input type="url" name="share" id="share" class="form-control" placeholder="Enter Share URL"></p>
		                </div>				
					
		                <div class="form-group">
		                  <h4>Promo URL<br>
                      <small>Enter url the user will be redirected to after they share (TIP: This can be url of your shopping cart, coupon <a style="color:#609450" href="plugins.php">or plugins</a>).</small></h4>
                      <p>
                        <input type="url" name="promo_url" id="promo" class="form-control" placeholder="Enter Promo URL">
                        <!--<textarea id="promo" name="promo"></textarea>-->
                      </p>
		                </div>

		                <div class="form-group">
		                  <h4>Website Link<br>
                        <small>Enter Website Link.</small></h4>
                        <p><input type="url" name="Website" id="Website" class="form-control" placeholder="Enter Website Link"></p>
		                </div>		
						
                    <a href="#referral-share-form" data-toggle="collapse" class="btn btn-block btn-success"><i class="fas fa-share-alt"></i> Referral Share Mode</a>
                    
                    <div id="referral-share-form" class="collapse">
                      <div class="form-group">
                        <h4 style="float: left">Referral Share</h4>					  
                        <input type="checkbox" name="referral_share_mode" id="referral_share_mode" value="1" style="margin-top: 14px;margin-left: 10px;">
                        <p></p>
                        <span class="text-muted">This is the display your promotion using referral share mode.</span>
                      </div> 
                      
                      <div class="form-group">
                        <h4>Visitor Target<br>
                          <small>Enter Desired Visitor Target for Unlocking the Promotion.</small></h4>
                          <p><input type="text" name="visitor_target" id="visitor_target" class="form-control" placeholder="Visitor Target"></p>
                      </div>
                    </div>						
                    
                    <hr>
                    <div class="form-group">
                      <h4 style="float: left">Kiosk mode?</h4>					  
                      <input type="checkbox" name="kiosk_mode" id="kiosk_mode" value="1" style="margin-top: 14px;margin-left: 10px;">
                      <p></p>
                      <span class="text-muted">This is the display your promotion at in-store kiosk, it disables the like/follow locker and shows QR code for users to scan and share on social networks via there mobile phone.</span>
                    </div> 					  					
                    
                    <div class="form-group">
                      <h4 style="float: left">Show profile URL?</h4>					  
                      <input type="checkbox" name="show_profile_url" id="show_profile_url" value="1" style="margin-top: 14px;margin-left: 10px;">
                      <p></p>
                      <span class="text-muted">Show or disable profile URL field in user information form.</span>
                    </div>
                    
                    <div class="form-group" id="show_profile_picture_container">
                      <h4 style="float: left">Show picture upload?</h4>					  
                      <input type="checkbox" name="show_profile_picture" id="show_profile_picture" value="1" style="margin-top: 14px;margin-left: 10px;">
                      <p></p>
                      <span class="text-muted">Show or disable upload picture input in user information form.</span>
                    </div>
                    <hr>            
      
		                <!--<div class="form-group">
		                  <h4>Show Timer?</h4>
						  <span class="text-muted">If yes, timer will show on login page.</span>
		                  <p><select class="form-control">
		                    <option>Yes</option>
		                    <option>No</option>
		                  </select></p>
		                </div>-->
	              	</div>
	              	<!-- /.box-body -->
 
		              <?php
		              if(isset($_SESSION['dashboard_uid']) && !empty($_SESSION['dashboard_uid'])){
		              	?>
		              	<div class="box-footer actions">
		              		<input type="hidden" name="UserID" id="UserID" value="<?php echo $_SESSION['dashboard_uid']; ?>" />
		              		<input type="hidden" name="id" id="id" value="0" />
		              		<button type="submit" name="submit" id="submitButton" class="btn btn-primary">SUBMIT AND CREATE! <i class="fas fa-paper-plane"></i></button>
		              	</div>	
		              	<?php
		              } ?>
		        </form>
	            	<?php 
	            	if(!isset($_SESSION['dashboard_uid']) && empty($_SESSION['dashboard_uid'])){
	              	?>
	              	<div class="form-group text-center">
						<!--<p><button class="btn btn-social btn-whatsapp"><i class="fab fa-whatsapp"></i> <h1><span style="position: relative; font-size: 36px;border-right: 0px solid rgba(0,0,0,0.2);">Login with WhatsApp to create!</h1></button></p>-->
				        <p>
				        	<a style="cursor:pointer;" onClick="phone_btn_onclick();"><p><button class="btn btn-social btn-whatsapp"><i class="fab fa-whatsapp"></i><h1>Login with WhatsApp to create!</h1></button></p></a>
				        </p>
				        <!-- Button Login modal -->
						<p><a href="#loginModal" data-toggle="modal"><h4>Already have account? <u>Login here</h4></u></a><p><br>
						<!-- Button forgot password -->
						<!--<button type="button" class="btn btn-info" id="forgotpassword" name="forgotpassword">forgot password</button>-->
				    </div>
	              	<?php
	              }
	              ?>
	            <!-- Modal -->
				<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php
							$ip_address = getRealIpAddr();
							$ip_addressData = get_location_using_ip($ip_address);
							if(isset($_SESSION['locationType']))
							{
								if($_SESSION['locationType'] == "1") {
									$countrycode = $ip_addressData['country'];
								}
								if($_SESSION['locationType'] == "2") {
									$countrycode = $ip_addressData['country_code'];
								}
								if($_SESSION['locationType'] == "3") {
									$countrycode = $ip_addressData['countryCode'];
								}
							}
							$calling_codeArr = get_calling_code_by_ccode($countrycode);
							$calling_code = "+".$calling_codeArr['callingCodes'][0];
							?>
							<div class="modal-body">
								<form name="loginform" id="loginform" method="post" action="">
									<div class="box-body">
										<div class="form-group">
											<h4>Enter Mobile Number</h4>
											<input type="text" class="form-control" name="MobileNumber" id="MobileNumber" value="<?php echo $calling_code; ?>" placeholder="+xxxxxxxxxxxx" required>
										</div>
										<div class="form-group">
											<h4>Enter Password</h4>
											<p><input type="password" name="Password" class="form-control" id="Password" placeholder="******" required></p>
										</div>
										<div class="box-footer actions">
											<button type="submit" name="Login" id="Login" class="btn btn-primary">Login <i class="fas fa-paper-plane"></i></button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>	
									</div>						              	
						        </form>
							</div>
							<!--<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>-->
						</div>
					</div>
				</div>
	              <form action="" method="POST" id="my_form">
	              	<input type="hidden" name="code" id="code">
	              	<input type="hidden" name="csrf_nonce" id="csrf_nonce">
	              </form>     	  
	    	</div>
        </section>
        <!-- /.Left col -->
		
        <!-- right col -->
        <section class="col-lg-6 col-md-6">

		  <div class="box box-solid">
            <div class="box-body">
			
			<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>PLEASE NOTE: </strong> WhatsApp login button only works on live promotions!</a></div>
			
              <div class="text-center">	  		  
			  
			  <!-- LOCKED CONTENT -->

				<div class="row">
		            <div class="col-md-12">
		                <div class="box box-default">
				            <div class="box-header with-border text-center">
							<div id="logo_preview"><img height="80px" src="https://suite.social/images/icon/suite_80px.jpg" alt="Logo"></div>		
				              <b><h2 class="headlinebox">Promotion title</h2></b>
							  <p class="captionbox">Login with WhatsApp and share to claim the offer. Hurry, offer ends soon!</p>
							  
							<!--- TIMER --->            
							<br>
							<div style="width: 80%" class="tick" data-did-init="handleTickInit">

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
		                        
								<div id="background_preview"><img width="100%" src="//suite.social/images/banner/home1.jpg" alt="picture"></div>
		                        <!--<p><a class="btn btn-success btn-lg btn-block" href="<?php echo isset($_SESSION['website']) && !empty($_SESSION['website'])  ? $_SESSION['website'] : 'https://suite.social'; ?>" target="_blank"><i class="fa fa-link"></i> <?php echo isset($_SESSION['button']) && !empty($_SESSION['button'])  ? $_SESSION['button'] : 'CLICK HERE TO VISIT OUR WEBSITE!'; ?></a></p>-->
		                                             
									<div class="box box-default">
							            <div class="box-body box-profile">
							              <img class="profile-user-img img-responsive img-circle" src="//suite.social/images/profile/default.jpg" alt="User profile picture">

							              <h3 class="profile-username text-center">Hi lucky Social Media user!</h3>
							              
							              <p class="text-muted text-center">Like/follow then login with WhatsApp and share for: <span class="headlinebox">Promotion title</span></p>            

									<!--==================== Login ====================-->

							        <div class="to-lock" style="text-align: center;">

                        <div class="form-group text-center">                         

                        <p><button disabled class="btn btn-social btn-whatsapp"><i class="fab fa-whatsapp"></i> <h1><span style="position: relative; font-size: 36px;border-right: 0px solid rgba(0,0,0,0.2);" class="actionbox">Claim</span> with WhatsApp</h1></button></p>
                                                     
                        </div>
									  
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
			  
			<!-- /LOCKED CONTENT -->
			  
            </div>
            <!-- /.tab-pane -->

			<div style="display:none;" id="iframe_url">				
				<h3>Page Link</h3>
				<p class="lead">Share the link via social, email, SMS, messaging or use for kiosk.</p>
				<p><input class="form-control" type="text" id="wallUrl" value=""></p>											
			</div>
			  
			  <!--<h3>Embed Code</h3>
			  <p class="lead">Place the code on your website</p>
			  <p><textarea rows="3" class="form-control"></textarea></p>
			  
			  <h3>QR Code</h3>
			  <p class="lead">Use for your business card. Right click and save image.</p>
			  <p></p>-->		  

            </div>
          </div>

        </section>
        <!-- right col -->	
      	</div>
      	<!-- /.row (main row) -->

      	<?php if(isset($_SESSION['dashboard_uid']) && !empty($_SESSION['dashboard_uid'])) { ?>
			<div class="box">
	        	<div class="box-header">
	            	<h3 class="box-title">Your Promotions</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">	  
			        <div class="table-responsive">
						<table data-page-length='100' id="example" class="table table table-striped" cellspacing="0" width="100%">
				            <thead>
					            <tr>
					                <th>#</th>
					                <th>Image</th>
					                <th>Campaign</th>
					                <th>Headline</th>
					                <th>Caption</th>
                          <th>URL's</th>
                          <th>Share Count</th>
					                <th>Locker</th>
                          <th>Mode</th>
                          <th>Action</th>
					            </tr>
				            </thead>
				            <tbody>
				            	<!--<tr>
					                <td>1</td>
					                <td><img width="150px" src="http://suite.social/images/banner/home1.jpg" /></td>
					                <td>Marketing</td>
					                <td>Headline here</td>
					                <td>Caption</td>
                          <td><b>Share URL</b><br>https://suite.social<br><br><b> Offer URL</b><br>https://suite.social/promo</td>
                          <td><input class="form-control" value="https://suite.social/promo/offer.php" placeholder="Promo URL"></td>
					                <td><i class="fab fa-2x fa-facebook"></i>&nbsp;&nbsp;<i class="fab fa-2x fa-twitter"></i></td>               
					                <td>					
                            <div class="btn-group-vertical">
                              <button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Delete</button>
                              <button type="button" class="btn btn-success"><i class="fas fa-edit"></i> Edit</button>					  
                            </div>							                
                          </td>
					            </tr>-->
				            	<?php
				            	$promotiondata = file_get_contents('promotiondata.json');
				                // decode json to associative array
				                $promotion = json_decode($promotiondata, true);
				                if(!empty($promotion)) {
				                	$srno = 1;
				                	foreach ($promotion as $key => $value) {
				                		if($_SESSION['dashboard_uid'] == $value['UserID']){
				                			?>
								            <tr>
								                <td><?php echo $srno; ?></td>
								                <td><img width="150px" src="<?php echo $value['background']; ?>" /></td>
								                <td><?php echo $value['wallTitle']; ?></td>
								                <td><?php echo $value['headline']; ?></td>
								                <td><?php echo $value['caption']; ?></td>
                                <td>
                                  <b>Share URL</b><br>
                                  <?php echo $value['share']; ?><br><br>
                                  <b> Offer URL</b><br><?php echo $value['offerurl']; ?><br><br>
                                  <b> Promo URL</b><br><?php echo $value['promo']; ?></td>
                                <td align="center"><?php echo @$share[$value['id']]; ?></td>
								                <td align="center">
                                
								                	<?php if(!empty($value['FacebookUrl'])){ ?>
								                		<a href="<?php echo $value['FacebookUrl']; ?>"><i class="fab fa-2x fa-facebook"></i>&nbsp;&nbsp; </a><br>
								                	<?php } ?>
                                  
								                	<?php if(!empty($value['TwitterUrl'])){ ?>
								                		<a href="<?php echo $value['TwitterUrl']; ?>"><i class="fab fa-2x fa-twitter"></i>&nbsp;&nbsp; </a><br>
								                	<?php } ?>
                                  
								                	<?php if(!empty($value['YouTubeUrl'])){ ?>
								                		<a href="<?php echo $value['YouTubeUrl']; ?>"><i class="fab fa-2x fa-youtube"></i> </a><br>
								                	<?php } ?>
                                  
                                  <?php if(!empty($value['LinkedinUrl'])){ ?>
								                		<a href="<?php echo $value['LinkedinUrl']; ?>"><i class="fab fa-2x fa-linkedin"></i> </a>
								                	<?php } ?>
                                  
								                </td>
                                <td align="center">
                                  <?php 
                                  if(@$value['kiosk_mode'] == 1)
                                  {  
                                      echo "Kiosk"; 
                                  }
                                  elseif(@$value['referral_share_mode'] == 1)
                                  {
                                      echo "Referral"; 
                                  }
                                  else
                                  {
                                      echo "Website"; 
                                  }
                                  ?>
                                </td>
								                <td>
								                    <div class="btn-group-vertical">
								                    	<a href="<?php echo $value['offerurl']; ?>" target="_blank" class="btn btn-primary"><i class="fas fa-link"></i> View</a>
								                    	<button type="button" class="btn btn-danger delpromotion" data-id="<?php echo $value['id']; ?>"><i class="fas fa-times"></i> Delete</button>
								                    	<button type="button" class="btn btn-success editpromotion" data-id="<?php echo $value['id']; ?>"><i class="fas fa-edit"></i> Edit</button>					  
								                    </div>
								                </td>
								            </tr>
								            <?php
								            $srno++;
								        }
							        }
							    }
						        ?>
				            </tbody>
				        </table>
			    	</div>
	            </div>
	            <!-- /.box-body -->
	        </div>
        	<!-- /.box -->
        <?php } ?>	
	  
      <!-- ================== /CONTENT ======================== -->	 	  

<script>
	function loadcheckfly() {		
		// Logo
		var logo = $('#logo').val();
		if(logo.length != 0)
		{
			$( "#logo_preview" ).html('<img src="'+logo.toLowerCase()+'" height="80px" alt="Logo"></p>');
		}
		
		// Background
		var background = $('#background').val();
		if(background.length != 0)
		{
			$( "#background_preview" ).html('<img width="100%" src="'+background.toLowerCase()+'" alt="Banner"></p>');
			//$( "#background_preview" ).html('<img width="100%" src="'+banner.toLowerCase()+'" alt="Banner"></p>');
		}
	}
		
    //callback handler for form submit
    $("#socialWall").submit(function(e) {
        var postData = $(this).serializeArray();
        var formURL = 'promotion-ajax.php'; //$(this).attr("action");
        var ID = $("#id").val();
        if(ID == "0") {
        	postData.push({name: 'action', value: 'insert'});
        } else {
        	postData.push({name: 'action', value: 'update'});
        }

        $.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data) {
                if(ID == "0") {
                	quize_page_url = '<?php echo $current_url; ?>/promo/'+data;
                	$("#wallDemo").attr("src",data);
	                $(".iframe_div").css("min-height",'600px');
	                $("#wallDemo").show();
	                $('#wallUrl').val(data);  //$('#wallUrl').val(quize_page_url);
	                $("#iframe_url").show();
		        }
                $("#id").val("0");
                $('#logo').val("");
                $('#back').val("");
                $('#headline').val("");
                $('#cta').val("");
                $('#share').val("");
                $('#promo').val("");
                $('#Website').val("");
                window.location.reload();
                //data: return data from server
            }
        });
        e.preventDefault(); //STOP default action
    });

	$('.delpromotion').click(function(){
		if (!confirm("Do you want to delete?")){
	    	return false;
	    }
		var ID = $(this).attr("data-id");
		var postData = $(this).serializeArray();
		var formURL = 'promotion-ajax.php';
		postData.push({name: 'id', value: ID});
		postData.push({name: 'action', value: 'delete'});
		$.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data) {
            	//alert("Data Deleted...");
            	window.location.reload();
            }
        });
	});

	$('.editpromotion').click(function(){
		var ID = $(this).attr("data-id");
		var postData = $(this).serializeArray();
		var formURL = 'promotion-ajax.php';
		postData.push({name: 'id', value: ID});
		postData.push({name: 'action', value: 'edit'});
		$.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            dataType : "json",
            success:function(data) {
            	$( "#wallTitle" ).focus();
            	$('#id').val(data.id);
              $('#wallTitle').val(data.wallTitle);
              $('#logo').val(data.logo);
              $('#background').val(data.background);
              $('#headline').val(data.headline);
              $('#caption').val(data.caption);
              $('#FacebookUrl').val(data.FacebookUrl);
              $('#TwitterUrl').val(data.TwitterUrl);
              $('#YouTubeUrl').val(data.YouTubeUrl);
              $('#LinkedinUrl').val(data.LinkedinUrl);
              $('#cta').val(data.cta);
              $('#share').val(data.share);
              $('#promo').val(data.promo);
              $('#Website').val(data.Website);
              $('#visitor_target').val(data.visitor_target);
              
              if(data.hidelocker == 1)
              {
                  $('#hidelocker').prop('checked', true);
                  $('.onp-sl').hide();
                  $('.onp-sl-content').show();
              }
              else
              {
                  $('#hidelocker').prop('checked', false);
                  $('.onp-sl').show();
                  $('.onp-sl-content').hide();
              }
              
              
              //kiosk mode on off
              //kiosk mode on off
              if(data.kiosk_mode == 1)
                  $('#kiosk_mode').prop('checked', true);
              else
                  $('#kiosk_mode').prop('checked', false);
                
                
              //referral mode on off
              //referral mode on off
              if(data.referral_share_mode == 1)
                  $('#referral_share_mode').prop('checked', true);
              else
                  $('#referral_share_mode').prop('checked', false);  
                
                
              //checkbox for show upload picture
              //checkbox for show url profile
              if(data.show_profile_url == 1)
              {
                  $('#show_profile_url').prop('checked', true);
              }
              else
              {
                  $('#show_profile_url').prop('checked', false);
              }
              
              if(data.show_profile_picture == 1)
              {
                  $('#show_profile_picture_container').fadeIn();
                  $('#show_profile_picture').prop('checked', true);
              }
              else
              {
                  $('#show_profile_picture').prop('checked', false);
              }
              
              
                
              loadcheckfly();
            }
        });
	});
  
  //show hide locker
  //show hide locker
  //show hide locker
  $('#hidelocker').change(function(){
      if($(this).prop('checked') == true)
      {
        $('.onp-sl').hide();
        $('.onp-sl-content').show();
      }
      else
      {
        $('.onp-sl').show();
        $('.onp-sl-content').hide();  
      }
  })
  
  //show hide button social media in locker
  //show hide button social media in locker
  //show hide button social media in locker
  $('#FacebookUrl').change(function(){
    if($(this).val() == '')
      $('.onp-sl-facebook-like').hide();
    else
      $('.onp-sl-facebook-like').show();
  })
  
  $('#TwitterUrl').change(function(){
    if($(this).val() == '')
      $('.onp-sl-twitter-follow').hide();
    else
      $('.onp-sl-twitter-follow').show();
  })
  
  $('#YouTubeUrl').change(function(){
    if($(this).val() == '')
      $('.onp-sl-youtube-subscribe').hide();
    else
      $('.onp-sl-youtube-subscribe').show();
  })
  
  $('#LinkedinUrl').change(function(){
    if($(this).val() == '')
      $('.onp-sl-linkedin-share').hide();
    else
      $('.onp-sl-linkedin-share').show();
  })
  
  
  //kiosk mode enable will disable locker
  //kiosk mode enable will disable locker
  //kiosk mode enable will disable locker
  $('#kiosk_mode').change(function(){
      if($(this).prop('checked') == true)
      {
          $('#hidelocker').prop('checked', true);
          $('#referral_share_mode').prop('checked', false);
          $('#hidelocker').trigger('change');
          $('#show_profile_picture_container').fadeOut();
      }
      else
      {
          $('#hidelocker').prop('checked', false);
          $('#hidelocker').trigger('change');
          $('#show_profile_picture_container').fadeIn();
          $('#show_profile_picture').prop('checked', false);
      }
  })
  
  //referral mode enable will disable locker
  //referral mode enable will disable locker
  //referral mode enable will disable locker
  $('#referral_share_mode').change(function(){
      if($(this).prop('checked') == true)
      {
          $('#hidelocker').prop('checked', false);
          $('#kiosk_mode').prop('checked', false);
          $('#hidelocker').trigger('change');
          $('#kiosk_mode').trigger('change');
      }
      else
      {

      }
  })  
  

	$('#forgotpassword').click(function(){
		var action = 'forgot-password';
		var formURL = 'forgot-password-ajax.php';
		$.ajax({
            url : formURL,
            type: "POST",
            data : {action : action},
            dataType : "text",
            success:function(data) {
            	if(data == "0") {
            		alert("somthing went wrong please try after sometime.")
            	}else{
            		phone_btn_onclick();
            	}
            }
        });
	});
  
  function reset_share_stats()
  {
    $.post('/promo/sharecount-ajax.php', { 'action': 'reset' }, function(){
      window.location.reload()
    })
  }
</script>	  

<?php require_once 'footer-admin.php'; ?> 