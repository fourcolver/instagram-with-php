<?php
error_reporting(0);
//error_reporting(E_ALL);
require_once ('src/class.database.php');
$dbobj = new database();
$response_data = array();

///////////////////////// LOGIN APPS /////////////////////////
ob_start();
$timeout = 604800;
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', $timeout);
// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params($timeout);
session_start();
$now = time();

if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

$interest    = $_GET['r'];
if  ($interest != '') {
    $_SESSION['interest_value']  = $interest;
}

$logo = isset($_SESSION['logo']) ? $_SESSION['logo'] : '';
$background = isset($_SESSION['background']) ? $_SESSION['background'] : '';
$headline = isset($_SESSION['headline']) ? $_SESSION['headline'] : '';
$caption = isset($_SESSION['caption']) ? $_SESSION['caption'] : '';
$cta = isset($_SESSION['cta']) ? $_SESSION['cta'] : '';
$share = isset($_SESSION['share']) ? $_SESSION['share'] : '';
$promo = isset($_SESSION['promo']) ? $_SESSION['promo'] : '';
$url = isset($_SESSION['url']) ? $_SESSION['url'] : '';
$base_url = "./";

$Configuration = array(
    #Base url
    "base_url" => $base_url,
    #Facebook details
    "facebook_appid" => "102018820150735",
    "facebook_appsecret" => "3c3a0d2a95b5ff7f7da778b89f0bfb12",
    "facebook_redirect_url_slug" => "",
    "facebook_redirect_url" => $base_url . "offer.php?type=facebook",
);

$ActiveServices = array(
    "facebook" => true, # set true to ativate facebook subscribers
);

$responsePage = array("success" => "success",
    "error" => "error",
    "repeated" => "repeated",
    "bad_email" => "bad_email",
    "phone_verified" => "phone_verified",
);

if (isset($_GET['type'])) 
{
// For Facebook
    if ($_GET['type'] == 'facebook') {
        if (!$ActiveServices["facebook"]) {
            exit("Service not active!");
        }
        require_once("src/Facebook.class.php");
        $response = json_decode(Facebook::get_email());
        if (isset($response->status) && $response->status == "url") 
        {
            header("Location: " . $response->data->url);
        } 
        else if (isset($response->status) && $response->status == "success") 
        {
            $user_data = array();
            $user_data['user']['id'] = $response->data->user->id;
            $user_data['user']['displayName'] = $response->data->user->displayName;
            $user_data['user']['gender'] = $response->data->user->gender;
            $user_data['user']['birthday'] = $response->data->user->birthday;;
            $user_data['user']['email'] = $response->data->user->email;
            $user_data['user']['image'] = $response->data->user->image;
            $user_data['user']['record_count'] = "";
            $user_data['user']['service'] = "Facebook";			
            $user_data['records'] = "";
            $user_data['user']['interest'] = isset($_GET['r'])?$_GET['r']:''; 
            $values = array("data" => json_encode(array('222'.$response->data->user->id => $user_data)), "service_type" => 5);
            
            echo $values;
            $dbobj->insert("user_data", $values);
            
            $_SESSION['dashboard_uid'] = $response->data->user->id;
            $_SESSION['name'] = $response->data->user->displayName;
            $_SESSION['image'] = $response->data->user->image;
            $_SESSION['discard_after'] = $now + $timeout;
            ?>
            <script type="text/javascript">
                opener.location.href = '<?php echo $base_url; ?>offer.php?msg=success';
                close();
            </script>
            <?php
        } else {
            $page = $responsePage['error'];
        }
    }
}

// For WhatsApp
if (isset($_POST["code"])) 
{
    $_SESSION["code"] = $_POST["code"];
    $_SESSION["csrf_nonce"] = $_POST["csrf_nonce"];
    $ch = curl_init();
    
    // Set url elements
    $fb_app_id = '102018820150735';
    $ak_secret = '668b3f6885046eef0d3dfb2e42fbb6de';
    $token = "AA|$fb_app_id|$ak_secret";
    
    // Get access token
    $url = 'https://graph.accountkit.com/v1.1/access_token?grant_type=authorization_code&code=' . $_POST["code"] . '&access_token=' . $token;
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
    $user_ac_id = isset($final->id) ? $final->id : '';
    $phone = isset($final->phone->number) ? $final->phone->number : '';
    $page = $responsePage['phone_verified'];
}

//$page = $responsePage['phone_verified'];
function getRealIpAddr() 
{
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
function get_location_using_ip($ip_address='') 
{
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
            $ch = curl_init('http://extreme-ip-lookup.com/json/'.$ip_address);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
            $api_result = json_decode($json, true);
            $_SESSION['locationType'] = "3";
        }
        if(empty($api_result['country'])) {
            $ch = curl_init('http://extreme-ip-lookup.com/json/'.$ip_address);
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

if (isset($_POST['get_content'])) 
{
    $user_data = array();
    $user_data['user']['id'] = isset($_POST['user_ac_id']) ? $_POST['user_ac_id'] : rand(10,100);
    $user_data['user']['displayName'] = $_POST['firstname'].' '.$_POST['lastname'];
    $user_data['user']['gender'] = "";
    $user_data['user']['number'] = $_POST['phone'];
    $user_data['user']['image'] = '';
    $user_data['user']['record_count'] = "";
    $user_data['records'] = "";
    $user_data['user']['service'] = "WhatsApp";
    $user_data['user']['interest'] = isset($_GET['r'])?$_GET['r']:''; 
    $values = array("data" => json_encode(array($user_data['user']['id'] => $user_data)), "service_type" => 5);
    $dbobj->insert("user_data", $values);
    
    if(isset($_POST['parantID']))
    {
        $data = file_get_contents('promouserdata.json');
        $infos = json_decode($data, true);
        
        if(!empty($infos)) 
        {
            $cnt = count($infos) - 1;
            $cnt1 = $infos[$cnt]['id'];
            $cnt = $cnt1 + 1;
        } 
        else 
        {
            $cnt = 1;
        }
        
        $DataIDArr = explode('&', $_POST['parantID']);
        $ReferUserID = $DataIDArr['0'];
        $PromoID = $DataIDArr['1'];
        $CampaignName = $DataIDArr['2'];
        $ip_address = getRealIpAddr();
        $ip_addressData = get_location_using_ip($ip_address);
        
        if(isset($_SESSION['locationType'])) 
        {
            if($_SESSION['locationType'] == "1")
            {
                $UserLocation = $ip_addressData['city'].", ".$ip_addressData['country_name'];
            }
            if($_SESSION['locationType'] == "2" || $_SESSION['locationType'] == "3")
            {
                $UserLocation = $ip_addressData['city'].", ".$ip_addressData['country'];
            }
        }
        else
        {
            $UserLocation = "";
        }
        
        $promo_user_data = array();
        $promo_user_data['user']['id'] = $cnt;  //isset($_POST['user_ac_id']) ? $_POST['user_ac_id'] : rand(10,100);
        $promo_user_data['user']['displayName'] = $_POST['firstname'];
        $promo_user_data['user']['gender'] = "";
        $promo_user_data['user']['number'] = $_POST['phone'];
        $promo_user_data['user']['location'] = $UserLocation;
        $promo_user_data['user']['campaignName'] = $CampaignName;
        $promo_user_data['user']['image'] = '';
        $promo_user_data['user']['record_count'] = "";
        $promo_user_data['records'] = "";
        $promo_user_data['user']['service'] = "WhatsApp";
        $promo_user_data['user']['interest'] = isset($_GET['r'])?$_GET['r']:'';
        $promo_user_data['user']['referadminid'] = $ReferUserID;
        $promo_user_data['user']['promoid'] = $PromoID;
        $promo_user_data['user']['passcode'] = $_POST['passcode'];
        
        if(@$_FILES['profile_picture']['name'] != '')
        { 
          $path = "uploads/";
          $filename = basename( $_FILES['profile_picture']['name']);
          $path = $path . $filename;
          move_uploaded_file($_FILES['profile_picture']['tmp_name'], $path);
        }
        $promo_user_data['user']['profile_picture'] = $filename;
        $promo_user_data['user']['profile_url'] = $_POST['profile_url'];
        
        $data = file_get_contents('promouserdata.json');
        $json_arr = json_decode($data, true);
        $json_arr[] = $promo_user_data;
        
        file_put_contents('promouserdata.json', json_encode($json_arr));
        
        //$_SESSION['dashboard_uid'] = $promo_user_data['user']['id'];
        $_SESSION['dashboard_uid'] = $ReferUserID;
    }
    else
    {
        $_SESSION['dashboard_uid'] = $user_data['user']['id'];
    }
    
    //$_SESSION['dashboard_uid'] = $user_data['user']['id'];
    
    $_SESSION['verified_phone'] = $_POST['phone'];
    $_SESSION['dashboard_uid_admin'] = 'visitoruser';
    $_SESSION['name'] = $user_data['user']['displayName'];
    $_SESSION['image'] = "img/default.jpg";
    $_SESSION['discard_after'] = $now + $timeout;
    $DataIDArr = explode('&', $_POST['parantID']);
    $ReferUserID = $DataIDArr['0'];
    
    //if this is promo with referal share mode then go to sharer page
    //else go to offer page
    if($_SESSION['referral_share_mode'] == 1)
    {
        header("Location: sharer.php");
    }
    else
    {
        header("Location: offer.php?msg=success&parentid=".$ReferUserID);
    }
    
    $group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';
    $api_key = isset($_SESSION['api_key']) ? $_SESSION['api_key'] : '';
    httpPost($url, $fields);
    $page = $responsePage['success'];
}

if (!isset($page))
    $page = '';
?>