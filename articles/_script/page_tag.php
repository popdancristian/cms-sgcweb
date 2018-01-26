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

$a_tag = db_search('tag',array('orderby'=>'total desc','domainid'=>ID_DOMAIN,'total'=>$_CONFIG['tag_total']));
$a_tag = buildRewriteEngineUrl($a_tag,'tag',array('tagid','name'),'url');//-- fix rewrite engine url
$o_smarty->assign("a_tag",$a_tag);

$meta_title = _l('browsebytag');
$meta_description = $a_page[$page]['description'];
if (!empty($a_page[$page]['a_tag'])) $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
?>