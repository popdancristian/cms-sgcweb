<?php
session_start(); //-- start session

include_once '_script/init.php';//-- include init

//-- if logged redirect to index
if (auth_logged()) header("Location: ".URL_SITE."/index.php");

$page = 'login';//-- update page

//-- if we have some post pages, include script for submit
if (isset($attributes['submit'])) include_once PATH_SCRIPT.'/page_login_submit.php';

//-- include default script
//include_once PATH_SCRIPT.'/default.php';

//-- include page login
include_once PATH_SCRIPT.'/page_login.php';

//-- display login layout
$o_smarty->display('login.html');

?>