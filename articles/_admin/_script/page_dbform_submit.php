<?php
$_SESSION['success'] = true;
$str_location = 'index.php?page='.$page.'&table='.$attributes['table'];
switch ($attributes['action'])
{
    case 'add':
        $str_length = (empty($attributes['fieldlength']) or ($attributes['fieldtype'] == 'text')) ? '' : '('.$attributes['fieldlength'].')';
        $str_default = (empty($attributes['defaultvalue']) or ($attributes['fieldtype'] == 'text')) ? '' : " DEFAULT '".$attributes['defaultvalue']."'";
       
        $o_db->query('ALTER TABLE '.DB_PREFIX.$attributes['table'].' ADD COLUMN '.$attributes['fieldname'].' '.$attributes['fieldtype'].$str_length.$str_default);

        $i_dbformid = db_add('dbform',array(
                                              'tablename'=>$attributes['table'],
                                              'fieldname '=>$attributes['fieldname'],
                                              'title '=>$attributes['title'],
                                              'fieldtype '=>$attributes['fieldtype'],
                                              'fieldlength'=>intval($attributes['fieldlength']),
                                              'formtype '=>$attributes['formtype'],
                                              'defaultvalue '=>$attributes['defaultvalue'],
                                              'ordon '=>intval($attributes['ordon'])
                                            )
                                  );
    break;
    case 'mod':
       $a_dbform = db_get('dbform',array('dbformid' => $attributes['dbformid'])); 

       $str_length = (empty($attributes['fieldlength']) or ($attributes['fieldtype'] == 'text')) ? '' : '('.$attributes['fieldlength'].')';
       $str_default = (empty($attributes['defaultvalue']) or ($attributes['fieldtype'] == 'text')) ? '' : " DEFAULT '".$attributes['defaultvalue']."'";
    
       $o_db->query('ALTER TABLE '.DB_PREFIX.$a_dbform['tablename'].' CHANGE '.$a_dbform['fieldname'].' '.$attributes['fieldname'].' '.$attributes['fieldtype'].$str_length.$str_default);

       db_mod('dbform',array(
                              'fieldname '=>$attributes['fieldname'],
                              'title '=>$attributes['title'],
                              'fieldtype '=>$attributes['fieldtype'],
                              'fieldlength'=>intval($attributes['fieldlength']),
                              'formtype '=>$attributes['formtype'],
                              'defaultvalue '=>$attributes['defaultvalue'],
                              'ordon '=>intval($attributes['ordon'])
                             ),
        $attributes['dbformid']);
    break;
    case 'ordon':
        db_modOrdon('dbform',$attributes['dbformid'],$attributes['ordon']);
    break;
    case 'del':        
        $a_dbform = db_get('dbform',array('dbformid' => $attributes['dbformid']));        
        $o_db->query('ALTER TABLE '.DB_PREFIX.$a_dbform['tablename'].' DROP COLUMN '.$a_dbform['fieldname']);
        db_del('dbform',$attributes['dbformid']);
    break;
}
header('Location: '.$str_location.$a_search['str_param']);
?>