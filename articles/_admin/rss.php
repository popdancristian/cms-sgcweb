<?php
set_time_limit(0);
session_start();

if (empty($_SESSION['domainid'])) die('Please select a domain!');

include_once '../_conf/config.php';//-- include config

include_once PATH_LIB.DIR_SEP.'db.lib.php';

function fix_rss($str_text) 
{
	$str_result = str_replace('&amp;','&',$str_text);
	$str_result = str_replace('&','',$str_result);
	return $str_result;
};

function _l($str_name)
{
    global $_l;
    if (isset($_l[$str_name])) return $_l[$str_name];
    else return $str_name;
}

$_l = array();
$a_lang = $o_db->getAll("SELECT * from cms_lang WHERE domainid = ".$_SESSION['domainid']);
for ($i=0;$i<count($a_lang);$i++) $_l[$a_lang[$i]['lang_name']] = $a_lang[$i]['lang_value'];

//-- include libraries
include_once PATH_LIB.DIR_SEP.'function.lib.php';
include_once PATH_LIB.DIR_SEP.'rewritengine.lib.php';

$_DOMAIN= $o_db->getRow('SELECT * from '.DB_PREFIX.'domain where domainid = '.intval($_SESSION['domainid']));//-- get domain
$_CONFIG = getConfig($_DOMAIN['domainid']);//-- get config

$str_rss_path = $_DOMAIN['path'];
if (!empty($_CONFIG['rss_dir'])) $str_rss_path.=DIR_SEP.$_CONFIG['rss_dir'];

//-- BEGIN general rss
$str_rss ='<?xml version="1.0" encoding="UTF-8"?>'."\n";
$str_rss.='<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">'."\n";
$str_rss.='<channel>'."\n";

$str_rss.=' <title>'.$_CONFIG['motto'].'</title>'."\n";
$str_rss.=' <link>'.$_DOMAIN['url'].'</link>'."\n";
$str_rss.=' <description>'.$_CONFIG['description'].'</description>'."\n";

$a_page = $o_db->getAssoc("SELECT * from ".DB_PREFIX."page p
						   INNER JOIN ".DB_PREFIX."domain_page dp ON p.pageid = dp.pageid
						   WHERE active = 1 AND dp.domainid=".$_DOMAIN['domainid']." ORDER BY ordon",'name');

page_prepare($a_page);

//-- page template
$a_page_template = array();
foreach ($a_page as $str_key=>$a_value) $a_page_template[$a_value['template']] = $str_key;

foreach ($a_page as $i_key=>$a_value)
{
 $str_rss.='<item>'."\n";
 $str_rss.=' <title>'.fix_rss($a_value['menu']).'</title>'."\n";
 $str_rss.=' <description>'.fix_rss($a_value['description']).'</description>'."\n";
 $str_rss.=" <link>".$a_value['url']."</link>"."\n";
 $str_rss.='</item>'."\n";
}

//-- read and assign categories
$a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
							   INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
							   WHERE dc.active = 1 AND dc.domainid=".$_DOMAIN['domainid']." ORDER BY ".$_CONFIG['category_ordon'],'categoryid');

category_prepare($a_category);

foreach ($a_category as $i_key=>$a_value)
{
 $str_rss.='<item>'."\n";
 $str_rss.=' <title>'.fix_rss($a_value['title']).'</title>'."\n";
 $str_rss.=' <description>'.fix_rss($a_value['description']).'</description>'."\n";
 $str_rss.=" <link>".$a_value['url']."</link>"."\n";
 $str_rss.='</item>'."\n";
}

//-- get and assign faq
$a_faq = $o_db->getAssoc("SELECT * from ".DB_PREFIX."faq f
				   INNER JOIN ".DB_PREFIX."domain_faq df ON f.faqid = df.faqid
				   WHERE df.active = 1 AND df.domainid=".$_DOMAIN['domainid']." ORDER BY df.ordon desc","faqid");

$a_faq = buildRewriteEngineUrl($a_faq,'faq',array('faqid','title'),'url');//-- fix rewrite engine url

foreach ($a_faq as $i_key=>$a_value)
{
 $str_rss.='<item>'."\n";
 $str_rss.=' <title>'.fix_rss($a_value['title']).'</title>'."\n";
 $str_rss.=' <description>'.fix_rss($a_value['description']).'</description>'."\n";
 $str_rss.=" <link>".$a_value['url']."</link>"."\n";
 $str_rss.='</item>'."\n";
}

//-- begin categories sitemap
foreach ($a_category as $i_key=>$a_value)
{	
   //-- get and assign last articles
   $a_article = db_search('article',array(
											'orderby'=>$_CONFIG['article_ordon'].',ordon desc',
											'active'=>1,
											'publish'=>1,
											'domainid'=>$_DOMAIN['domainid'],
											'categoryid'=>$i_key
										   ));
	if (count($a_article)>0)
	{
	 article_prepare($a_article);//-- prepare articles
	 foreach ($a_article as $i_key1=>$a_value1)
     {
		 $str_rss.='<item>'."\n";
		 $str_rss.=' <title>'.fix_rss($a_value1['title']).'</title>'."\n";
		 $str_rss.=' <description>'.fix_rss($a_value1['description']).'</description>'."\n";
		 $str_rss.=" <link>".$a_value1['url']."</link>"."\n";
		 $str_rss.='</item>'."\n";
	 }
	}
}
$str_rss.="</channel>\n";
$str_rss.='</rss>';

$handle = @fopen ($str_rss_path.DIR_SEP.'rss.xml', "w+");
if ($handle)
{
	fputs($handle,$str_rss);
	fclose ($handle);    
}
echo 'Done';
?>