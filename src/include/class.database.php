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

    /**
     *   insert function insert the json index in files
     * 
     */
    public function insert($values) {
        try {
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
            $data[$key] = $value;
            break;
        }
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
        return $data;
    }

    /*
     * delete the index of json
     */

    public function deletevalue($data) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $index_id = $_POST['id'];
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
                if ($key != $index_id) {
                    $new_data[$key] = $values;
                }
            }
            if (!empty($new_data)) {
                $myfile = fopen("data.json", "w") or die("Unable to open file!");
                fwrite($myfile, json_encode($new_data));
                fclose($myfile);
            }
            return true;
        } else {
            return false;
        }
    }

}
