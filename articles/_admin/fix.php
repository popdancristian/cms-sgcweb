<?php
set_time_limit(0);
include_once '_conf/config.php';//-- include config

//-- include libraries
include_once PATH_LIB.DIR_SEP.'db.lib.php';

//-- update ordon random
$a_category = db_get('category',array('orderby'=>'title'));

  //-- update ordon
for ($j=0;$j<count($a_category);$j++)
{
    $a_article = db_get('article',array('orderby'=>'title'),array('categoryid'=>$a_category[$j]['categoryid']));
    
    $a_ordon = array();
    for ($i=0;$i<count($a_article);$i++) $a_ordon[] = $i+1;
    shuffle($a_ordon);
    
    for ($i=0;$i<count($a_article);$i++) 
    $o_db->query("UPDATE ".DB_PREFIX."domain_article SET ordon = ".$a_ordon[$i]." WHERE domainid = 4 AND articleid = ".$a_article[$i]['articleid']);
    
}

/*
$a_article = $o_db->getAll("select articleid from cms_article where dateadded>='2011-11-26' order by rand()");
$i_maxordon = $o_db->getOne('select max(ordon) 
                             from cms_domain_article da
                             inner join cms_article a on da.articleid = a.articleid
                             where domainid = 3');

for ($j=0;$j<count($a_article);$j++)
{    
    $i_maxordon++;
    $o_db->query("UPDATE ".DB_PREFIX."domain_article SET ordon = ".$i_maxordon." WHERE domainid = 3 AND articleid = ".$a_article[$j]['articleid']);
    
}
*/
echo 'Done';
?>