<?php
switch ($attributes['action'])
{
    case 'add':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_add('script',
               array(
                     'domainid'=>$_SESSION['domainid'],
                     'name'=>quote($attributes['name']),
                     'content'=>quote($attributes['content']),
                     'position'=>$attributes['position'],
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active']))
             );
    break;
    case 'mod':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_mod('script',
               array('name'=>quote($attributes['name']),
                     'content'=>quote($attributes['content']),
                     'position'=>$attributes['position'],
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active'])),
               $attributes['scriptid']
             );
    break;
    case 'ordon':
        db_modOrdon('script',$attributes['scriptid'],$attributes['ordon']);
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('script','active',$attributes['scriptid'],$attributes['active']);
    break;
    case 'del':
        db_del('script',$attributes['scriptid']);
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page);
?>