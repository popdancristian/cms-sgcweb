<?php
//-- include global config
include_once PATH_ADMIN.'/_conf/config.php';

//-- include db lib
include_once PATH_LIB.DIR_SEP.'db.lib.php';

//-- read the domain
$_DOMAIN = db_get('domain',array('domainid'=>ID_DOMAIN));

if ($_DOMAIN['cache']==1) DEFINE('B_CACHE',   true);//-- use cache
else DEFINE('B_CACHE',   false);//-- don't use cache

//-- include user language
include_once PATH_LANG.DIR_SEP.DEFAULT_LANGUAGE.'.php';

//-- include libraries
include_once PATH_LIB.DIR_SEP.'function.lib.php';
include_once PATH_LIB.DIR_SEP.'rewritengine.lib.php';
include_once PATH_LIB.DIR_SEP.'util.lib.php';

//-- variables from _GET and _POST will be available in $attributes 
$attributes = array();
foreach ($_GET as $key => $value)  $attributes[$key] = $value;//-- get _POST values locally (over-write _GET)
foreach ($_POST as $key => $value) $attributes[$key] = $value;//-- get _POST values locally (over-write _GET)

//-- get the page param if not set => default page
$page = isset($attributes['page']) ? $attributes['page'] : PAGE_DEFAULT;

//-- get configuration from database
$_CONFIG = getConfig(ID_DOMAIN); 

//-- get db form
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'a_dbform.php';
else $a_dbform = getDbForm();
?>