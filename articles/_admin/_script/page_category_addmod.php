<?php
$a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'category'));
if (!empty($attributes['categoryid']))
{
   $str_action = 'mod';
   $a_data =  db_get('category',array('categoryid'=>$attributes['categoryid']));
   $a_domain_data = db_get('domain_category',array(),array('categoryid'=>$attributes['categoryid'],'domainid'=>$_SESSION['domainid']));
   $a_data['active'] = $a_domain_data[0]['active'];
   $a_data['ordon'] = $a_domain_data[0]['ordon'];

}
else
{
   $str_action = 'add';
   $a_data = array('categoryid'=>'','name'=>'','directory'=>'','description'=>'','content'=>'','tag'=>'[config_title], [category_title]','ordon'=>db_getNextOrdon('domain_category',array('domainid'=>$_SESSION['domainid'])),'active'=>0);

    //-- add dinamic fields
   for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $a_dbform[$i]['defaultvalue'];
}

$a_row = array
(  
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','required'=>true),
  'directory'=>array('caption'=>_l('directory'),'type'=>'textbox','required'=>true),
  'description'=>array('caption'=>$_l['description'],'type'=>'textarea','width'=>'500','height'=>'80'),
  'content'=>array('caption'=>$_l['content'],'type'=>'editor','editor'=>html_getEditor('content',$a_data['content'],array('height'=>'150'))),
  'tag'=>array('caption'=>$_l['tag'],'type'=>'textarea','height'=>'40'),
  'image'=>array('caption'=>_l('image'),'type'=>'textbox','required'=>false),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'50'),
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
 'id'=>'categoryid',
 'hidden' => array(array('name'=>'old_tag','value'=>$a_data['tag'])),
 'row'=>$a_row,
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>