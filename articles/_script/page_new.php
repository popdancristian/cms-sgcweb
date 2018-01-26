<?php
//-- get number of articles
$a_article_param = array('active'=>1,'publish'=>1,'domainid'=>ID_DOMAIN);
$i_count_article = db_search_count('article',$a_article_param);

//-- get navigator start value
$start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;

$a_article_param['orderby'] = 'da.datepublished desc, ordon desc';
$a_article_param['start'] = ($start-1)*$_CONFIG['article_page_limit'];
$a_article_param['limit'] = $_CONFIG['article_page_limit'];

//-- get the articles
$a_article = db_search('article',$a_article_param);
article_prepare($a_article);//-- prepare articles
//-- assign articles
$o_smarty->assign('a_article',$a_article);

tag_addCloud($a_tag_cloud,$a_article,'tag');//-- add tags to tag cloud

//-- get and assign navigator
$a_navigator = getNavigator($i_count_article,$_CONFIG['article_page_limit'],$start,array('type'=>'page','param'=> array('name'=>$page)));
$o_smarty->assign('a_navigator',$a_navigator);
$o_smarty->assign('start',$start);

//-- get meta info
if (!empty($a_page[$page]))
{
    $meta_title = $a_page[$page]['menu'];
    $meta_description = $a_page[$page]['description'];
    if (!empty($a_page[$page]['a_tag'])) 
    {
        $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
        $a_tag_cloud = array_merge($a_page[$page]['a_tag'],$a_tag_cloud);
    }
}
if ($start>1) $meta_title.=config_titleSeparator()._l('page').' '.$start;

?>