<?php
//-- get and assign the category
$categoryid = isset($attributes['categoryid']) ? intval($attributes['categoryid']) : 0;

if (empty($categoryid) or empty($a_category[$categoryid])) page_error404(); //-- check the page

db_category_inc_total($categoryid,ID_DOMAIN);

//-- assign categoryid
$o_smarty->assign('categoryid',$categoryid);

//-- gallery category
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$attributes['categoryid'].DIR_SEP.'a_gallery_best.php';
else  
{
	$a_result = $o_db->getAll("SELECT g.title,
									  g.image,
									  g.categoryid,
									  c.directory as category_directory
							   from ".DB_PREFIX."gallery g
							   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
							   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
							   WHERE dg.active = 1 AND g.categoryid = ".$categoryid." AND dg.domainid=".$_DOMAIN['domainid']." ORDER BY dg.total DESC LIMIT ".$_CONFIG['article_news_limit']);

	$a_gallery_best  = array();
	for ($i=0;$i<count($a_result);$i++) 
	{
		if (!isset($a_gallery_best[$a_result[$i]['categoryid']])) $a_gallery_best[$a_result[$i]['categoryid']] = array();
		$a_gallery_best[$a_result[$i]['categoryid']][] = $a_result[$i];
	}
}

//-- prepare and assign gallery
gallery_prepare($a_gallery_best);
$o_smarty->assign("a_gallery_best",$a_gallery_best);

if (B_CACHE) 
{
    include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$attributes['categoryid'].DIR_SEP.'a_category_article.php';
    $i_count_article = count($a_category_article);
    
    //-- get navigator start value
    $start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
    if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;
    
    $i_article_from = ($start-1) * $_CONFIG['article_page_limit'];
    $i_article_to   = $i_article_from + $_CONFIG['article_page_limit'];

    $a_article = array();
    for ($i=$i_article_from;$i<$i_article_to;$i++) if (isset($a_category_article[$i])) $a_article[] = $a_category_article[$i];
}
else
{
    //-- get number of articles
    $a_article_param = array('categoryid'=>$categoryid, 'active'=>1,'publish'=>1,'domainid'=>ID_DOMAIN);
    $i_count_article = db_search_count('article',$a_article_param);

    //-- get navigator start value
    $start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
    if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;

    $a_article_param['orderby'] = $_CONFIG['article_ordon'].',datepublished desc';
    $a_article_param['start'] = ($start-1)*$_CONFIG['article_page_limit'];
    $a_article_param['limit'] = $_CONFIG['article_page_limit'];

    //-- get the articles
    $a_article = db_search('article',$a_article_param);
}

article_prepare($a_article);//-- prepare articles

//-- assign articles
$o_smarty->assign('a_article',$a_article);

tag_addCloud($a_tag_cloud,$a_article,'tag');//-- add tags to tag cloud

//-- get and assign navigator
$a_navigator = getNavigator($i_count_article,$_CONFIG['article_page_limit'],$start,array('type'=>'category','param'=> array('categoryid'=>$categoryid,'fulltitle'=>$a_category[$categoryid]['fulltitle'])));
$o_smarty->assign('a_navigator',$a_navigator);
$o_smarty->assign('start',$start);

//-- build html title for this page
$meta_title = $a_category[$categoryid]['fulltitle'];
if ($start>1) $meta_title.=config_titleSeparator()._l('page').' '.$start;

//-- build html keyword
if (!empty($a_category[$categoryid]['a_tag'])) $meta_keyword = array_merge($a_category[$categoryid]['a_tag'],$meta_keyword);

//-- build html description (use title if the description does not exist)
$meta_description = empty($a_category[$categoryid]['description']) ? $a_category[$categoryid]['title'] : $a_category[$categoryid]['description'];

//-- add tag cloud
if (!empty($a_category[$categoryid]['a_tag'])) $a_tag_cloud = array_merge($a_category[$categoryid]['a_tag'],$a_tag_cloud);

$str_popular_link = getRewriteEngineUrl('popular',array('fulltitle'=>$a_category[$categoryid]['fulltitle'],'categoryid'=>$categoryid));
$o_smarty->assign('str_popular_link',$str_popular_link);

$str_latest_link = getRewriteEngineUrl('latest',array('fulltitle'=>$a_category[$categoryid]['fulltitle'],'categoryid'=>$categoryid));
$o_smarty->assign('str_latest_link',$str_latest_link);



?>