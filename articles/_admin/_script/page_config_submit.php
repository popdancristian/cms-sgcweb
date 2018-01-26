<?php
switch ($attributes['action'])
{
  case 'mod':      
   $str_tag = tag_fixString($attributes['keyword']);//-- fix tags   

   $a_data = 
    array(
       'title'=>$attributes['title'],
       'motto'=>$attributes['motto'],                    
       'description'=>$attributes['description'],
       'keyword'=>$str_tag,
       'site_keyword'=>$attributes['site_keyword'],
       'email'=>$attributes['email'],
	   'phone'=>$attributes['phone'],
       'rewrite_engine'=>$attributes['rewrite_engine'],
       'rewrite_engine_method'=>intVal($attributes['rewrite_engine_method']),
       'rewrite_engine_string'=>$attributes['rewrite_engine_string'],
       'google_verify'=>$attributes['google_verify'],
       'google_profile_id'=>$attributes['google_profile_id'],
       'yahoo_verify'=>$attributes['yahoo_verify'],
       'google_email'=>$attributes['google_email'],
       'title_separator'=>$attributes['title_separator'],
       'title_prefix'=>$attributes['title_prefix'],
       'sitemap_dir'=>$attributes['sitemap_dir'],
       'title_sufix'=>$attributes['title_sufix'],
       'site_template'=>$attributes['site_template'],
       'site_style'=>$attributes['site_style'],
	   'categoryid'=>intval($attributes['categoryid']),
       'category_ordon'=>$attributes['category_ordon'],
       'category_sufix'=>$attributes['category_sufix'],
       'category_prefix'=>$attributes['category_prefix'],
       'category_auto_publish'=>$attributes['category_auto_publish'],
       'category_publish_date'=>$attributes['category_publish_date'],
       'category_publish_interval'=>intVal($attributes['category_publish_interval']),
       'category_publish_count'=>intVal($attributes['category_publish_count']),
       'article_sufix'=>$attributes['article_sufix'],
       'article_prefix'=>$attributes['article_prefix'], 
       'article_home_limit'=>$attributes['article_home_limit'],        
       'article_auto_publish'=>$attributes['article_auto_publish'],
       'article_publish_interval'=>intVal($attributes['article_publish_interval']),
       'article_ordon'=>$attributes['article_ordon'],
       'article_page_limit'=>intVal($attributes['article_page_limit']), 
       'article_best_limit'=>intVal($attributes['article_best_limit']), 
       'article_last_limit'=>intVal($attributes['article_last_limit']), 
       'article_most_rated_limit'=>intVal($attributes['article_most_rated_limit']), 
       'article_best_rated_limit'=>intVal($attributes['article_best_rated_limit']), 
       'article_publish_date'=>$attributes['article_publish_date'],
       'keyword_limit'=>intVal($attributes['keyword_limit']),
       'tag_limit'=>intVal($attributes['tag_limit']),
       'tag_total'=>intVal($attributes['tag_total']),
       'article_news_limit'=>intVal($attributes['article_news_limit']),
       'adsense_ignore'=>$attributes['adsense_ignore'],
       'adsense_ignore_ip'=>$attributes['adsense_ignore_ip']
      );
    
  if (!empty($attributes['google_password'])) $a_data['google_password'] = $attributes['google_password'];

  modConfig($a_data,$_SESSION['domainid']);

  break;  
}
$_SESSION['success'] = true;//-- success
header('Location: index.php?page='.$page);
?>