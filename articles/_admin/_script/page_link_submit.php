<?php
switch ($attributes['action'])
{
    case 'add':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_add('link',
               array(
                     'domainid'=>$_SESSION['domainid'],
                     'title'=>$attributes['title'],
                     'url'=>$attributes['url'],
                     'position'=>$attributes['position'],
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active']))
             );
    break;
    case 'mod':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_mod('link',
               array('title'=>$attributes['title'],
                     'url'=>$attributes['url'],
                     'position'=>$attributes['position'],
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active'])),
               $attributes['linkid']
             );
    break;
    case 'ordon':
        db_modOrdon('link',$attributes['linkid'],$attributes['ordon']);
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('link','active',$attributes['linkid'],$attributes['active']);
    break;
    case 'del':
        db_del('link',$attributes['linkid']);
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page);
?>