<?php
//-- get and assign the category
$categoryid = isset($attributes['categoryid']) ? intval($attributes['categoryid']) : 0;

if (empty($categoryid) or empty($a_category[$categoryid])) page_error404(); //-- check the page

db_category_inc_total($categoryid,ID_DOMAIN);

//-- assign categoryid
$o_smarty->assign('categoryid',$categoryid);

if (B_CACHE) 
{
    include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$attributes['categoryid'].DIR_SEP.'a_category_article_popular.php';
    $i_count_article = count($a_category_article_popular);
        
    //-- get navigator start value
    $start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
    if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;
    
    $i_article_from = ($start-1) * $_CONFIG['article_page_limit'];
    $i_article_to   = $i_article_from + $_CONFIG['article_page_limit'];

    $a_article = array();
    for ($i=$i_article_from;$i<$i_article_to;$i++) if (isset($a_category_article_popular[$i])) $a_article[] = $a_category_article_popular[$i];
}
else
{

    //-- get number of articles
    $a_article_param = array('categoryid'=>$categoryid, 'active'=>1,'publish'=>1,'domainid'=>ID_DOMAIN);
    $i_count_article = db_search_count('article',$a_article_param);

    //-- get navigator start value
    $start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
    if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;

    $a_article_param['orderby'] = 'da.total desc,datepublished desc';
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
$a_navigator = getNavigator($i_count_article,$_CONFIG['article_page_limit'],$start,array('type'=>'popular','param'=> array('categoryid'=>$categoryid,'fulltitle'=>$a_category[$categoryid]['fulltitle'])));
$o_smarty->assign('a_navigator',$a_navigator);
$o_smarty->assign('start',$start);

//-- build html title for this page
$meta_title = _l('popular').' '.$a_category[$categoryid]['fulltitle'];
if ($start>1) $meta_title.=config_titleSeparator()._l('page').' '.$start;

//-- build html keyword
if (!empty($a_category[$categoryid]['a_tag'])) $meta_keyword = array_merge($a_category[$categoryid]['a_tag'],$meta_keyword);

//-- build html description (use title if the description does not exist)
$meta_description = empty($a_category[$categoryid]['description']) ? $a_category[$categoryid]['title'] : $a_category[$categoryid]['description'];
$meta_description = _l('popular').' '.$meta_description;

//-- add tag cloud
if (!empty($a_category[$categoryid]['a_tag'])) $a_tag_cloud = array_merge($a_category[$categoryid]['a_tag'],$a_tag_cloud);
?>