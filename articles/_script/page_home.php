<?php
//-- last articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_article_last.php';
else  
{
    //-- get and assign last articles
    $a_article_last = db_search('article',array(
                                                'orderby'=>'datepublished desc,ordon desc',
                                                'active'=>1,
                                                'publish'=>1,
                                                'domainid'=>ID_DOMAIN,
                                                'limit'=>$_CONFIG['article_last_limit']
                                               ));
}

article_prepare($a_article_last);//-- prepare articles
$o_smarty->assign("a_article_last",$a_article_last);

tag_addCloud($a_tag_cloud,$a_article_last,'tag');//-- add tags to tag cloud

//-- best articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_article_best.php';
else  
{
    //-- get and assign best articles
    $a_article_best = db_search('article',array(
                                                'orderby'=>'total desc,ordon desc',
                                                'active'=>1,
                                                'publish'=>1,
                                                'domainid'=>ID_DOMAIN,
                                                'limit'=>$_CONFIG['article_best_limit']
                                               ));
}

article_prepare($a_article_best);//-- prepare articles
$o_smarty->assign("a_article_best",$a_article_best);

tag_addCloud($a_tag_cloud,$a_article_best,'tag');//-- add tags to tag cloud

//-- best rated articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_article_best_rated.php';
else  
{
    //-- get and assign best articles
    $a_article_best_rated = db_search('article',array(
                                                'orderby'=>'raty desc,ordon desc',
                                                'active'=>1,
                                                'publish'=>1,
                                                'domainid'=>ID_DOMAIN,
                                                'limit'=>$_CONFIG['article_best_rated_limit']
                                               ));
}

article_prepare($a_article_best_rated);//-- prepare articles
$o_smarty->assign("a_article_best_rated",$a_article_best_rated);

tag_addCloud($a_tag_cloud,$a_article_best_rated,'tag');//-- add tags to tag cloud


//-- best rated articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_article_most_rated.php';
else  
{
    //-- get and assign best articles
    $a_article_most_rated = db_search('article',array(
                                                'orderby'=>'totalraty desc,ordon asc',
                                                'active'=>1,
                                                'publish'=>1,
                                                'domainid'=>ID_DOMAIN,
                                                'limit'=>$_CONFIG['article_most_rated_limit']
                                               ));
}

article_prepare($a_article_most_rated);//-- prepare articles
$o_smarty->assign("a_article_most_rated",$a_article_most_rated);

tag_addCloud($a_tag_cloud,$a_article_most_rated,'tag');//-- add tags to tag cloud

//-- ordon categories
if (!empty($a_category))
{
    //-- ordon categories
    $a_category_ordon = array();
    foreach ($a_category as $i_key=>$a_value) 
    {
         $a_category_ordon['total'][] = $i_key; 
         $a_category_ordon['ordon'][] = $i_key;
    }

    $kod = true;
    while ($kod)
    {
        $kod = false;
        for ($i=0;$i<count($a_category_ordon['total'])-1;$i++)
        {
            if ($a_category[$a_category_ordon['total'][$i]]['total']<$a_category[$a_category_ordon['total'][$i+1]]['total'])
            {
                $temp = $a_category_ordon['total'][$i];
                $a_category_ordon['total'][$i] = $a_category_ordon['total'][$i+1];
                $a_category_ordon['total'][$i+1] = $temp;
                $kod = true;
            }
            if ($a_category[$a_category_ordon['ordon'][$i]]['ordon']<$a_category[$a_category_ordon['ordon'][$i+1]]['ordon'])
            {
                $temp = $a_category_ordon['ordon'][$i];
                $a_category_ordon['ordon'][$i] = $a_category_ordon['ordon'][$i+1];
                $a_category_ordon['ordon'][$i+1] = $temp;
                $kod = true;
            }
        }
    }
    $o_smarty->assign("a_category_ordon",$a_category_ordon);
}

//-- best rated articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_gallery_home.php';
else  
{
	$a_result = $o_db->getAll("SELECT g.title,
									  g.image,
									  g.categoryid,
									  c.directory as category_directory
							   from ".DB_PREFIX."gallery g
							   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
							   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
							   WHERE dg.active = 1 AND dg.home = 1 AND dg.domainid=".$_DOMAIN['domainid']." ORDER BY ordon");

	$a_gallery_home  = array();
	for ($i=0;$i<count($a_result);$i++) 
	{
		if (!isset($a_gallery_home[$a_result[$i]['categoryid']])) $a_gallery_home[$a_result[$i]['categoryid']] = array();
		$a_gallery_home[$a_result[$i]['categoryid']][] = $a_result[$i];
	}
}

//-- prepare and assign gallery
gallery_prepare($a_gallery_home);
$o_smarty->assign("a_gallery_home",$a_gallery_home);

$meta_title = $a_page[$page]['menu'];
$meta_description = $a_page[$page]['description'];
if (!empty($a_page[$page]['a_tag']))
{
    $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
    $a_tag_cloud = array_merge($a_page[$page]['a_tag'],$a_tag_cloud);
}
?>