<?php
$a_category_article = array();
if (!empty($attributes['categoryid']))
{
    //-- build article/categry and add article tags to tag cloud
    if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$attributes['categoryid'].DIR_SEP.'a_category_article.php';
    else
    { 
        $a_category_article = db_search('article',
                                                array(
                                                    'orderby'=> $_CONFIG['article_ordon'].',a.articleid desc',
                                                    'active'=>1,
                                                    'publish'=>1,
                                                    'domainid'=>ID_DOMAIN,
                                                    'categoryid'=>$attributes['categoryid']
                                               ));
   }
   article_prepare($a_category_article);//-- prepare articles  

   tag_addCloud($a_tag_cloud,$a_category_article,'tag');//-- add tags to tag cloud

   $o_smarty->assign('categoryid',$attributes['categoryid']);
}
tag_addCloud($a_tag_cloud,$a_category,'tag');//-- add tags to tag cloud

//-- assign article/category
$o_smarty->assign('a_category_article',$a_category_article);

$meta_title = $a_page[$page]['menu'];
if (!empty($attributes['categoryid'])) $meta_title.=config_titleSeparator().$a_category[$attributes['categoryid']]['fulltitle'];

$meta_description = $a_page[$page]['description'];
if (!empty($a_page[$page]['a_tag'])) 
{
    $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
    $a_tag_cloud = array_merge($a_page[$page]['a_tag'],$a_tag_cloud);
}
?>