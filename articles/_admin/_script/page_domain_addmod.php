<?php
if (!empty($attributes['domainid']))
{
   $str_action = 'mod';
   $a_data =  db_get('domain',array('domainid'=>$attributes['domainid']));
}
else
{
   $str_action = 'add';
   $a_default_domain = db_get('domain',array('domainid'=>DEFAULT_DOMAINID));
   $a_data = array('domainid'=>'','name'=>$a_default_domain['name'],'url'=>$a_default_domain['url'],'path'=>$a_default_domain['path'],'ordon'=>db_getNextOrdon('domain'));
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'domainid',
 'row'=>array
 (  
  'name'=>array('caption'=>$_l['name'],'type'=>'textbox','required'=>true),
  'url'=>array('caption'=>$_l['url'],'type'=>'textbox','required'=>true),
  'path'=>array('caption'=>$_l['path'],'type'=>'textbox','required'=>true),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'30')
 ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>