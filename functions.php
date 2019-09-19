<?php

//we might move later to higher hierarchy
//using class
//but maybe later 
//not enough time and budget
//make sure already called session_start()

function get_promodata_by_id($promo_id)
{
    $promotiondata = file_get_contents('promotiondata.json');
    $promotion = json_decode($promotiondata, true);
    
    if(!empty($promotion)) 
    {
        foreach ($promotion as $key => $value) 
        {
            if($value['id'] == $promo_id)
            {
                $headline = $value['headline'];
                $caption = $value['caption'];
                $greeting = 'Hi lucky social media user!';
                $cta = $value['cta'];
                $logo = '<img class="image-responsive" height="80px" src="'.$value['logo'].'">';
                $picture = $value['background'];
                $promo = $value['promo'];
                $FacebookUrl = $value['FacebookUrl'];
                $TwitterUrl = $value['TwitterUrl'];
                $YouTubeUrl = $value['YouTubeUrl'];
                $LinkedinUrl = $value['LinkedinUrl'];
                $website = $value['Website'];
                $share = $value['share'];
                $fbpage = $value['FacebookUrl'];
                $content = 'Check this out: https://suite.social/ - you will love it!';
                $min_contacts = '5';
                $hidelocker = $value['hidelocker'];
                $kiosk_mode = $value['kiosk_mode'];
                $show_profile_url = $value['show_profile_url'];
                $show_profile_picture = $value['show_profile_picture'];
                $referral_share_mode = $value['referral_share_mode'];
                $visitor_target = $value['visitor_target'];
                $promo_id = $value['id'];
                $admin_id = $value['UserID'];

                $_SESSION['PromotionID'] = $promo_id;
                $_SESSION['headline'] = $headline;
                $_SESSION['caption'] = $caption;
                $_SESSION['greeting'] = $greeting; 
                $_SESSION['cta'] = $cta;
                $_SESSION['logo'] = $logo;
                $_SESSION['FacebookUrl'] = $FacebookUrl;
                $_SESSION['TwitterUrl'] = $TwitterUrl;
                $_SESSION['YouTubeUrl'] = $YouTubeUrl;
                $_SESSION['LinkedinUrl'] = $LinkedinUrl;
                $_SESSION['picture'] = $picture;
                $_SESSION['promo'] = $promo;
                $_SESSION['website'] = $website;
                $_SESSION['share'] = $share;
                $_SESSION['fbpage'] = $fbpage;
                $_SESSION['content'] = $content;
                $_SESSION['min_contacts'] = $min_contacts;
                $_SESSION['hidelocker'] = $hidelocker;
                $_SESSION['kiosk_mode'] = $kiosk_mode;
                $_SESSION['show_profile_url'] = $show_profile_url;
                $_SESSION['show_profile_picture'] = $show_profile_picture;
                $_SESSION['dashboard_uid'] = $admin_id;
                $_SESSION['referral_share_mode'] = $referral_share_mode;
                $_SESSION['visitor_target'] = $visitor_target;
                
                //refresh cookie
                //cookie will expire in 30 days
                foreach($_SESSION as $key => $value)
                {
                    setcookie($key, $value, time() + (30 * 24 * 60 * 60));
                }

                
                //echo "<pre>";
                //print_r($value);
                //print_r($_SESSION);
                //echo "</pre>";
            
                break;
            }
        }
    }
}


// Function to get the client IP address
function get_client_ip() 
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    
    return $ipaddress;
}