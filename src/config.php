<?php
ob_start();
error_reporting(E_ALL);
//session_set_cookie_params(0);
session_set_cookie_params(3600 * 24 * 7);
session_start();
include_once("class.db.php");
?>