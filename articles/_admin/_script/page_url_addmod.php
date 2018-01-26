<?php
if (!empty($attributes['urlid']))
{
   $str_action = 'mod';
   $a_data =  db_get('url',array('urlid'=>$attributes['urlid']));
}
else
{
   $str_action = 'add';
   $a_data = array('urlid'=>'','name'=>'','active'=>1);
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'urlid',
 'row'=>array
 (  
  'name'=>array('caption'=>$_l['name'],'type'=>'textbox','required'=>true),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
  ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>