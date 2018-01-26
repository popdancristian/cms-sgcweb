<?php
$a_stat = array();
$a_stat['page_count'] = $o_db->getOne('select count(*) from '.DB_PREFIX.'page');
$a_stat['category_count'] = $o_db->getOne('select count(*) from '.DB_PREFIX.'category');
$a_stat['article_count'] = $o_db->getOne('select count(*) from '.DB_PREFIX.'article');
$o_smarty->assign('a_stat',$a_stat);

$a_domain_stat = array();
foreach($a_domain as $i_domainid=>$a_value)
{
    $a_domain_stat[$i_domainid]['page_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."page p
                                                               INNER JOIN ".DB_PREFIX."domain_page dp ON dp.pageid = p.pageid
                                                               WHERE dp.active = 1 AND dp.domainid=".$i_domainid);

    $a_domain_stat[$i_domainid]['category_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."category c
                                                                   INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                                                   WHERE dc.active = 1 AND dc.domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['article_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."article a
                                                                   INNER JOIN ".DB_PREFIX."domain_article da ON a.articleid = da.articleid
                                                                   INNER JOIN ".DB_PREFIX."domain_category dc ON a.categoryid = dc.categoryid
                                                                   WHERE da.active = 1 AND da.domainid=".$i_domainid." AND dc.active = 1 AND da.publish = 1 AND dc.domainid=".$i_domainid);

    $a_domain_stat[$i_domainid]['link_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."link WHERE active = 1 AND domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['banner_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."banner WHERE active = 1 AND domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['keyword_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."keyword WHERE active = 1 AND domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['tag_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."tag WHERE domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['adsense_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."adsense WHERE active = 1 AND domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['script_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."script WHERE active = 1 AND domainid=".$i_domainid);
    $a_domain_stat[$i_domainid]['comment_count'] = $o_db->getOne("SELECT count(*) FROM ".DB_PREFIX."article_comment WHERE active = 1 AND domainid=".$i_domainid);

}
$o_smarty->assign('a_domain_stat',$a_domain_stat);

?>