<?php
$attributes['keyword'] = strtolower($attributes['keyword']);
$keyword = keyword_fixString($attributes['keyword']);

$i_keywordid = db_add('keyword',array('name'=>$keyword,'alias'=>$keyword,'domainid'=>ID_DOMAIN));
if ($i_keywordid == 0)
{
    //-- search the keyword into the database
    $a_keyword = db_get('keyword',array(),array('name'=>$keyword,'domainid'=>ID_DOMAIN));
    if (!empty($a_keyword)) 
    {
        $i_keywordid = intval($a_keyword[0]['keywordid']);
        $o_db->query('update '.DB_PREFIX.'keyword set total=total+1 where keywordid ='.$i_keywordid);
    }
}
else 
{
   db_add('keyword',array('domainid'=>ID_DOMAIN,'keywordid'=>$i_keywordid,'total'=>0,'active'=>0));
}

header("Location: ".getRewriteEngineUrl('keyword',array('name'=>$keyword,'keywordid'=>$i_keywordid)));
?>