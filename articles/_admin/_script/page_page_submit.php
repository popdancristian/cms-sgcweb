<?php
switch ($attributes['action'])
{
    case 'add':        
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags
        $attributes['menus'] = isset($attributes['menus']) ? implode('|',$attributes['menus']) : '';
        
        $a_data = array
        (
         'name'=>page_fixName($attributes['name']),
         'template'=>$attributes['template'],
         'menu'=>quote($attributes['menu']),
         'title'=>quote($attributes['title']),
         'content'=>quote($attributes['content']),
         'description'=>quote($attributes['description']),
         'tag'=>quote($str_tag)
        );

        //-- add dinamic fields
        $a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'page'));
        for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = quote($attributes[$a_dbform[$i]['fieldname']]);

        $i_pageid = db_add('page',$a_data);

        $o_db->query("INSERT INTO ".DB_PREFIX."domain_page (domainid,pageid,menus,active,ordon) 
                      SELECT domainid,
                             ".$i_pageid.",
                             '".$attributes['menus']."',
                             ".intval($attributes['active']).",
                             ".intval($attributes['ordon'])."
                             FROM ".DB_PREFIX."domain");
    break;
    case 'mod':
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags
        $attributes['menus'] = isset($attributes['menus']) ? implode('|',$attributes['menus']) : '';
        
        $a_data = array(
                 'name'=>page_fixName($attributes['name']),
                 'template'=>$attributes['template'],
                 'menu'=>quote($attributes['menu']),
                 'title'=>quote($attributes['title']),
                 'content'=>quote($attributes['content']),
                 'description'=>quote($attributes['description']),
                 'tag'=>quote($str_tag)
              );

        //-- add dinamic fields
        $a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'page'));
        for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = quote($attributes[$a_dbform[$i]['fieldname']]);

        db_mod('page',$a_data,$attributes['pageid']);
        
        
        $o_db->query("UPDATE ".DB_PREFIX."domain_page SET 
                       menus='".$attributes['menus']."', 
                       ordon=".intval($attributes['ordon']).", 
                       active=".intval($attributes['active'])."
                       WHERE domainid = ".$_SESSION['domainid']." AND pageid = ".$attributes['pageid']);
    break;
    case 'ordon':
        db_modOrdon('domain_page',$attributes['pageid'],$attributes['ordon'],array('domainid'=>$_SESSION['domainid']),'pageid');
    break;
    case 'home':
        db_modFlagUnique('page','home',$attributes['pageid']);
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('domain_page','active',$attributes['pageid'],$attributes['active'],array('domainid'=>$_SESSION['domainid']),'pageid');
    break;
    case 'del':
        db_del('page',$attributes['pageid']);
        db_del('domain_page','',array('pageid'=>$attributes['pageid']));
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page);
?>