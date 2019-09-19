<?php
if(isset($_POST))
{
	$PromotionList = $_POST;
	$action = $PromotionList['action'];
  
	if($action == "insert") 
  {
		// read json file
		$data = file_get_contents('promotiondata.json');
		$json_arr = json_decode($data, true);

		$cnt = count($json_arr) - 1;
		$cnt1 = $json_arr[$cnt]['id'];
		$cnt = $cnt1 + 1;

		$OfferURL = "https://suite.social/promo/offer-app.php?id=".$PromotionList['UserID']."&".$cnt."&".str_replace(" ", "", $PromotionList['wallTitle']);
		$promotion_data = array(  'id' => $cnt, 
                              'UserID' => $PromotionList['UserID'], 
                              'wallTitle' => str_replace(" ", "", $PromotionList['wallTitle']), 
                              'logo' => $PromotionList['logo'], 
                              'background' => $PromotionList['background'], 
                              'headline' => $PromotionList['headline'], 
                              'caption' => $PromotionList['caption'], 
                              'FacebookUrl' => $PromotionList['FacebookUrl'], 
                              'TwitterUrl' => $PromotionList['TwitterUrl'], 
                              'YouTubeUrl' => $PromotionList['YouTubeUrl'], 
                              'LinkedinUrl' => $PromotionList['LinkedinUrl'], 
                              'cta' => $PromotionList['cta'], 
                              'share' => $PromotionList['share'], 
                              'promo' => $PromotionList['promo_url'], 
                              'Website' => $PromotionList['Website'], 
                              'offerurl' => $OfferURL,
                              'hidelocker' => isset($PromotionList['hidelocker'])?$PromotionList['hidelocker']:0, 
                              'kiosk_mode' => isset($PromotionList['kiosk_mode'])?$PromotionList['kiosk_mode']:0, 
                              'show_profile_url' => isset($PromotionList['show_profile_url'])?$PromotionList['show_profile_url']:0, 
                              'show_profile_picture' => isset($PromotionList['show_profile_picture'])?$PromotionList['show_profile_picture']:0, 
                              'referral_share_mode' => isset($PromotionList['referral_share_mode'])?$PromotionList['referral_share_mode']:0, 
                              'visitor_target' => isset($PromotionList['visitor_target'])?$PromotionList['visitor_target']:0, 
                            );
                            
		$json_arr[] = $promotion_data;
		// encode json and save to file
		file_put_contents('promotiondata.json', json_encode($json_arr));
		echo $OfferURL;
	}
  
	if($action == "edit") 
  {
		$promotiondata = file_get_contents('promotiondata.json');
        // decode json to associative array
        $promotion = json_decode($promotiondata, true);
        if(!empty($promotion)) {
        	foreach ($promotion as $key => $value) {
		    	if($value['id'] == $PromotionList['id']) {
		    		$json_arr = $value;
		    		break;
		    	}
			}
			echo json_encode($json_arr, true);
		}
	}
  
	if($action == "update") {
		// read json file
		$data = file_get_contents('promotiondata.json');
		$promotion = json_decode($data, true);
    $OfferURL = "https://suite.social/promo/offer-app.php?id=".$PromotionList['UserID']."&".$PromotionList['id']."&".str_replace(" ", "", $PromotionList['wallTitle']);
    
		if(!empty($promotion)) {
      foreach ($promotion as $key => $value) 
          {
		    	if($value['id'] == $PromotionList['id']) {
		    		$promotion[$key]['UserID'] = $PromotionList['UserID'];
		    		$promotion[$key]['wallTitle'] = str_replace(" ", "", $PromotionList['wallTitle']);
		    		$promotion[$key]['logo'] = $PromotionList['logo'];
		    		$promotion[$key]['background'] = $PromotionList['background'];
		    		$promotion[$key]['headline'] = $PromotionList['headline'];
		    		$promotion[$key]['caption'] = $PromotionList['caption'];
		    		$promotion[$key]['FacebookUrl'] = $PromotionList['FacebookUrl'];
		    		$promotion[$key]['TwitterUrl'] = $PromotionList['TwitterUrl'];
		    		$promotion[$key]['YouTubeUrl'] = $PromotionList['YouTubeUrl'];
            $promotion[$key]['LinkedinUrl'] = $PromotionList['LinkedinUrl'];
		    		$promotion[$key]['cta'] = $PromotionList['cta'];
		    		$promotion[$key]['share'] = $PromotionList['share'];
		    		$promotion[$key]['promo'] = $PromotionList['promo_url'];
		    		$promotion[$key]['Website'] = $PromotionList['Website']; 
            $promotion[$key]['hidelocker'] = isset($PromotionList['hidelocker'])?$PromotionList['hidelocker']:0;
            $promotion[$key]['kiosk_mode'] = isset($PromotionList['kiosk_mode'])?$PromotionList['kiosk_mode']:0;
            $promotion[$key]['show_profile_url'] = isset($PromotionList['show_profile_url'])?$PromotionList['show_profile_url']:0;
            $promotion[$key]['show_profile_picture'] = isset($PromotionList['show_profile_picture'])?$PromotionList['show_profile_picture']:0;
            $promotion[$key]['offerurl'] = $OfferURL;
            $promotion[$key]['referral_share_mode'] = isset($PromotionList['referral_share_mode'])?$PromotionList['referral_share_mode']:0;
            $promotion[$key]['visitor_target'] = isset($PromotionList['visitor_target'])?$PromotionList['visitor_target']:0;
		    	}
			}
			$json_arr = $promotion;
		}
		
		// encode json and save to file
		file_put_contents('promotiondata.json', json_encode($json_arr));
		echo $OfferURL;
	}
  
	if($action == "delete") 
  {
		// read json file
		$data = file_get_contents('promotiondata.json');
		$promotion = json_decode($data, true);
		$arr_index = array();
		if(!empty($promotion)) {
        	foreach ($promotion as $key => $value) {
		    	if($value['id'] == $PromotionList['id']) {
		    		$arr_index[] = $key;
		    	}
			}
			// delete data
			foreach ($arr_index as $i) {
			    unset($promotion[$i]);
			}
			$json_arr = array_values($promotion);
		}
		// encode json and save to file
		file_put_contents('promotiondata.json', json_encode($json_arr));
		echo "data deleted...";
	}
}
?>