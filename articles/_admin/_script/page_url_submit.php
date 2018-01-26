<?php
switch ($attributes['action'])
{
    case 'add':
        db_add('url',
               array(
                     'name'=>$attributes['name'],
                     'active'=>intval($attributes['active'])
                    )
             );
    break;
    case 'mod':
        db_mod('url',
               array(
                     'name'=>$attributes['name'],
                     'active'=>intval($attributes['active'])
                    ),
               $attributes['urlid']
             );
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('url','active',$attributes['urlid'],$attributes['active']);
    break;
    case 'del':
        db_del('url',$attributes['urlid']);
    break;
}
header('Location: index.php?page='.$page);
?>