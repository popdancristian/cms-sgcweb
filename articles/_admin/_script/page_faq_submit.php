<?php
switch ($attributes['action'])
{
    case 'add':      
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags
        $a_data = array
        (
             'title'=>$attributes['title'],
             'description'=>$attributes['description'],
             'content'=>$attributes['content'],   
             'tag'=>$str_tag,
			 'categoryid'=>intval($attributes['categoryid']),
        );

		$i_faqid = db_add('faq',$a_data);

        $o_db->query("INSERT INTO ".DB_PREFIX."domain_faq (domainid,faqid,active,ordon) SELECT domainid,".$i_faqid.",".intval($attributes['active']).",".intval($attributes['ordon'])." FROM ".DB_PREFIX."domain");
    break;
    case 'mod':        
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags
        
        $a_data = array
        (
             'title'=>$attributes['title'],
             'description'=>$attributes['description'],
             'content'=>$attributes['content'],   
             'tag'=>$str_tag,
			 'categoryid'=>intval($attributes['categoryid'])
         );
         db_mod('faq',$a_data,$attributes['faqid']);

		 $o_db->query("UPDATE ".DB_PREFIX."domain_faq SET ordon=".intval($attributes['ordon']).", active=".intval($attributes['active'])." WHERE domainid = ".$_SESSION['domainid']." AND faqid = ".$attributes['faqid']);
    break;
    case 'ordon':
        db_modOrdon('domain_faq',$attributes['faqid'],$attributes['ordon'],array('domainid'=>$_SESSION['domainid']),'faqid');
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('domain_faq','active',$attributes['faqid'],$attributes['active'],array('domainid'=>$_SESSION['domainid']),'faqid');
    break;
	case 'home':
        if (empty($attributes['home'])) $attributes['home'] = array();
        db_modFlag('domain_faq','home',$attributes['faqid'],$attributes['home'],array('domainid'=>$_SESSION['domainid']),'faqid');
    break;
    case 'del':
        db_del('faq',$attributes['faqid']);
        db_del('domain_faq','',array('faqid'=>$attributes['faqid']));
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page.$a_search['str_param']);
?>