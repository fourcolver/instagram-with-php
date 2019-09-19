<?php

/**
 * class create for save the data into json file formate
 *
 * @Suite.Social
 */
class database {

    function __construct() {
        try {
            
        } catch (PDOException $e) {
            echo $e->getMessage(PDO::FETCH_ASSOC);
        }
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
            $data[] = $value;
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

    public function deletevalue($data) 
    {
        if (isset($_POST['number'])) 
        {
            $number = $_POST['number'];
            $promoid = $_POST['promoid'];
            $file_size = filesize("promouserdata.json");
            $data = array();
            
            if ($file_size > 0) 
            {
                $myfile = fopen("promouserdata.json", "r") or die("Unable to open file!");
                $data = fread($myfile, filesize("promouserdata.json"));
                $data = (array) json_decode($data);
            }
            $new_data = array();
            $data = (array) $data;

            foreach ($data as $key => $values) {
                if ($values->user->number === $number && $values->user->promoid === $promoid) 
                {
                    //dont insert into new array 
                    //or we can say it will be deleted 
                }
                else
                {
                    $new_data[$key] = $values;
                }
            }
            
            //echo "<pre>";
            //print_r($new_data);
            //echo "</pre>";
            //die();
            
            //foreach ($data as $key => $values) 
            //{
            //    if ($values->user->email != $index_id) 
            //    {
            //        $new_data[$key] = $values;
            //    }
            //}
            
            $myfile = fopen("promouserdata.json", "w") or die("Unable to open file!");
            fwrite($myfile, json_encode($new_data));
            fclose($myfile);
            return true;
        } 
        else 
        {
            return false;
        }
    }

}
