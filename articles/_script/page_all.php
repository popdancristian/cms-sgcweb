<?php
$a_letter_index['_'] = array('name'=>'_');
for ($i=65;$i<91;$i++) $a_letter_index[strtolower(chr($i))]['name'] = chr($i);
foreach ($a_letter_index as $str_key=>$str_value) 
{
    $a_letter_index[$str_key]['url'] = getRewriteEngineUrl('index',array('letter'=>$str_value['name'],'name'=>$page));
}

if (isset($attributes['letter']) and isset($a_letter_index[strtolower($attributes['letter'])])) $str_letter = strtolower($attributes['letter']);
else $str_letter = '_';


//-- get number of articles
$a_article_param = array('letter'=>$str_letter, 'active'=>1,'publish'=>1,'domainid'=>ID_DOMAIN);
$i_count_article = db_search_count('article',$a_article_param);

//-- get navigator start value
$start = isset($attributes['start']) ? abs(intval($attributes['start'])) : 1;
if (($start<0) or ($start>ceil($i_count_article/$_CONFIG['article_page_limit']))) $start = 1;

$a_article_param['orderby'] = 'a.title';
$a_article_param['start'] = ($start-1)*$_CONFIG['article_page_limit'];
$a_article_param['limit'] = $_CONFIG['article_page_limit'];

//-- get the articles
$a_article = db_search('article',$a_article_param);
article_prepare($a_article);//-- prepare articles

tag_addCloud($a_tag_cloud,$a_article,'tag');//-- add tags to tag cloud

//-- get and assign navigator
$a_navigator = getNavigator($i_count_article,$_CONFIG['article_page_limit'],$start,array('type'=>'index','param'=> array('letter'=>$str_letter,'name'=>$page)));
$o_smarty->assign('a_navigator',$a_navigator);
$o_smarty->assign('start',$start);

//-- assign articles
$o_smarty->assign('a_article',$a_article);
$o_smarty->assign("a_letter_index",$a_letter_index);
$o_smarty->assign("str_letter",$str_letter);

//-- build html title for this page
$meta_title = $a_page[$page]['menu'];
if ($str_letter!='_') $meta_title.=config_titleSeparator().strtoupper($str_letter);
if ($start>1) $meta_title.=config_titleSeparator()._l('page').' '.$start;

$meta_description = $meta_title.config_titleSeparator().$a_page[$page]['description'];
if (!empty($a_page[$page]['a_tag'])) $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
?>