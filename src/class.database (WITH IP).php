<?php

/**
 * class create for save the data into json file formate
 *
 * @author Asif
 */
class database {

    function __construct() {
        try {
            
        } catch (PDOException $e) {
            echo $e->getMessage(PDO::FETCH_ASSOC);
        }
    }
    
    function getClientIp() {
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
        return "117.2.161.9";
    }

    public function getAddress() {
        $city = '';  
        $ip_addpress_reply = json_decode(file_get_contents("https://api.ipinfodb.com/v3/ip-city/?key=2b3d7d0ad1a285279139487ce77f3f58d980eea9546b5ccc5d08f5ee62ce7471&ip=". $this->getClientIp() ."&format=json"));
        if(isset($ip_addpress_reply->cityName)){
          $city = $ip_addpress_reply->cityName;
         }
         return $city;
    }
    
    public function saveImage($user) {
        // $image = $user_data['user']['image'];
        // save to local
        // var_dump($user);die;
        if(empty($user['user']['id']) || empty($user['user']['image'])) return $user;
        $path = './image/'.strtolower($user['user']['service']);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if(strtolower($user['user']['service']) == 'facebook') {
            $image = file_get_contents("https://graph.facebook.com/v3.1/".$user['user']['id']."/picture?type=large");
        } else $image = file_get_contents($user['user']['image']);
        $result = file_put_contents($path.'/'.$user['user']['id'].'.jpg', $image);
        $user['user']['image']=$path.'/'.$user['user']['id'].'.jpg';
        return $user;
    }

    /**
     *   insert function insert the json index in files
     * 
     */
    public function insert($type = '',$values = array()) {
        // check the user is exsting
        $infos = $this->gettabledata();
        if (!empty($infos)) {
            $temp_data = end(json_decode($values['data'], true));
           
            foreach ($infos as $key => $item) {
                
                if ($temp_data['user']['id'] == $item->user->id) {
                    return false;
                }
            }
        }
        
        // add Addresss
        $temp_data = json_decode($values['data'], true);
        foreach($temp_data as $key => $row) {
            foreach ($row as $k => $user) {
                if ($k == 'user') {
                    $temp_data[$key][$k]['address'] = $this->getAddress();
                }
            }
        }
        $values['data'] = json_encode($temp_data);

        try {
            if (isset($_SESSION['interest_value']) && ($_SESSION['interest_value'] != '') ) {
                $interest_value = $_SESSION['interest_value'];
                if (isset($values['data'])) {
                    $temp_data= json_decode($values['data'], true);

                    foreach($temp_data as $key => $row) {
                        foreach ($row as $k => $user) {
                            if ($k == 'user') {
                                $temp_data[$key][$k]['interest'] = $interest_value;
                            }
                        }
                    }
                    
                    $values['data'] = json_encode($temp_data);
                }
                unset($_SESSION['interest_value']);
            }
            $this->saveasfile($values['data']);
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /*
     * save json in the file as new index
     * 
     * 
     */

    public function saveasfile($insert_data) {

        $file_size = filesize("data.json");
        $data = array();
        if ($file_size > 0) {
            $myfile = fopen("data.json", "r") or die("Unable to open file!");
            $data = fread($myfile, filesize("data.json"));
            $data = (array) json_decode($data);
        }
        
        $new_data = array();
        $data = (array) $data;
        $insert_data = (array) json_decode($insert_data);

        foreach ($insert_data as $key => $value) {
            $data[uniqid()] = $value;
            break;
        }

        //echo "<pre>"; print_r($insert_data); die;
        $new_data = $data;
        if (!empty($new_data)) {
            $myfile = fopen("data.json", "w") or die("Unable to open file!");
            fwrite($myfile, json_encode($new_data));
            fclose($myfile);
        }
        return true;
    }

    /*
     * Parser the user json social media json 
     * return saveable index of array
     * 
     */

    public function returnarray($userinfo, $values) {

        $data = array();
        if ($values == 0) {
            
        } elseif ($values == 1) {

            foreach ($userinfo as $key => $user) {
                $data[] = array("title" => (empty($user->displayName) ? $user->fileAs : $user->displayName),
                    "phone" => $user->mobilePhone,
                    "email" => (isset($user->emailAddresses[0]->name) ? $user->emailAddresses[0]->name : ""),
                );
            }
        }
        return $data;
    }

    /*
     * return  fetch indexes of json available
     */

    public function gettabledata() {
        $myfile = fopen("data.json", "r") or die("Unable to open file!");
        $data = fread($myfile, filesize("data.json"));
        $data = (array) json_decode($data);
        rsort($data);
        return $data;
    }

    /*
     * delete the index of json
     */

    public function deletevalue($data) {
        if (isset($_POST['id']) && ($_POST['id']) >= 0) {
            $index_id = $_POST['id'];
            $service =  $_POST['service'];
            $file_size = filesize("data.json");
            $data = array();
            if ($file_size > 0) {
                $myfile = fopen("data.json", "r") or die("Unable to open file!");
                $data = fread($myfile, filesize("data.json"));
                $data = (array) json_decode($data);
            }
            $new_data = array();
            $data = (array) $data;

            foreach ($data as $key => $values) { 
                if ($values->user->id != $index_id && $values->user->service != $service ) {
                    $new_data[$key] = $values;
                } else {
                    // delete image 
                    if(file_exists($values->user->image)) {
                        $a = unlink($values->user->image);
                        var_dump($a);
                    }
                }
            }
            $myfile = fopen("data.json", "w") or die("Unable to open file!");
            fwrite($myfile, json_encode($new_data));
            fclose($myfile);
            
            return true;
        } else {
            return false;
        }
    }

}
