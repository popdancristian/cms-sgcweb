<?php
switch ($attributes['action'])
{
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('article_comment','active',$attributes['article_commentid'],$attributes['active']);
    break;
    case 'del':
        db_del('article_comment',$attributes['article_commentid']);
    break;
    case 'publish':
}
$_SESSION['success'] = true;
header('Location: index.php?page='.$page.$a_search['str_param']);
?>