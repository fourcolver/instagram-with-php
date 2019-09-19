<?php

/*
 * Test Plugin 
 */

//For simplcity

//the classname must match the plugin zip name
class socialshare {

    //Plugin Information
    private $pluginInfo = array();

    function __construct() {
        $this->pluginInfo = array(
            'title' => 'Social Share', //The name of the plugin
            'image' => 'images/social_share.png', //location of the plugin image, relative to this file
            'network' => 'Facebook', //The network information
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. .',
        );
    }

    public function getPluginInfo() {
        return $this->pluginInfo;
    }
    
    public function getContent(){
        
        return '<div class="row align-items-center">
      <div class="col-6 mx-auto col-md-6 order-md-2">
        <img class="img-fluid mb-3 mb-md-0" src="/assets/img/bootstrap-stack.png" alt="" width="1024" height="860">
      </div>
      <div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
        <h1 class="mb-3 bd-text-purple-bright">Bootstrap</h1>
        <p class="lead">
          Build responsive, mobile-first projects on the web with the world\'s most popular front-end component library.
        </p>
        <p class="lead mb-4">
          Bootstrap is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with our Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful plugins built on jQuery.
        </p>
        <p class="text-muted mb-0">
          Currently v4.0.0
        </p>
      </div>
    </div>';
        
    }

}
