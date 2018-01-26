<?php
//-- base url and path
DEFINE ('URL_SITE','http://localhost:8080/rims.ro/articles/_admin');
DEFINE ('PATH_SITE','d:\USBWebserver v8.5\8.5\root\rims.ro/articles/_admin');
//-- mysql db connection data
define('DB_HOST',   'localhost');
define('DB_NAME',   'rims');
define('DB_USER',   'root');
define('DB_PASS',   'usbw');
DEFINE ('B_DEV',    true);//-- development mode


//-- db connection data
DEFINE ('DB_PREFIX', 'cms_'); //-- db prefix
DEFINE ('DIR_SEP', DIRECTORY_SEPARATOR);//-- dir separator

//-- libs paths
DEFINE ('PATH_LIB',PATH_SITE.DIR_SEP.'_lib');
DEFINE ('PATH_CLASS',PATH_SITE.DIR_SEP.'_class');
DEFINE ('PATH_LANG',PATH_SITE.DIR_SEP.'_lang');
DEFINE ('PATH_SCRIPT',PATH_SITE.DIR_SEP.'_script');

//-- smarty paths
DEFINE ('PATH_SMARTY_TEMPLATE',PATH_SITE.DIR_SEP."_template");
DEFINE ('PATH_SMARTY_COMPILE',PATH_SITE.DIR_SEP.'_template_c');

//-- smarty template url
DEFINE ('URL_SMARTY_TEMPLATE',URL_SITE."/_template");

//-- define default system pages
DEFINE ('PAGE_DEFAULT',     'default');
DEFINE ('PAGE_CATEGORY',    'category');
DEFINE ('PAGE_ARTICLE',     'article');
DEFINE ('PAGE_SEARCH',      'search');
DEFINE ('PAGE_KEYWORD',     'keyword');
DEFINE ('PAGE_SITEMAP',     'sitemap');
DEFINE ('PAGE_CONTACT',     'contact');

$_SYSTEM_PAGE = array(PAGE_CATEGORY,PAGE_ARTICLE,PAGE_SEARCH,PAGE_KEYWORD,PAGE_SITEMAP,PAGE_CONTACT);

//-- define default language
DEFINE ('DEFAULT_LANGUAGE','en');
//-- define default domain id
DEFINE ('DEFAULT_DOMAINID',1);
//-- define current time
DEFINE ('CURRENT_TIME',date('Y-m-d H:i:s'));

//-- build de frontend path
$a_frontend_path = explode('/',PATH_SITE);unset($a_frontend_path[count($a_frontend_path)-1]);
DEFINE ('PATH_FRONTEND',implode('/',$a_frontend_path));
?>