<?php
header('Content-type: text/html; charset=ISO-8859-1');
include_once '_lib/timeob.lib.php';
$starttime = TimeObHeader();
session_start(); //-- start session

include_once PATH_ADMIN.'/_script/init.php';//-- include init
if (!B_DEV) include_once PATH_ADMIN.'/error_handler.php';

//-- if we have some post actions, include script for page action
if (isset($attributes['submit']) and (file_exists(PATH_SCRIPT.DIR_SEP.'page_'.$attributes['page'].'_submit.php'))) 
{
 include_once PATH_SCRIPT.DIR_SEP.'page_'.$attributes['page'].'_submit.php';
}

//-- include default
include_once PATH_SCRIPT.DIR_SEP.'default.php';

if (in_array($page,$_SYSTEM_PAGE)) $str_page_template = $page;
else $str_page_template = $a_page[$page]['template'];

//-- get script path for page
$include_page = PATH_SCRIPT.DIR_SEP.'page_'.$str_page_template.'.php';

//-- include script for page (if exist)
if (file_exists($include_page)) include_once $include_page;
else include_once PATH_SCRIPT.DIR_SEP.'page_default.php';



//-- get template for page 
$include_template = PATH_SMARTY_TEMPLATE.DIR_SEP.$_CONFIG['site_template'].DIR_SEP.'page_'.$str_page_template.'.html';

//-- assign template for page (if exist) 
if (file_exists($include_template)) $o_smarty->assign('include_template',$include_template);
else $o_smarty->assign('include_template',PATH_SMARTY_TEMPLATE.DIR_SEP.$_CONFIG['site_template'].DIR_SEP.'page_default.html');


//-- get and assign meta info
if (empty($meta_title)) $meta_title = $_CONFIG['title'];
if (empty($meta_description)) $meta_description = $_CONFIG['description'];
if (!empty($_CONFIG['title_prefix'])) $meta_title = $_CONFIG['title_prefix'].config_titleSeparator().$meta_title;
if (!empty($_CONFIG['title_sufix'])) $meta_title = $meta_title.config_titleSeparator().$_CONFIG['title_sufix'];

$o_smarty->assign('meta_title',$meta_title);
$o_smarty->assign('meta_description',$meta_description);
$o_smarty->assign('meta_keyword',fixMetaKeyword($meta_keyword));

//-- assign tag cloud
$o_smarty->assign('a_tag_cloud',tag_buildCloud($a_tag_cloud));

//-- display template default
$o_smarty->display('default.html');

TimeObFooter($starttime);
?>