<?php
if (!empty($attributes['adsenseid']))
{
   $str_action = 'mod';
   $a_data =  db_get('adsense',array('adsenseid'=>$attributes['adsenseid']));
   $a_data['position'] = explode('|',$a_data['position']);
}
else
{
   $str_action = 'add';
   $a_data = array('adsenseid'=>'','name'=>'','content'=>'','position'=>array(),'channel'=>'','ordon'=>db_getNextOrdon('adsense',array('domainid'=>$_SESSION['domainid'])),'active'=>1);
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'adsenseid',
 'row'=>array
 (  
  'name'=>array('caption'=>$_l['name'],'type'=>'textbox','required'=>true),
  'content'=>array('caption'=>$_l['content'],'type'=>'textarea','width'=>'100%','height'=>'150','required'=>true),
  'position'=>array('caption'=>$_l['position'],'type'=>'checkbox','a_value'=>$_POSITION),
  'channel'=>array('caption'=>$_l['channel'],'type'=>'textbox'),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'30'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
  ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>