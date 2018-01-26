<?php
if (!empty($attributes['dbformid']))
{
   $str_action = 'mod';
   $a_data =  db_get('dbform',array('dbformid'=>$attributes['dbformid']));
   $attributes['table'] = $a_data['tablename'];
}
else
{
   $str_action = 'add';
   $a_data = array('dbformid'=>'','fieldname'=>'','title'=>'','fieldtype'=>'','fieldlength'=>'','formtype'=>'','ordon'=>db_getNextOrdon('dbform',array('tablename'=>$attributes['table'])),'active'=>1,'defaultvalue'=>'');
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'dbformid',
 'hidden' => array(array('name'=>'table','value'=>$attributes['table'])),
 'row'=>array
 (  
  'fieldname'=>array('caption'=>_l('fieldname'),'type'=>'textbox','required'=>true),
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','required'=>true),
  'fieldtype'=>array('caption'=>$_l['fieldtype'],'type'=>'select','required'=>true,'a_value'=>array('varchar'=>'varchar','int'=>'int','text'=>'text')),
  'fieldlength'=>array('caption'=>$_l['fieldlength'],'type'=>'textbox'),
  'formtype'=>array('caption'=>$_l['formtype'],'type'=>'select','required'=>true,'a_value'=>array('textbox'=>'textbox','textarea'=>'textarea','editor'=>'editor')),
  'defaultvalue'=>array('caption'=>_l('defaultvalue'),'type'=>'textbox'),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'30')
  ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>