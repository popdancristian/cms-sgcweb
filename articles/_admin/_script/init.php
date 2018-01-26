<?php
//-- include global config
include_once '_conf/config.php';

//-- FIX: www. admin proble with the editor ($_SERVER['SERVER_NAME'])
if ((!B_DEV) and (strpos($_SERVER['HTTP_HOST'],'www.') === false)) header("Location: ".URL_SITE."/index.php");

//-- include admin language
include_once PATH_LANG.DIR_SEP.DEFAULT_LANGUAGE.'.php';

//-- include admin config
include_once '_script/config.php';

//-- include libraries
include_once PATH_LIB.'/function.lib.php';
include_once PATH_LIB.'/db.lib.php';
include_once PATH_LIB.'/auth.lib.php';

//-- include smarty
include_once PATH_CLASS.'/smarty/Smarty.class.php';
$o_smarty = new Smarty;
$o_smarty->compile_dir    = PATH_SMARTY_COMPILE;
$o_smarty->template_dir   = PATH_SMARTY_TEMPLATE;

//-- variables from _GET and _POST will be available in $attributes 
$attributes = array();
foreach ($_GET as $key => $value)  $attributes[$key] = $value;//-- get _POST values locally (over-write _GET)
foreach ($_POST as $key => $value) $attributes[$key] = $value;//-- get _POST values locally (over-write _GET)

//-- get the page & action param
$page = isset($attributes['page']) ? $attributes['page'] : 'home';
$action = isset($attributes['action']) ? $attributes['action'] : '';
//-- build the search params/string
$a_search = search_buildParam($attributes);
?>