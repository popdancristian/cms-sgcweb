<?php
header("Cache-Control: no-cache, must-revalidate");

function makeTitle($str_title, $i_length=21)
{
    if (strlen($str_title) <= $i_length) { return $str_title; }

    //-- get parts of the title
    $a_title  = explode(' ', $str_title);
    $a_title[round(sizeof($a_title)/2)] = '<br>'.$a_title[round(sizeof($a_title)/2)];

    //-- return lines
    return implode(' ', $a_title);
}

//-- get dominid and create const
$i_domainid = isset($_GET['domainid']) ? intval($_GET['domainid']) : 0;
DEFINE('ID_DOMAIN', $i_domainid);

//-- include config
include_once '../_conf/config.php';

//-- include db lib
include_once PATH_LIB.DIR_SEP.'db.lib.php';

//-- read the domain
$_DOMAIN = db_get('domain',array('domainid'=>ID_DOMAIN));

if ($_DOMAIN['cache']==1) DEFINE('B_CACHE',   true);//-- use cache
else DEFINE('B_CACHE',   false);//-- don't use cache

//-- include user language
include_once PATH_LANG.DIR_SEP.DEFAULT_LANGUAGE.'.php';

//-- include libraries
include_once PATH_LIB.DIR_SEP.'function.lib.php';
include_once PATH_LIB.DIR_SEP.'rewritengine.lib.php';

//-- get configuration from database
$_CONFIG = getConfig(ID_DOMAIN); 

if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.$i_domainid.DIR_SEP.'a_category.php';
else
{
	$a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
                                   INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                   WHERE dc.active = 1 AND dc.domainid=".ID_DOMAIN." ORDER BY ".$_CONFIG['category_ordon'],'categoryid');
}
category_prepare($a_category);

if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.$i_domainid.DIR_SEP.'a_gallery.php';
else
{
	$a_gallery = $o_db->getAll("select g.*,
									   c.title as category,
									   c.directory
								from ".DB_PREFIX."gallery g
								inner join ".DB_PREFIX."category c ON c.categoryid = g.categoryid
								inner join ".DB_PREFIX."domain_category dc ON dc.categoryid = c.categoryid
								inner join ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
								where dg.home = 1 AND dg.domainid = ".ID_DOMAIN." 
								AND dc.home = 1 AND dc.domainid = ".ID_DOMAIN);
}

//-- start slide
echo '<slideshow>';
foreach ($a_gallery as $a_data)
{
   $url_image  = URL_SITE.'/_file/image/'.$a_data['directory'].'/'.$a_data['image'].'.jpg';
   $path_image = PATH_SITE.'/_file/image/'.$a_data['directory'].'/'.$a_data['image'].'.jpg';
   $str_title  = $a_data['category'];
   if (!empty($a_data['title'])) $str_title = $a_data['title'].' '.$str_title;
   if (file_exists($path_image))
   {
	   //-- print photo
	   echo '<photo image="'.$url_image.'" target="_self" url="'.$a_category[$a_data['categoryid']]['url_gallery'].'"><![CDATA['.makeTitle($str_title).']]></photo>';
   }
}
//-- end slide
echo '</slideshow>';
?>