<?php
if (!empty($attributes['linkid']))
{
   $str_action = 'mod';
   $a_data =  db_get('link',array('linkid'=>$attributes['linkid']));
   $a_data['position'] = explode('|',$a_data['position']);
}
else
{
   $str_action = 'add';
   $a_data = array('linkid'=>'','title'=>'','url'=>'http://','position'=>array(),'ordon'=>db_getNextOrdon('link',array('domainid'=>$_SESSION['domainid'])),'active'=>1);
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'linkid',
 'row'=>array
 (  
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','required'=>true),
  'url'=>array('caption'=>$_l['url'],'type'=>'textbox','required'=>true),
  'position'=>array('caption'=>$_l['position'],'type'=>'checkbox','a_value'=>$_POSITION),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'30'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
  ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>