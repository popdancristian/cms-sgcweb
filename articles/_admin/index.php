<?php
session_start(); //-- start session

include_once '_script/init.php';//-- include init

//-- FIX: www. admin proble with the editor ($_SERVER['SERVER_NAME'])
if ((!B_DEV) and (strpos($_SERVER['HTTP_HOST'],'www.') === false)) header("Location: ".URL_SITE."/index.php");

//-- if not logged redirect to index
if (!auth_logged()) {header("Location: ".URL_SITE."/login.php");die();}

//-- if we have some post pages, include script for submit
if (isset($attributes['submit'])) 
{
 if (!file_exists(PATH_SCRIPT.'/page_'.$attributes['page'].'_submit.php')) die('File error: '.PATH_SCRIPT.'/page_'.$attributes['page'].'_submit.php');
 else include_once PATH_SCRIPT.'/page_'.$attributes['page'].'_submit.php';
 die();
}

//-- include default script
include_once PATH_SCRIPT.'/default.php';

//-- get the page and template for include
if (empty($action)) 
{
    //-- if we don't have action -> manage
    $include_page = PATH_SCRIPT.'/page_'.$page.'.php';
    $include_template = PATH_SMARTY_TEMPLATE.'/page_'.$page.'.html';   
}
else
{
    $include_page = PATH_SCRIPT.'/page_'.$page.'_'.$action.'.php';
    $include_template = PATH_SMARTY_TEMPLATE.'/page_'.$page.'_'.$action.'.html';
}

//-- check if the template exists
if (!file_exists($include_template)) die('File error: '.$include_template);

//-- include page script (if exist)
if (file_exists($include_page)) include_once $include_page;

//-- assign page template
$o_smarty->assign('include_template', $include_template);

//-- assign and distroy success flag
if (isset($_SESSION['success']))
{
 $o_smarty->assign('success', $_SESSION['success']);
 unset($_SESSION['success']);
}

//-- display layout
$o_smarty->display('default.html');
?>