<?php
switch ($attributes['action'])
{
    case 'add':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_add('adsense',
               array(
                     'domainid'=>$_SESSION['domainid'],
                     'name'=>quote($attributes['name']),
                     'content'=>quote($attributes['content']),
                     'position'=>$attributes['position'],
                     'channel'=>quote($attributes['channel']),
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active'])
                    )
             );
    break;
    case 'mod':
        $attributes['position'] = isset($attributes['position']) ? implode('|',$attributes['position']) : '';
        db_mod('adsense',
               array(
                     'name'=>quote($attributes['name']),
                     'content'=>quote($attributes['content']),
                     'position'=>$attributes['position'],
                     'channel'=>quote($attributes['channel']),
                     'ordon'=>intval($attributes['ordon']),
                     'active'=>intval($attributes['active'])
                    ),
               $attributes['adsenseid']
             );
    break;
    case 'ordon':
        db_modOrdon('adsense',$attributes['adsenseid'],$attributes['ordon']);
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('adsense','active',$attributes['adsenseid'],$attributes['active']);
    break;
    case 'del':
        db_del('adsense',$attributes['adsenseid']);
    break;
}
header('Location: index.php?page='.$page);
?>