<?php
function _l($str_name)
{
    global $_l;
    if (isset($_l[$str_name])) return $_l[$str_name];
    else return $str_name;
}
if (B_CACHE) include_once PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.ID_DOMAIN.DIR_SEP.'_l.php';
else
{
    $_l = array();
    $a_lang = $o_db->getAll("SELECT * from cms_lang WHERE domainid = ".ID_DOMAIN);
    for ($i=0;$i<count($a_lang);$i++) $_l[$a_lang[$i]['lang_name']] = $a_lang[$i]['lang_value'];
}
?>