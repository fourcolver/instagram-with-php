<?php

class pluginReader {

    public $pluginname = NULL;
    public $message = '';

    public function __construct() {
        //not for production mode
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    public function getPluginInfo() {
        if (file_exists(BASE . '/plugins/' . $this->pluginname . '/' . 'admin.php')) {
            require_once BASE . '/plugins/' . $this->pluginname . '/' . 'admin.php';

            $uploaded_plugin = new $this->pluginname;
            return $uploaded_plugin->getPluginInfo();
        }
        return FALSE;
    }

    public function readPlugin() {

        $filename = $_FILES["zip_file"]["name"];
        $source = $_FILES["zip_file"]["tmp_name"];
        $type = $_FILES["zip_file"]["type"];

        $name = explode(".", $filename);
        $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
        foreach ($accepted_types as $mime_type) {
            if ($mime_type == $type) {
                $okay = true;
                break;
            }
        }

        $continue = strtolower($name[1]) == 'zip' ? true : false;
        if (!$continue) {
            $message = "The file you are trying to upload is not a .zip file. Please try again.";
        }

        $foldername = $name[0];

        $target_path = BASE . '/plugins/zips/' . $filename;  // change this to the correct site path
        //make sure the folder is writable
        chmod(BASE . '/plugins/zips/', 0777);

        if (move_uploaded_file($source, $target_path)) {
            $zip = new ZipArchive();
            $x = $zip->open($target_path);
            if ($x === true) {
                chmod(BASE . '/plugins/', 0777);

                //delete all contents if existing
                if (file_exists(BASE . '/plugins/' . $foldername)) {
                    $this->deletefiles(BASE . '/plugins/' . $foldername);
                }
                $zip->extractTo(BASE . '/plugins/'); // change this to the correct site path
                $zip->close();

                unlink($target_path);
                $this->pluginname = $foldername;
            }
            $message = "Your .zip file was uploaded and unpacked.";
        } else {
            $message = "There was a problem with the upload. Please try again.";
        }
        $this->message = $message;
    }

    public function getPluginContent($pluginname) {
        //we will read the content of contentsource/content.php
        //displaying whatever is there
        if(file_exists(BASE.'/plugins/'.$pluginname.'/index.php')){
            require_once(BASE.'/plugins/'.$pluginname.'/index.php');
            
            $uploaded_plugin = new $pluginname;
            return $uploaded_plugin->getContent();
        }
        return 'Plugin missing index file.';
    }
    
    public function getAllPlugins(){
        $path = BASE.'/plugins';
        $plugins = array();
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot() && $fileinfo->getFilename() != 'zips') {
                $this->pluginname = $fileinfo->getFilename();
                $plugin = $this->getPluginInfo();
                $plugin['pluginname'] = $this->pluginname;
                $plugins[] = $plugin;
            }
        }

        return $plugins;
        
    }

    public function url() {
//        return sprintf(
//                "%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME']
//        );
        
        return BASE_URL;
    }
    
    public function getPluginName(){
        return $this->pluginname;
    }
    
    public function deletePlugin($pluginname){
        if(file_exists(BASE.'/plugins/'.$pluginname)){
            $this->deletefiles(BASE.'/plugins/'.$pluginname);
        }
        return TRUE;
    }

    /*
     * php delete function that deals with directories recursively
     */

    /*
    //Sorry this one not working if we have .htaccess .DS_STORE file
    public function deletefiles($target) {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                echo $file."<br>";
                //$this->deletefiles($file);
            }
            
            //if (file_exists($target)) {
            //    rmdir($target);
            //}
        } elseif (is_file($target) && file_exists($target)) {
            unlink($target);
        }
    }
    */
    
    function deletefiles($dir_to_erase) 
    {
        $files = new DirectoryIterator($dir_to_erase);
        foreach ($files as $file) {
            // check if not . or ..
            if (!$file->isDot()) {
                $file->isDir() ? $this->deletefiles($file->getPathname()) : unlink($file->getPathname());
            }
        }
        rmdir($dir_to_erase);
        return;
    }

}

?>