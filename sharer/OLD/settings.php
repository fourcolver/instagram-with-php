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