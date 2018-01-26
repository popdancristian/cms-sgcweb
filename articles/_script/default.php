<?php
//-- auto publish article
db_article_auto_publish(ID_DOMAIN);

//-- init smarty
include_once PATH_CLASS.DIR_SEP.'smarty'.DIR_SEP.'Smarty.class.php';

$o_smarty = new Smarty;
$o_smarty->compile_dir    = PATH_SMARTY_COMPILE.DIR_SEP.$_DOMAIN['name'];
$o_smarty->template_dir   = PATH_SMARTY_TEMPLATE.DIR_SEP.$_CONFIG['site_template'];

//-- assign config info
$o_smarty->assign("_CONFIG",$_CONFIG);
$o_smarty->assign("_DOMAIN",$_DOMAIN);

//-- assign lang info
$o_smarty->assign("_l",$_l);

//-- read and assign pages
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_page.php';
else
$a_page = $o_db->getAssoc("SELECT * from ".DB_PREFIX."page p
                           INNER JOIN ".DB_PREFIX."domain_page dp ON p.pageid = dp.pageid
                           WHERE active = 1 AND dp.domainid=".$_DOMAIN['domainid']." ORDER BY ordon",'name');

//-- page template
$a_page_template = array();
foreach ($a_page as $str_key=>$a_value) $a_page_template[$a_value['template']] = $str_key;

page_prepare($a_page);


if ((!in_array($page,$_SYSTEM_PAGE)) and (empty($page) or (empty($a_page[$page])))) $page = page_getHomeName($a_page);
$o_smarty->assign("a_page",$a_page);
$o_smarty->assign('page',$page);

if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_category.php';
else
{
    $a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
                                   INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                   WHERE dc.active = 1 AND dc.domainid=".$_DOMAIN['domainid']." ORDER BY ".$_CONFIG['category_ordon'],'categoryid');
    
    $a_category_articles = $o_db->getAssoc("SELECT c.categoryid,count(a.articleid) as total from ".DB_PREFIX."category c
                                          INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                          INNER JOIN ".DB_PREFIX."article a ON a.categoryid = c.categoryid
                                          INNER JOIN ".DB_PREFIX."domain_article da ON a.articleid = da.articleid
                                          WHERE dc.active = 1 AND da.publish = 1 AND dc.domainid=".$_DOMAIN['domainid']." AND da.domainid=".$_DOMAIN['domainid']." GROUP BY c.categoryid",'categoryid');

    foreach ($a_category as $i_key=>$a_value) 
    {
        $a_category[$i_key]['articles'] = isset($a_category_articles[$i_key]['total']) ? $a_category_articles[$i_key]['total'] : 0;
    }
}
category_prepare($a_category);

$o_smarty->assign("a_category",$a_category);
$o_smarty->assign("i_count_category",count($a_category));

//-- get and assign best keywords
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_keyword_best.php';
else $a_keyword_best = db_search('keyword',array('orderby'=>'total desc','active'=>1,'limit'=>$_CONFIG['keyword_limit'],'domainid'=>ID_DOMAIN));
$a_keyword_best = buildRewriteEngineUrl($a_keyword_best,'keyword',array('keywordid','name'),'url');//-- fix rewrite engine url
$a_keyword_best = keword_removeSiteKeyword($a_keyword_best,'name','name_keyword'); //-- remove keys
$o_smarty->assign("a_keyword_best",$a_keyword_best);

//-- get and assign last keywords
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_keyword_last.php';
else $a_keyword_last = db_search('keyword',array('orderby'=>'k.keywordid desc','active'=>1,'limit'=>$_CONFIG['keyword_limit'],'domainid'=>ID_DOMAIN));
$a_keyword_last = buildRewriteEngineUrl($a_keyword_last,'keyword',array('keywordid','name'),'url');//-- fix rewrite engine url
$a_keyword_last = keword_removeSiteKeyword($a_keyword_last,'name','name_keyword'); //-- remove keys
$o_smarty->assign("a_keyword_last",$a_keyword_last);

//-- get and assign scripts
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_script.php';
else $a_script = db_get('script',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>ID_DOMAIN));

foreach ($a_script as $i_key=>$a_value) $a_script[$i_key]['a_position'] = explode('|',$a_script[$i_key]['position']);
$o_smarty->assign("a_script",$a_script);

//-- get and assign links
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_elink.php';
else $a_elink = db_get('link',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>ID_DOMAIN));

$a_temp = array();
foreach ($a_elink as $i_key=>$a_value) 
{
    $a_elink[$i_key]['a_position'] = explode('|',$a_elink[$i_key]['position']);
    for ($i=0;$i<count($a_elink[$i_key]['a_position']);$i++) $a_temp[$a_elink[$i_key]['a_position'][$i]][] = $a_value;
}
$a_elink = $a_temp;
$o_smarty->assign("a_elink",$a_elink);

//-- get and assign banners
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_banner.php';
else $a_banner = db_get('banner',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>ID_DOMAIN));

$a_temp = array();
foreach ($a_banner as $i_key=>$a_value) 
{
    $a_banner[$i_key]['a_position'] = explode('|',$a_banner[$i_key]['position']);
    $a_value['image']      = $_CONFIG['url'].'/banner/'.$a_value['image'];
    $a_size = @getimagesize($a_value['image']);
    if (isset($a_size[0])) $a_value['width'] = $a_size[0];
    if (isset($a_size[1])) $a_value['height'] = $a_size[1];

    for ($i=0;$i<count($a_banner[$i_key]['a_position']);$i++) $a_temp[$a_banner[$i_key]['a_position'][$i]][] = $a_value;
}
$a_banner = $a_temp;

$o_smarty->assign("a_banner",$a_banner);


//-- get and assign adsense
if (adsense_isIgnore()) {$a_adsense = array();}
else
{
    if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_adsense.php';
    else $a_adsense = db_get('adsense',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>ID_DOMAIN));
    foreach ($a_adsense as $i_key=>$a_value) $a_adsense[$i_key]['a_position'] = explode('|',$a_adsense[$i_key]['position']);
}
$o_smarty->assign("a_adsense",$a_adsense);

//-- get and assign faq
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_faq.php';
else
{
 $a_faq = $o_db->getAssoc("SELECT * from ".DB_PREFIX."faq f
						   INNER JOIN ".DB_PREFIX."domain_faq df ON f.faqid = df.faqid
						   WHERE df.active = 1 AND df.domainid=".$_DOMAIN['domainid']." ORDER BY df.ordon desc","faqid");
}

$a_faq = buildRewriteEngineUrl($a_faq,'faq',array('faqid','title'),'url');//-- fix rewrite engine url
$o_smarty->assign("a_faq",$a_faq);

if (!empty($_CONFIG['categoryid']))
{
	//-- get and assign last articles
	if (B_CACHE) 
	{
		include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.$_CONFIG['categoryid'].DIR_SEP.'a_category_article_latest.php';
		$a_article_category_last = $a_category_article_latest;
	}
	else
	{
		$a_article_category_last = db_search('article',array(
													'orderby'=>'total desc,datepublished desc',
													'active'=>1,
													'publish'=>1,
													'categoryid'=>$_CONFIG['categoryid'],
													'domainid'=>ID_DOMAIN,
													'limit'=>$_CONFIG['article_news_limit']
												   ));
	}

	article_prepare($a_article_category_last);//-- prepare articles
	$o_smarty->assign("a_article_category_last",$a_article_category_last);
	tag_addCloud($a_tag_cloud,$a_article_category_last,'tag');//-- add tags to tag cloud
}


//-- default meta title, description and keywords
$meta_title = $_CONFIG['title'];
$meta_description = $_CONFIG['description'];
if (!empty($_CONFIG['keyword'])) $meta_keyword = explode(', ',$_CONFIG['keyword']); 
else $meta_keyword = array();

//-- default tag cloud
$a_tag_cloud = $meta_keyword;
?>