<?php
if (!empty($attributes['scriptid']))
{
   $str_action = 'mod';
   $a_data =  db_get('script',array('scriptid'=>$attributes['scriptid']));
   $a_data['position'] = explode('|',$a_data['position']);
}
else
{
   $str_action = 'add';
   $a_data = array('scriptid'=>'','name'=>'','content'=>'','position'=>array(),'ordon'=>db_getNextOrdon('script',array('domainid'=>$_SESSION['domainid'])),'active'=>1);
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'scriptid',
 'row'=>array
 (  
  'name'=>array('caption'=>$_l['name'],'type'=>'textbox','required'=>true),
  'content'=>array('caption'=>$_l['content'],'type'=>'textarea','height'=>'150','required'=>true),
  'position'=>array('caption'=>$_l['position'],'type'=>'checkbox','a_value'=>$_POSITION),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'30'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
  ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>