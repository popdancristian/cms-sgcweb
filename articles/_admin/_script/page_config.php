<?php

//-- build some form vars
$a_category = db_get('category',array('orderby'=>'title'));
$a_category_option = array('0'=>$_l['uncategorized']);
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];

//-- define and assign form data
$a_form = array
(
 'name'=>'frmManage',
 'action'=>'mod',
 'title'=>$_l['manage'],
 'data'=>$_CONFIG,
 'row'=>array
 (  
  's_general'=>array('caption'=>_l('general'),'type'=>'section'),

  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','required'=>true),
  'motto'=>array('caption'=>$_l['motto'],'type'=>'textbox','required'=>true),
  
  'description'=>array('caption'=>$_l['description'],'type'=>'textarea','required'=>true),
  'keyword'=>array('caption'=>$_l['tag'],'type'=>'textarea','tips'=>_l('separatecommas')),
  'site_keyword'=>array('caption'=>$_l['site_keyword'],'type'=>'textbox','tips'=>_l('used to control search engine keywords density')),
  'email'=>array('caption'=>$_l['email'],'type'=>'textbox','required'=>true),
  'phone'=>array('caption'=>_l('phone'),'type'=>'textbox','required'=>true),

  's_rewrite_engine'=>array('caption'=>_l('rewrite_engine'),'type'=>'section'),

  'rewrite_engine'=>array('caption'=>$_l['rewrite_engine'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no'])),
  'rewrite_engine_method'=>array('caption'=>$_l['rewrite_engine_method'],'type'=>'radio','a_value'=>array('1'=>'with .html','2'=>'without .html')),
  'rewrite_engine_string'=>array('caption'=>_l('rewrite_engine_string'),'type'=>'textbox','required'=>true),

  's_additionnal'=>array('caption'=>_l('additionnal'),'type'=>'section'),

  'title_prefix'=>array('caption'=>$_l['title_prefix'],'type'=>'textbox'),
  'title_sufix'=>array('caption'=>$_l['title_sufix'],'type'=>'textbox'),
  'title_separator'=>array('caption'=>$_l['title_separator'],'type'=>'textbox'),
  'site_template'=>array('caption'=>$_l['site_template'],'type'=>'textbox','required'=>true),  
  'site_style'=>array('caption'=>$_l['site_style'],'type'=>'textbox','required'=>true), 
  'sitemap_dir'=>array('caption'=>$_l['sitemap_dir'],'type'=>'textbox','tips'=>_l('the sitemaps will be generated to this folder')),
  
  's_searchengine'=>array('caption'=>_l('searchengine'),'type'=>'section'),
 
  'google_verify'=>array('caption'=>$_l['google_verify'],'type'=>'textbox'),  
  'google_profile_id'=>array('caption'=>$_l['google_profile_id'],'type'=>'textbox'), 
  'google_email'=>array('caption'=>$_l['google_email'],'type'=>'textbox'),
  'google_password'=>array('caption'=>$_l['google_password'],'type'=>'password'),
  'yahoo_verify'=>array('caption'=>$_l['yahoo_verify'],'type'=>'textbox'),

 
  's_category'=>array('caption'=>_l('category'),'type'=>'section'),
  'categoryid'=>array('caption'=>$_l['category'],'type'=>'select','a_value'=>$a_category_option),
  'category_ordon'=>array('caption'=>_l('order_by'),'type'=>'select','a_value'=>$_CATEGORY_ORDON),
  'category_prefix'=>array('caption'=>$_l['category_prefix'],'type'=>'textbox'),
  'category_sufix'=>array('caption'=>$_l['category_sufix'],'type'=>'textbox'),
  'category_auto_publish'=>array('caption'=>$_l['auto_publish'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no'])),
  'category_publish_interval'=>array('caption'=>$_l['article_publish_interval'],'type'=>'textbox','required'=>true,'tips'=>_l('just 1 category will be published')),
  'category_publish_date'=>array('caption'=>$_l['article_publish_date'],'type'=>'textbox'),
  'category_publish_count'=>array('caption'=>$_l['count'],'type'=>'textbox','required'=>true,'tips'=>_l('number of articles from the category')),


  's_article'=>array('caption'=>_l('article'),'type'=>'section'),
   
  'article_ordon'=>array('caption'=>_l('order_by'),'type'=>'select','a_value'=>$_ARTICLE_ORDON),
  'article_prefix'=>array('caption'=>$_l['article_prefix'],'type'=>'textbox'),
  'article_sufix'=>array('caption'=>$_l['article_sufix'],'type'=>'textbox'),

  'article_auto_publish'=>array('caption'=>$_l['auto_publish'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no'])),
  'article_publish_interval'=>array('caption'=>$_l['article_publish_interval'],'type'=>'textbox','required'=>true),
  'article_publish_date'=>array('caption'=>$_l['article_publish_date'],'type'=>'textbox'),

  'article_home_limit'=>array('caption'=>$_l['article_home_limit'],'type'=>'textbox','required'=>true,'tips'=>_l('for New and Best articles sections')),  
  'article_news_limit'=>array('caption'=>$_l['article_news_limit'],'type'=>'textbox','required'=>true,'tips'=>_l('for the pages with New or Best articles')),
  'article_page_limit'=>array('caption'=>$_l['article_page_limit'],'type'=>'textbox','required'=>true),
  'article_best_limit'=>array('caption'=>$_l['article_best_limit'],'type'=>'textbox','required'=>true),
  'article_last_limit'=>array('caption'=>$_l['article_last_limit'],'type'=>'textbox','required'=>true),
  'article_most_rated_limit'=>array('caption'=>$_l['article_most_rated_limit'],'type'=>'textbox','required'=>true),
  'article_best_rated_limit'=>array('caption'=>$_l['article_best_rated_limit'],'type'=>'textbox','required'=>true),
 
  's_keyword'=>array('caption'=>_l('keyword'),'type'=>'section'),
  'keyword_limit'=>array('caption'=>$_l['count'],'type'=>'textbox','required'=>true,'tips'=>_l('number of keyword for the `Keywords` boxes')),

  's_tag'=>array('caption'=>_l('tag'),'type'=>'section'),
  'tag_limit'=>array('caption'=>$_l['count'],'type'=>'textbox','required'=>true,'tips'=>_l('number of tags for the `Tags` boxes')),
  'tag_total'=>array('caption'=>$_l['tag_total'],'type'=>'textbox','required'=>true,'tips'=>_l('display tags with number of articles bigger then')),

  's_adsense'=>array('caption'=>_l('adsense'),'type'=>'section'),
  'adsense_ignore'=>array('caption'=>$_l['adsense_ignore'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no'])),
  'adsense_ignore_ip'=>array('caption'=>$_l['adsense_ignore_ip'],'type'=>'textarea','tips'=>_l('separatecommas'))
 ),
 'button'=>$_l['update']
);

$o_smarty->assign("a_form",$a_form);
?>