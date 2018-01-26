<?php
set_time_limit(0);
session_start(); //-- start session

if (empty($_SESSION['domainid'])) die('Please select a domain!');

include_once '../_conf/config.php';//-- include config

include_once PATH_LIB.DIR_SEP.'db.lib.php';
include_once PATH_LIB.DIR_SEP.'util.lib.php';

//$a_param = array('config','lang','page','category','a_category'=>array(9982),'script','link','adsense');
$a_param = array('lang');
$a_cache = update_cache($_SESSION['domainid']);
for ($i=0;$i<count($a_cache);$i++) echo $a_cache[$i]."<br/>";
echo 'Done.';
?>