<?php
switch ($attributes['action'])
{
    case 'add':
       
        $attributes['publish'] = intval($attributes['publish']);
        if ($attributes['publish'] == 1) $date_published = CURRENT_TIME;
        else $date_published = NULL;
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags

        $a_data = array(
                         'categoryid'=>intval($attributes['categoryid']),
                         'title'=>$attributes['title'],
                         'description'=>$attributes['description'],
                         'content'=>$attributes['content'],
                         'script'=>$attributes['script'],
                         'swffile'=>$attributes['swffile'],
                         'swfwidth'=>intVal($attributes['swfwidth']),
                         'swfheight'=>intVal($attributes['swfheight']),
                         'image'=>$attributes['image'],
                         'tag'=>$str_tag,
                         'dateadded'=>CURRENT_TIME,
                         'datemodified'=>CURRENT_TIME
                        );
        
        //-- add dinamic fields
        $a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'article'));
        for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $attributes[$a_dbform[$i]['fieldname']];

        $i_articleid = db_add('article',$a_data);

        $o_db->query("INSERT INTO ".DB_PREFIX."domain_article (domainid,articleid,active,ordon,publish,datepublished) SELECT domainid,".$i_articleid.",".intval($attributes['active']).",".intval($attributes['ordon']).",".intval($attributes['publish']).",'".$date_published."' FROM ".DB_PREFIX."domain");
    break;
    case 'mod':
        $str_tag = tag_fixString($attributes['tag']);//-- fix tags
        $a_data = array(
                         'categoryid'=>intval($attributes['categoryid']),
                         'title'=>$attributes['title'],
                         'description'=>$attributes['description'],
                         'content'=>$attributes['content'],
                         'script'=>$attributes['script'],
                         'swffile'=>$attributes['swffile'],
                         'swfwidth'=>intVal($attributes['swfwidth']),
                         'swfheight'=>intVal($attributes['swfheight']),
                         'image'=>$attributes['image'],
                         'tag'=>$str_tag,
                         'datemodified'=>CURRENT_TIME                         
                        );      
        
        //-- add dinamic fields
        $a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'article'));
        for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $attributes[$a_dbform[$i]['fieldname']];

        //-- mod article
        db_mod('article',$a_data,$attributes['articleid']);
        
        $str_publish_date = '';
        $attributes['publish'] = intval($attributes['publish']);
        if ($attributes['publish'] != $attributes['old_publish'])
        {
           if ($attributes['publish'] == 1) $str_publish_date = ", datepublished = '".CURRENT_TIME."'";
           else $str_publish_date = ", datepublished = NULL";
        } 

        $o_db->query("UPDATE ".DB_PREFIX."domain_article SET ordon=".intval($attributes['ordon']).", active=".intval($attributes['active']).", publish=".intval($attributes['publish'])."$str_publish_date WHERE domainid = ".$_SESSION['domainid']." AND articleid = ".$attributes['articleid']);

    break;
    case 'ordon':
        db_modOrdon('domain_article',$attributes['articleid'],$attributes['ordon'],array('domainid'=>$_SESSION['domainid']),'articleid');
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('domain_article','active',$attributes['articleid'],$attributes['active'],array('domainid'=>$_SESSION['domainid']),'articleid');
    break;
    case 'publish':
        if (empty($attributes['publish'])) $attributes['publish'] = array();
        $a_article = $o_db->getAll("SELECT * from ".DB_PREFIX."domain_article WHERE articleid in (".implode(',',$attributes['articleid']).") AND domainid = ".$_SESSION['domainid']);
        for ($i=0;$i<count($a_article);$i++)
        {
            if (($a_article[$i]['publish'] == 1) and (!isset($attributes['publish'][$i])))
            {
                $o_db->query("UPDATE ".DB_PREFIX."domain_article SET datepublished = NULL WHERE articleid = ".$a_article[$i]['articleid']. " AND domainid = ".$_SESSION['domainid']);
            }
            elseif (($a_article[$i]['publish'] == 0) and (isset($attributes['publish'][$i])))
            {
                $o_db->query("UPDATE ".DB_PREFIX."domain_article SET datepublished = '".CURRENT_TIME."' WHERE articleid = ".$a_article[$i]['articleid']. " AND domainid = ".$_SESSION['domainid']);
            }
        }
            
        db_modFlag('domain_article','publish',$attributes['articleid'],$attributes['publish'],array('domainid'=>$_SESSION['domainid']),'articleid');
    break;
    case 'del':
        db_del('article',$attributes['articleid']);
        db_del('domain_article','',array('articleid'=>$attributes['articleid']));
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page.$a_search['str_param']);
?>