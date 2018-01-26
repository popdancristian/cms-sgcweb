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
             'directory'=>$attributes['directory'],
             'image'=>$attributes['image'],
             'tag'=>$str_tag
         );

        //-- add dinamic fields
        $a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'category'));
        for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $attributes[$a_dbform[$i]['fieldname']];

        $i_categoryid = db_add('category',$a_data);
        $o_db->query("INSERT INTO ".DB_PREFIX."domain_category (domainid,categoryid,active,ordon) SELECT domainid,".$i_categoryid.",".intval($attributes['active']).",".intval($attributes['ordon'])." FROM ".DB_PREFIX."domain");
    break;
    case 'mod':        
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags
        
        $a_data = array(
                         'title'=>$attributes['title'],
                         'description'=>$attributes['description'],
                         'content'=>$attributes['content'],
                         'directory'=>$attributes['directory'],
                         'image'=>$attributes['image'],
                         'tag'=>$str_tag
                      );

        //-- add dinamic fields
        $a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'category'));
        for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $attributes[$a_dbform[$i]['fieldname']];

         db_mod('category',$a_data,$attributes['categoryid']);

         $o_db->query("UPDATE ".DB_PREFIX."domain_category SET ordon=".intval($attributes['ordon']).", active=".intval($attributes['active'])." WHERE domainid = ".$_SESSION['domainid']." AND categoryid = ".$attributes['categoryid']);
    break;
    case 'ordon':
        db_modOrdon('domain_category',$attributes['categoryid'],$attributes['ordon'],array('domainid'=>$_SESSION['domainid']),'categoryid');
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('domain_category','active',$attributes['categoryid'],$attributes['active'],array('domainid'=>$_SESSION['domainid']),'categoryid');
    break;
	case 'home':
        if (empty($attributes['home'])) $attributes['home'] = array();
        db_modFlag('domain_category','home',$attributes['categoryid'],$attributes['home'],array('domainid'=>$_SESSION['domainid']),'categoryid');
    break;
    case 'del':
        db_del('category',$attributes['categoryid']);
        db_del('domain_category','',array('categoryid'=>$attributes['categoryid']));
        //-- update all articles to categoryid = 0
        $o_db->query("UPDATE ".DB_PREFIX."article SET categoryid = 0 WHERE categoryid = ".$attributes['categoryid']);
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page.$a_search['str_param']);
?>