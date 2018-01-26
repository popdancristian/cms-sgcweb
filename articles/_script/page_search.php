<?php
//-- get start value
$start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
//-- get the keywordid
$keywordid = isset($attributes['keywordid']) ? intval($attributes['keywordid']) : 0;
if ($keywordid!=0)
{
    //-- SEARCH BY KEYWORD
    $str_serach_title = _l('browsebykeyword');

    //-- get and assign the search keyword
    $a_search = db_get('keyword',array('keywordid'=>$keywordid));
   
    if (empty($a_search)) page_error404(); //-- check the page

    //-- get number of articles
    $a_article_param = array('keyword'=>array($a_search['alias']), 'active'=>1,'publish'=>1,'domainid'=>ID_DOMAIN);
    $i_count_article = db_search_count('article',$a_article_param);

    //-- get navigator start value
    if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;
    
    if ($a_search['completed'] == 1) $a_article_param['orderby'] = ' da.total desc, a.articleid desc';
    else $a_article_param['orderby'] = $_CONFIG['article_ordon'].',a.articleid desc';
    
    $a_article_param['start'] = ($start-1)*$_CONFIG['article_page_limit'];
    $a_article_param['limit'] = $_CONFIG['article_page_limit'];

    //-- search articles
    $a_article = db_search('article',$a_article_param);

    article_prepare($a_article);//-- prepare articles
    tag_addCloud($a_tag_cloud,$a_article,'tag');//-- add tags to tag cloud
   
    //-- get and assign navigator
    $a_navigator = getNavigator($i_count_article,$_CONFIG['article_page_limit'],$start,array('type'=>'keyword','param'=> array('keywordid'=>$keywordid,'name'=>$a_search['name'])));
    
    //-- increase keyword search
    $o_db->query('update '.DB_PREFIX.'keyword set total=total+1 where keywordid ='.$keywordid);
}
elseif (isset($attributes['tag']))
{
    //-- SEARCH BY TAG
    $str_serach_title = _l('browsebytag');

    //-- get the tagid
    $tagid = isset($attributes['tagid']) ? intval($attributes['tagid']) : 0;
    $a_search = db_get('tag',array('tagid'=>$tagid));

    if (empty($a_search)) page_error404(); //-- check the page
    
    //-- get number of articles
    $a_article_param = array('tag'=>$a_search['name'], 'active'=>1,'publish'=>1,'domainid'=>ID_DOMAIN);
    $i_count_article = db_search_count('article',$a_article_param);

    //-- get navigator start value
    if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;
    
    $a_article_param['orderby'] = $_CONFIG['article_ordon'].',a.articleid desc';
    $a_article_param['start'] = ($start-1)*$_CONFIG['article_page_limit'];
    $a_article_param['limit'] = $_CONFIG['article_page_limit'];

    //-- search articles
    $a_article = db_search('article',$a_article_param);

    article_prepare($a_article);//-- prepare articles
    tag_addCloud($a_tag_cloud,$a_article,'tag');//-- add tags to tag cloud

    //-- get and assign navigator
    $a_navigator = getNavigator($i_count_article,$_CONFIG['article_page_limit'],$start,array('type'=>'tag','param'=> array('tagid'=>$tagid,'name'=>$a_search['name'])));
}

if (empty($a_search)) page_error404(); //-- check the page

$a_gallery_best = array();

//-- assign config search
if (empty($a_search['categoryid']) and !empty($_CONFIG['categoryid'])) $a_search['categoryid'] = $_CONFIG['categoryid'];

//-- read gallery if we have category
if (!empty($a_search['categoryid']))
{
	//-- gallery category
	if (B_CACHE) 
	{
		include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$a_search['categoryid'].DIR_SEP.'a_gallery_best.php';
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
								   WHERE dg.active = 1 AND g.categoryid = ".$a_search['categoryid']." AND dg.domainid=".$_DOMAIN['domainid']." ORDER BY dg.total DESC LIMIT ".$_CONFIG['article_news_limit']);

		$a_gallery_best  = array();
		for ($i=0;$i<count($a_result);$i++) 
		{
			if (!isset($a_gallery_best[$a_result[$i]['categoryid']])) $a_gallery_best[$a_result[$i]['categoryid']] = array();
			$a_gallery_best[$a_result[$i]['categoryid']][] = $a_result[$i];
		}
	}

	//-- prepare and assign gallery
	gallery_prepare($a_gallery_best);
	$a_gallery_best = empty($a_gallery_best[$a_search['categoryid']]) ? array() : $a_gallery_best[$a_search['categoryid']];
	
	$o_smarty->assign("categoryid",$a_search['categoryid']);
}
$o_smarty->assign("a_gallery_best",$a_gallery_best);

$o_smarty->assign('a_navigator',$a_navigator);
$o_smarty->assign('start',$start);

//-- get the search keyword
$search_keyword = $a_search['name'];

//-- assign the search keyword
$o_smarty->assign('search_keyword',$search_keyword);

//-- assign articles
$o_smarty->assign('a_article',$a_article);

$str_serach_title.=' '.$search_keyword;

//-- build html title for this page
$meta_title = $str_serach_title;
$meta_keyword = array_merge(array($search_keyword),$meta_keyword);
$meta_description = $search_keyword.config_titleSeparator().str_replace('[category_title]',$search_keyword,$a_page[$page]['description']).config_titleSeparator().$str_serach_title;

//-- add article tags to tag cloud
$a_tag_cloud = array_merge(array($search_keyword),$a_tag_cloud);
foreach ($a_article as $i_key=>$a_value) if (!empty($a_value['a_tag'])) $a_tag_cloud = array_merge($a_value['a_tag'],$a_tag_cloud);

if ($start>1) $meta_title.=config_titleSeparator()._l('page').' '.$start;

?>