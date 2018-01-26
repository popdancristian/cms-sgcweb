<?php
$_SESSION['success'] = true;
$str_location = 'index.php?page='.$page;

switch ($attributes['action'])
{
    case 'del':
        db_del('tag',$attributes['tagid']);
    break;
}
header('Location: '.$str_location.$a_search['str_param']);
?>