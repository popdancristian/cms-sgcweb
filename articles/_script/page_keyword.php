<?php
if (B_CACHE) 
{
    include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_article_news.php';
    $a_article_last = $a_article_news;
}
else  
{
    //-- get and assign last articles
    $a_article_last = db_search('article',array(
                                                'orderby'=>'datepublished desc,a.articleid desc',
                                                'active'=>1,
                                                'publish'=>1,
                                                'domainid'=>ID_DOMAIN,
                                                'limit'=>$_CONFIG['article_news_limit']
                                               ));
}

article_prepare($a_article_last);//-- prepare articles
$o_smarty->assign("a_article_last",$a_article_last);

tag_addCloud($a_tag_cloud,$a_article_last,'tag');//-- add tags to tag cloud

if (isset($attributes['letter']))
{
    //-- get and assign keywords
    $a_keyword = db_search('keyword',array('orderby'=>'total desc','active'=>1,'letter'=>$attributes['letter'],'domainid'=>ID_DOMAIN));
    $o_smarty->assign('letter',$attributes['letter']);
}
else
{
    $a_keyword = db_search('keyword',array('orderby'=>'total desc','active'=>1,'limit'=>$_CONFIG['keyword_limit']*5,'domainid'=>ID_DOMAIN));
}

$a_keyword = buildRewriteEngineUrl($a_keyword,'keyword',array('keywordid','name'),'url');//-- fix rewrite engine url
$a_keyword = keword_removeSiteKeyword($a_keyword,'name','name_keyword');
$o_smarty->assign("a_keyword",$a_keyword);

$meta_title = _l('browsebykeyword');
$meta_description = $a_page[$page]['description'];
if (isset($attributes['letter'])) 
{
  $meta_title.=config_titleSeparator().strtoupper($attributes['letter']);
}

if (!empty($a_page[$page]['a_tag'])) $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);

//-- get and assign the letters
$a_letter = page_getLetter('keyword_letter');
$o_smarty->assign("a_letter",$a_letter);

?>