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

	///////////////////////// SHARELOCK HEADER - END //////
	
	
	///////////////////////// SHARELOCK SETTINGS - START //////	
		
    $type = 'Promotion';
	$image = 'https://suite.social/images/banner/home1.jpg';	
    $headline = '50% off Social Suite: Business';
    $caption = 'Share with friends to claim the offer. Hurry, offer ends soon!';
	$website = 'https://suite.social';	
	$promo = 'https://api.whatsapp.com/send?phone=447436905728&text=Half%20off%20Social%20Suite%20Business';
	$network = 'facebook';
	$color = '#3b5998';
	$shareurl = 'whatsapp://send?text=';
	
	$_SESSION['type'] = $type;
	$_SESSION['image'] = $image;
	$_SESSION['headline'] = $headline;
	$_SESSION['caption'] = $caption;
	$_SESSION['website'] = $website;	
	$_SESSION['promo'] = $promo;	
	$_SESSION['network'] = $network;
	$_SESSION['color'] = $color;
	$_SESSION['shareurl'] = $shareurl;	
	
	///////////////////////// SHARELOCK SETTINGS - END //////	

?>