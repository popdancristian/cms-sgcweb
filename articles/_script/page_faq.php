<?php
//-- get and assign the category
$faqid = isset($attributes['faqid']) ? intval($attributes['faqid']) : 0;
if (empty($faqid))
{
	$meta_title = $a_page[$page]['title'];
	$meta_description = $a_page[$page]['description'];
	if (!empty($a_page[$page]['a_tag'])) 
	{
		$meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
		$a_tag_cloud = array_merge($a_page[$page]['a_tag'],$a_tag_cloud);
	}

	//-- assign faq
	$o_smarty->assign('a_faqqs',$a_faq);
}
else
{
	if (empty($a_faq[$faqid])) page_error404(); //-- check the page
	else $a_faqq = $a_faq[$faqid];

	db_faq_inc_total($faqid,ID_DOMAIN);

	//-- fix tags
	if (!empty($a_faqq['tag'])) $a_faqq['a_tag'] = explode(',',$a_faqq['tag']);

	//-- assign faq
	$o_smarty->assign('a_faqq',$a_faqq);

	$meta_title = $a_faqq['title'];

	//-- build html keyword
	if (!empty($a_faqq['tag'])) $meta_keyword = array_merge(explode(',',$a_faqq['tag']),$meta_keyword);

	$meta_description = $a_faqq['title'].config_titleSeparator().strip_tags($a_faqq['description']);

	//-- assign config search
	if (empty($a_faqq['categoryid']) and !empty($_CONFIG['categoryid'])) $a_faqq['categoryid'] = $_CONFIG['categoryid'];

	//-- read gallery if we have category
	if (!empty($a_faqq['categoryid']))
	{
		//-- gallery category
		if (B_CACHE) 
		{
			include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$a_faqq['categoryid'].DIR_SEP.'a_gallery_best.php';
		}
		else  
		{
			$a_result = $o_db->getAll("SELECT g.title,
											  g.image,
											  g.categoryid,
											  c.directory as category_directory
									   from ".DB_PREFIX."gallery g
									   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
									   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
									   WHERE dg.active = 1 AND g.categoryid = ".$a_faqq['categoryid']." AND dg.domainid=".$_DOMAIN['domainid']." ORDER BY dg.total DESC LIMIT ".$_CONFIG['article_news_limit']);

			$a_gallery_best  = array();
			for ($i=0;$i<count($a_result);$i++) 
			{
				if (!isset($a_gallery_best[$a_result[$i]['categoryid']])) $a_gallery_best[$a_result[$i]['categoryid']] = array();
				$a_gallery_best[$a_result[$i]['categoryid']][] = $a_result[$i];
			}
		}

		//-- prepare and assign gallery
		gallery_prepare($a_gallery_best);
		$a_gallery_best = empty($a_gallery_best[$a_faqq['categoryid']]) ? array() : $a_gallery_best[$a_faqq['categoryid']];
	}
	$o_smarty->assign("a_gallery_best",$a_gallery_best);

	$o_smarty->assign("categoryid",$a_faqq['categoryid']);
}
?>