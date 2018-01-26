<?php
set_time_limit(0);
session_start();

if (empty($_SESSION['domainid'])) die('Please select a domain!');

include_once '../_conf/config.php';//-- include config

include_once PATH_LIB.DIR_SEP.'db.lib.php';

function _l($str_name)
{
    global $_l;
    if (isset($_l[$str_name])) return $_l[$str_name];
    else return $str_name;
}

$_l = array();
$a_lang = $o_db->getAll("SELECT * from cms_lang WHERE domainid = ".$_SESSION['domainid']);
for ($i=0;$i<count($a_lang);$i++) $_l[$a_lang[$i]['lang_name']] = $a_lang[$i]['lang_value'];

//-- include libraries
include_once PATH_LIB.DIR_SEP.'function.lib.php';
include_once PATH_LIB.DIR_SEP.'rewritengine.lib.php';

include_once PATH_LIB.DIR_SEP.'util.lib.php';

$_DOMAIN= $o_db->getRow('SELECT * from '.DB_PREFIX.'domain where domainid = '.intval($_SESSION['domainid']));//-- get domain
$_CONFIG = getConfig($_DOMAIN['domainid']);//-- get config

$a_param = $_GET;
if (isset($_GET['action']))
{
    if ($_GET['action'] == 'all') 
    {
        $str_sitemap_path = $_DOMAIN['path'];
        if (!empty($_CONFIG['sitemap_dir'])) $str_sitemap_path.=DIR_SEP.$_CONFIG['sitemap_dir'];

        //-- delete all old files with .xml extension        
        $a_file = array();
        if ($handle = opendir($str_sitemap_path))
        {
            while (false !== ($file = readdir($handle))) 
            {
                $a_ext = explode('.', $file);
                if ($file != "." and $file != ".." and ($a_ext[count($a_ext)-1]=='xml') ) $a_file[] =  $file;
            }
            closedir($handle);
        }
        for ($i=0;$i<count($a_file);$i++) @unlink($str_sitemap_path.DIR_SEP.$a_file[$i]);
        
        $a_param = array();
    }
    elseif ($_GET['action'] == 'new') 
    {
        //-- check the existing sitemaps
        $a_category = $o_db->getAssoc("SELECT title,google,c.categoryid from ".DB_PREFIX."category c
                               INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                               WHERE dc.active = 1 and dc.domainid=".$_DOMAIN['domainid']." ORDER BY title",'categoryid');

        $str_sitemap_path = $_DOMAIN['path'];
        if (!empty($_CONFIG['sitemap_dir'])) $str_sitemap_path.=DIR_SEP.$_CONFIG['sitemap_dir'];

        $a_file = array();
        if ($handle = opendir($str_sitemap_path))
        {
            while (false !== ($file = readdir($handle))) 
            {
                if ($file != "." && $file != "..") $a_file[] =  $file;
            }
            closedir($handle);
        }

        $a_default_sitemap = array('sitemap.xml','keyword.xml','tag.xml');
        $a_param = array('file'=>array(),'categoryid'=>array());
        for ($i=0;$i<count($a_default_sitemap);$i++)
        {
            $b_found = (in_array($a_default_sitemap[$i],$a_file)) ? 1 : 0;
            if (!$b_found) $a_param['file'][] = $a_default_sitemap[$i];
        }
        foreach ($a_category as $str_key=>$a_value) 
        {
            $str_file = str_replace(' ','_',strtolower($a_value['title'])).'.xml';
			$str_file = str_replace('&amp;','and',strtolower($str_file));
			$str_file = str_replace('&','and',strtolower($str_file));
            $b_found = (in_array($str_file,$a_file)) ? 1 : 0;
            if (!$b_found) $a_param['categoryid'][] = $str_key;
        }       
    }
}


//-- generate sitemap
$a_sitemap = generate_sitemap($a_param);
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