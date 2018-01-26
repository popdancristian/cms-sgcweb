<?php
//-- get and assign the category
$articleid = isset($attributes['articleid']) ? intval($attributes['articleid']) : 0;

//-- get and assign article
$a_article = db_search('article',array(      
                                        'articleid'=>$attributes['articleid'],
                                        'active'=>1,
                                        'publish'=>1,
                                        'domainid'=>ID_DOMAIN
                                      ));

if (empty($a_article)) page_error404(); //-- check the page

article_prepare($a_article);//-- prepare article
$a_article = $a_article[0];
db_article_inc_total($articleid,ID_DOMAIN);//-- increse article count


//-- get next article from the same category
$i_prev_articleid = $o_db->getOne('select da.articleid from '.DB_PREFIX.'domain_article da
                                 inner join '.DB_PREFIX.'article a ON a.articleid = da.articleid
                                 WHERE da.active=1 and da.publish=1 and da.domainid = '.ID_DOMAIN.' and da.ordon<'.$a_article['ordon'].' and a.categoryid = '.$a_article['categoryid'].' ORDER BY ordon desc LIMIT 1');

if (empty($i_prev_articleid))
{
    $i_prev_articleid = $o_db->getOne('select da.articleid from '.DB_PREFIX.'domain_article da
                                 inner join '.DB_PREFIX.'article a ON a.articleid = da.articleid
                                 WHERE da.active=1 and da.publish=1 and da.domainid = '.ID_DOMAIN.' and a.categoryid = '.$a_article['categoryid'].' ORDER BY ordon desc LIMIT 1');
}

//-- get and assign article
$a_article_prev = db_search('article',array(      
                                        'articleid'=>$i_prev_articleid,
                                        'active'=>1,
                                        'publish'=>1,
                                        'domainid'=>ID_DOMAIN
                                      ));
article_prepare($a_article_prev);//-- prepare article
$a_article_prev = $a_article_prev[0];


//-- get next article from the same category
$i_next_articleid = $o_db->getOne('select da.articleid from '.DB_PREFIX.'domain_article da
                                 inner join '.DB_PREFIX.'article a ON a.articleid = da.articleid
                                 WHERE da.active=1 and da.publish=1 and da.domainid = '.ID_DOMAIN.' and da.ordon>'.$a_article['ordon'].' and a.categoryid = '.$a_article['categoryid'].' ORDER BY ordon asc LIMIT 1');

if (empty($i_next_articleid))
{
    $i_next_articleid = $o_db->getOne('select da.articleid from '.DB_PREFIX.'domain_article da
                                 inner join '.DB_PREFIX.'article a ON a.articleid = da.articleid
                                 WHERE da.active=1 and da.publish=1 and da.domainid = '.ID_DOMAIN.' and a.categoryid = '.$a_article['categoryid'].' ORDER BY ordon asc LIMIT 1');
}

//-- get and assign article
$a_article_next = db_search('article',array(      
                                        'articleid'=>$i_next_articleid,
                                        'active'=>1,
                                        'publish'=>1,
                                        'domainid'=>ID_DOMAIN
                                      ));
article_prepare($a_article_next);//-- prepare article
$a_article_next = $a_article_next[0];
$o_smarty->assign("a_article_prev",$a_article_prev);
$o_smarty->assign("a_article_next",$a_article_next);


//-- get and assign last articles
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$a_article['categoryid'].DIR_SEP.'a_article_last.php';
else
{
    $a_article_last = db_search('article',array(
                                                'orderby'=>'total desc,datepublished desc',
                                                'active'=>1,
                                                'publish'=>1,
                                                'categoryid'=>$a_article['categoryid'],
                                                'domainid'=>ID_DOMAIN,
                                                'limit'=>$_CONFIG['article_news_limit']
                                               ));
}

article_prepare($a_article_last);//-- prepare articles
$o_smarty->assign("a_article_last",$a_article_last);
tag_addCloud($a_tag_cloud,$a_article_last,'tag');//-- add tags to tag cloud

//-- prepare images
$a_article_images = array();
if (!empty($a_article['directory']) and !empty($a_article['number']))
{
	for($i=1;$i<=$a_article['number'];$i++)
	{
		if (count($_CONFIG['a_url'])==1) $i_rand = 0;
		else $i_rand = rand(0, count($_CONFIG['a_url'])-1);
		$str_url = $_CONFIG['a_url'][$i_rand]['name'];

		$a_article_images[] = array
		(
	    	'imageurl'=>$str_url.'/image/'.$a_category[$a_article['categoryid']]['directory'].'/'.$a_article['directory'].'/'.$a_category[$a_article['categoryid']]['directory'].'-'.$a_article['directory'].'-'.$i.'.jpg',
		    'imageurlb'=>$str_url.'/image/'.$a_category[$a_article['categoryid']]['directory'].'/'.$a_article['directory'].'/'.$a_category[$a_article['categoryid']]['directory'].'-'.$a_article['directory'].'-'.$i.'b.jpg',
		);
	}
}
$o_smarty->assign("a_article_images",$a_article_images);

//-- gallery category
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$a_article['categoryid'].DIR_SEP.'a_gallery_best.php';
else  
{
	$a_result = $o_db->getAll("SELECT g.title,
									  g.image,
									  g.categoryid,
									  c.directory as category_directory
							   from ".DB_PREFIX."gallery g
							   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
							   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
							   WHERE dg.active = 1 AND g.categoryid = ".$a_article['categoryid']." AND dg.domainid=".$_DOMAIN['domainid']." ORDER BY dg.total DESC LIMIT ".$_CONFIG['article_news_limit']);

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

//-- fix tags
if (!empty($a_article['tag'])) $a_article['a_tag'] = explode(',',$a_article['tag']);

//-- add tag cloud
if (!empty($a_article['a_tag'])) $a_tag_cloud = array_merge($a_article['a_tag'],$a_tag_cloud);
if (!empty($a_article_prev['a_tag'])) $a_tag_cloud = array_merge($a_article_prev['a_tag'],$a_tag_cloud);
if (!empty($a_article_next['a_tag'])) $a_tag_cloud = array_merge($a_article_next['a_tag'],$a_tag_cloud);

//-- assign article
$o_smarty->assign('a_article',$a_article);

$meta_title = $a_category[$a_article['categoryid']]['fulltitle'].config_titleSeparator().$a_article['fulltitle'];

//-- build html keyword
if (!empty($a_article['tag'])) $meta_keyword = array_merge(explode(',',$a_article['tag']),$meta_keyword);

$meta_description = $a_article['title'].config_titleSeparator().strip_tags($a_article['description']).config_titleSeparator().$a_category[$a_article['categoryid']]['fulltitle'];

//-- get active games comments
$a_comment = db_get('article_comment',array('orderby'=>'article_commentid desc'),array('articleid'=>$articleid,'domainid'=>ID_DOMAIN,'active'=>1));
$o_smarty->assign('a_comment',$a_comment);

//-- include raty plugin
$o_smarty->assign('b_include_raty',true);
?>