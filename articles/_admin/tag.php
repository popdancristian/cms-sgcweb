<?php
set_time_limit(0);
session_start(); //-- start session

if (empty($_SESSION['domainid'])) die('Please select a domain!');

include_once '../_conf/config.php';//-- include config

//-- include libraries
include_once PATH_LIB.DIR_SEP.'db.lib.php';
include_once PATH_LIB.DIR_SEP.'util.lib.php';

if (isset($_GET['action']) and ($_GET['action']=='all'))
{
    //-- delete all tags and update articles
    $o_db->query('delete from '.DB_PREFIX.'tag where domainid = '.$_SESSION['domainid']);
    $o_db->query('update '.DB_PREFIX.'domain_article set updatetag = 0 where domainid = '.$_SESSION['domainid']);
}

$a_tag = generate_tag($_SESSION['domainid']);

if (empty($a_tag)) echo 'Already done.';
else
{
    for ($i=0;$i<count($a_tag);$i++) echo $a_tag[$i]."<br/>";
    echo 'Done.';
}
?>