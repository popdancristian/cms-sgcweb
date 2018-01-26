<?php
set_time_limit(0);
session_start(); //-- start session

if (empty($_SESSION['domainid'])) die('Please select a domain!');

include_once '../_conf/config.php';//-- include config

//-- include libraries
include_once PATH_CLASS.DIR_SEP.'WebmasterTools.php';
include_once PATH_LIB.DIR_SEP.'db.lib.php';
include_once PATH_LIB.DIR_SEP.'util.lib.php';

$_DOMAIN= $o_db->getRow('SELECT * from '.DB_PREFIX.'domain where domainid = '.intval($_SESSION['domainid']));//-- get domain
$_CONFIG = getConfig($_DOMAIN['domainid']);//-- get config

$a_param = $_GET;
if (isset($_GET['action']))
{
    $a_param = array();
    if ($_GET['action'] == 'all') 
    {
        $_DOMAIN['google'] = 0;
        $o_db->query('UPDATE '.DB_PREFIX.'domain SET google = 0 WHERE domainid='.$_DOMAIN['domainid']);
        $o_db->query('UPDATE '.DB_PREFIX.'domain_category SET google = 0 WHERE domainid='.$_DOMAIN['domainid']);
    }
}

$a_sitemap = submit_sitemap($a_param);

if (isset($_SERVER['HTTP_REFERER']) and isset($_GET['page'])) 
{
    if (empty($a_sitemap)) $_SESSION['success'] = false;
    else $_SESSION['success'] = true;
    header('Location: '.$_SERVER['HTTP_REFERER']);
}
else
{
    if (empty($a_sitemap)) echo 'Already done.';
    else
    {
        for ($i=0;$i<count($a_sitemap);$i++) echo $a_sitemap[$i]."<br/>";
        echo 'Done.';
    }
}
?>