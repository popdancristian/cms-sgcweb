<?php
//-- get and assign the category
$categoryid = isset($attributes['categoryid']) ? intval($attributes['categoryid']) : 0;

if (empty($categoryid) or empty($a_category[$categoryid])) page_error404(); //-- check the page

//-- assign categoryid
$o_smarty->assign('categoryid',$categoryid);

//-- best rated articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$attributes['categoryid'].DIR_SEP.'a_gallery.php';
else  
{
	$a_result = $o_db->getAll("SELECT g.galleryid,
									  g.title,
									  g.image,
									  g.categoryid,
									  c.directory as category_directory
							   from ".DB_PREFIX."gallery g
							   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
							   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
							   WHERE dg.active = 1 AND g.categoryid = $categoryid AND dg.domainid=".$_DOMAIN['domainid']." ORDER BY ordon");

	$a_gallery  = array();
	for ($i=0;$i<count($a_result);$i++) 
	{
		if (!isset($a_gallery[$a_result[$i]['categoryid']])) $a_gallery[$a_result[$i]['categoryid']] = array();
		$a_gallery[$a_result[$i]['categoryid']][] = $a_result[$i];
	}
}

//-- prepare and assign gallery
gallery_prepare($a_gallery);
$o_smarty->assign("a_gallery",$a_gallery);

//-- build html title for this page
$meta_title = $a_category[$categoryid]['fulltitle'].' '.$_CONFIG['title_separator'].' '._l('gallery');

//-- build html keyword
if (!empty($a_category[$categoryid]['a_tag'])) $meta_keyword = array_merge($a_category[$categoryid]['a_tag'],$meta_keyword);

//-- build html description (use title if the description does not exist)
$meta_description = empty($a_category[$categoryid]['description']) ? $a_category[$categoryid]['title'] : $a_category[$categoryid]['description'];

//-- add tag cloud
if (!empty($a_category[$categoryid]['a_tag'])) $a_tag_cloud = array_merge($a_category[$categoryid]['a_tag'],$a_tag_cloud);

$meta_description = _l('gallery').' '.$_CONFIG['title_separator'].' '.$meta_description;
$meta_keyword[] = _l('gallery');
?>