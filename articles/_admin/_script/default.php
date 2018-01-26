<?php
//-- assign current page
$o_smarty->assign('page',$page);

//-- get configuration from database
$_CONFIG = getConfig(empty($_SESSION['domainid']) ? 1 : $_SESSION['domainid']);

//-- assign config info
$o_smarty->assign("_CONFIG",$_CONFIG);

//-- assign lang info
$o_smarty->assign("_l",$_l);

//-- assign module
$o_smarty->assign("_MODULE",$_MODULE);

//-- assign domain
$a_domain = db_get('domain',array('orderby'=>'ordon','field'=>'domainid'));
$o_smarty->assign('a_domain',$a_domain);

//-- assign page title & action
$html_title        = $_CONFIG['title'].' .:: '._l('admincp');
$str_page_title    = _l('admincp');
if (($page != 'home') and isset($_l[$page]))
{
    $html_title.=' .:: '.$_l[$page];
    $str_page_title = $_l[$page];
}

$o_smarty->assign('html_title', $html_title);
$o_smarty->assign('str_page_title', $str_page_title);

//-- assign the search params/string
$o_smarty->assign('a_search',$a_search['a_param']);
$o_smarty->assign('str_search_param',$a_search['str_param']);

?>