<?php

$str_ht_file = "RewriteEngine on\n";
$str_ht_file.= "\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]c[RES]([0-9]*).html$ index.php?page=category&category=$1&categoryid=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]c[RES]([0-9]*)[RES]p[RES]([0-9]*).html$ index.php?page=category&category=$1&categoryid=$2&start=$3 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]m[RES]([0-9]*).html index.php?page=popular&category=$1&categoryid=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]m[RES]([0-9]*)[RES]p[RES]([0-9]*).html index.php?page=popular&category=$1&categoryid=$2&start=$3 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]l[RES]([0-9]*).html index.php?page=latest&category=$1&categoryid=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]l[RES]([0-9]*)[RES]p[RES]([0-9]*).html index.php?page=latest&category=$1&categoryid=$2&start=$3 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]a[RES]([0-9]*).html$ index.php?page=article&name=$1&articleid=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]k[RES]([0-9]*).html$ index.php?page=search&keyword=$1&keywordid=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]k[RES]([0-9]*)[RES]p[RES]([0-9]*).html$ index.php?page=search&keyword=$1&keywordid=$2&start=$3 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]t[RES]([0-9]*).html$ index.php?page=search&tag=$1&tagid=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^(.*)[RES]t[RES]([0-9]*)[RES]p[RES]([0-9]*).html$ index.php?page=search&tag=$1&tagid=$2&start=$3 [L]\n";
$str_ht_file.= "RewriteRule   keyword[RES]([a-z]|[0-9]).html index.php?page=keyword&letter=$1 [L]\n";
$str_ht_file.= "RewriteRule   sitemap[RES](.*)[RES]([0-9]*).html index.php?page=sitemap&category=$1&categoryid=$2 [L]\n";
$str_ht_file.= "RewriteRule   all[RES]([a-z]).html index.php?page=all&letter=$1 [L]\n";
$str_ht_file.= "RewriteRule   all[RES]([a-z])[RES]p[RES]([0-9]*).html   index.php?page=all&letter=$1&start=$2 [L]\n";
$str_ht_file.= "RewriteRule   ^([a-z]*).html$ index.php?page=$1 [L]\n";
$str_ht_file.= "RewriteRule   ^([a-z]*)[RES]p[RES]([0-9]*).html$ index.php?page=$1&start=$2 [L]";



$str_ht_file = str_replace('[RES]',$_CONFIG['rewrite_engine_string'],$str_ht_file);
if ($_CONFIG['rewrite_engine_method']!=1) $str_ht_file = str_replace('.html','',$str_ht_file);  

$o_smarty->assign("str_ht_file",$str_ht_file);

$a_url_site = explode('/',URL_SITE);unset($a_url_site[count($a_url_site)-1]);
$a_path_site = explode('/',PATH_SITE);unset($a_path_site[count($a_path_site)-1]);

$str_index_file = "<?php\n";
$str_index_file.= "//-- base url and path admin\n";
$str_index_file.="DEFINE ('URL_ADMIN','".implode('/',$a_url_site)."');\n";
$str_index_file.="DEFINE ('PATH_ADMIN','".implode('/',$a_path_site)."');\n";
$str_index_file.="//-- domain id\n";
$str_index_file.="DEFINE ('ID_DOMAIN',".$_SESSION['domainid'].");\n";
$str_index_file.="//-- include games\n";
$str_index_file.="include_once PATH_ADMIN.'/article.php';\n";
$str_index_file.="?>\n";
$o_smarty->assign("str_index_file",$str_index_file);
?>