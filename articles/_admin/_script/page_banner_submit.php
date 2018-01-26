<?php
switch ($attributes['action'])
{
    case 'add':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_add('banner',
               array(
                     'domainid'=>$_SESSION['domainid'],
                     'image'=>$attributes['image'],
                     'title'=>$attributes['title'],
                     'url'=>$attributes['url'],
                     'position'=>$attributes['position'],
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active']))
             );
    break;
    case 'mod':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_mod('banner',
               array('image'=>$attributes['image'],
                     'title'=>$attributes['title'],
                     'url'=>$attributes['url'],
                     'position'=>$attributes['position'],
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active'])),
               $attributes['bannerid']
             );
    break;
    case 'ordon':
        db_modOrdon('banner',$attributes['bannerid'],$attributes['ordon']);
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('banner','active',$attributes['bannerid'],$attributes['active']);
    break;
    case 'del':
        db_del('banner',$attributes['bannerid']);
    break;
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page);
?>