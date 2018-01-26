<?php
$a_category = $o_db->getAssoc("SELECT title,google,c.categoryid from ".DB_PREFIX."category c
                               INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                               WHERE dc.active = 1 and dc.domainid=".$_SESSION['domainid']." ORDER BY title",'categoryid');

$str_sitemap_path = $a_domain[$_SESSION['domainid']]['path'];
if (!empty($_CONFIG['sitemap_dir'])) $str_sitemap_path.=DIR_SEP.$_CONFIG['sitemap_dir'];

$str_sitemap_url = $a_domain[$_SESSION['domainid']]['url'];
if (!empty($_CONFIG['sitemap_dir'])) $str_sitemap_url.='/'.$_CONFIG['sitemap_dir'];

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
$a_sitemap = array();
for ($i=0;$i<count($a_default_sitemap);$i++)
{
    $b_found = (in_array($a_default_sitemap[$i],$a_file)) ? 1 : 0;
    $a_sitemap[] = array('categoryid'=>0,'file'=>$a_default_sitemap[$i],'url'=>$str_sitemap_url.'/'.$a_default_sitemap[$i],'b_found'=>$b_found,'b_google'=>$a_domain[$_SESSION['domainid']]['google']);
}
$a_sitemap[] = array();
foreach ($a_category as $str_key=>$a_value) 
{
    $str_file = str_replace(' ','_',strtolower($a_value['title'])).'.xml';
	$str_file = str_replace('&amp;','and',strtolower($str_file));
	$str_file = str_replace('&','and',strtolower($str_file));

    $b_found = (in_array($str_file,$a_file)) ? 1 : 0;
    $a_sitemap[] = array('categoryid'=>$str_key,'file'=>$str_file,'url'=>$str_sitemap_url.'/'.$str_file,'b_found'=>$b_found,'b_google'=>$a_value['google']);
}
$o_smarty->assign("a_sitemap",$a_sitemap); 
?>