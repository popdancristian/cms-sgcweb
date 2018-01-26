<?php
switch ($attributes['action'])
{
    case 'add':      
        $a_data = array(
                         'categoryid'=>intval($attributes['categoryid']),
                         'title'=>$attributes['title'],
                         'image'=>$attributes['image'],
                         'dateadded'=>CURRENT_TIME,
                         'datemodified'=>CURRENT_TIME
                        );

        $i_galleryid = db_add('gallery',$a_data);

        $o_db->query("INSERT INTO ".DB_PREFIX."domain_gallery (domainid,galleryid,active,ordon,home) SELECT domainid,".$i_galleryid.",".intval($attributes['active']).",".intval($attributes['ordon']).",".intval($attributes['home'])." FROM ".DB_PREFIX."domain");
    break;
    case 'mod':
        
        $a_data = array(
                         'categoryid'=>intval($attributes['categoryid']),
                         'title'=>$attributes['title'],
                         'image'=>$attributes['image'],
                         'dateadded'=>CURRENT_TIME,
                         'datemodified'=>CURRENT_TIME
                        ); 

        //-- mod gallery
        db_mod('gallery',$a_data,$attributes['galleryid']);
        
        $o_db->query("UPDATE ".DB_PREFIX."domain_gallery SET ordon=".intval($attributes['ordon']).", active=".intval($attributes['active']).", home=".intval($attributes['home'])." WHERE domainid = ".$_SESSION['domainid']." AND galleryid = ".$attributes['galleryid']);

    break;
    case 'ordon':
        db_modOrdon('domain_gallery',$attributes['galleryid'],$attributes['ordon'],array('domainid'=>$_SESSION['domainid']),'galleryid');
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('domain_gallery','active',$attributes['galleryid'],$attributes['active'],array('domainid'=>$_SESSION['domainid']),'galleryid');
    break;
    case 'home':
        if (empty($attributes['home'])) $attributes['home'] = array();
        db_modFlag('domain_gallery','home',$attributes['galleryid'],$attributes['home'],array('domainid'=>$_SESSION['domainid']),'galleryid');
    break;
	case 'title':
        for ($i=0;$i<count($attributes['galleryid']);$i++) db_mod('gallery',array('title'=>$attributes['title'][$i]),$attributes['galleryid'][$i]);
    break;
    case 'del':
        db_del('gallery',$attributes['galleryid']);
        db_del('domain_gallery','',array('galleryid'=>$attributes['galleryid']));
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page.$a_search['str_param']);
?>