<?php
$a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'page'));
if (!empty($attributes['pageid']))
{
   $str_action = 'mod';
   $a_data =  db_get('page',array('pageid'=>$attributes['pageid']));
   $a_domain_data = db_get('domain_page',array(),array('pageid'=>$attributes['pageid'],'domainid'=>$_SESSION['domainid']));
   
   $a_data['menus'] = explode('|',$a_domain_data[0]['menus']);
   $a_data['active'] = $a_domain_data[0]['active'];
   $a_data['ordon'] = $a_domain_data[0]['ordon'];
}
else
{
   $str_action = 'add';
   $a_data = array('name'=>'','template'=>'default','menu'=>'','title'=>'','description'=>'','tag'=>'','menus'=>array(),'content'=>'','ordon'=>db_getNextOrdon('domain_page',array('domainid'=>$_SESSION['domainid'])),'active'=>1);

   //-- add dinamic fields
   for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $a_dbform[$i]['defaultvalue'];
}

$a_row = array
(
  'name'=>array('caption'=>$_l['name'],'type'=>'textbox','maxlength'=>255,'required'=>true),
  'template'=>array('caption'=>_l('template'),'type'=>'textbox','maxlength'=>255,'required'=>true),
  'menu'=>array('caption'=>_l('menu'),'type'=>'textbox','maxlength'=>255,'required'=>true),
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','maxlength'=>255,'tips'=>_l('meta')),
  'description'=>array('caption'=>$_l['description'],'type'=>'textarea','tips'=>_l('meta')),
  'tag'=>array('caption'=>$_l['tags'],'type'=>'textarea','tips'=>_l('meta')),
  'menus'=>array('caption'=>$_l['menus'],'type'=>'checkbox','a_value'=>$_POSITION),
  'content'=>array('caption'=>$_l['content'],'type'=>'editor','editor'=>html_getEditor('content',$a_data['content'],array('height'=>'200'))),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'30'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
);

//-- add dinamic fields
for ($i=0;$i<count($a_dbform);$i++) 
{
    if ($a_dbform[$i]['formtype'] == 'editor') $a_row[$a_dbform[$i]['fieldname']] = array('caption'=>$a_dbform[$i]['title'],'type'=>$a_dbform[$i]['formtype'],'editor'=>html_getEditor($a_dbform[$i]['fieldname'],$a_data[$a_dbform[$i]['fieldname']],array('height'=>'150')));
    else $a_row[$a_dbform[$i]['fieldname']] = array('caption'=>$a_dbform[$i]['title'],'type'=>$a_dbform[$i]['formtype']);
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'pageid',
 'hidden' => array(array('name'=>'old_tag','value'=>$a_data['tag'])),
 'row'=>$a_row,
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>