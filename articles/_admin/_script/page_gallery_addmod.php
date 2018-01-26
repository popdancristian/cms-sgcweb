<?php
if (!empty($attributes['galleryid']))
{
   $str_action = 'mod';
   $a_data =  db_get('gallery',array('galleryid'=>$attributes['galleryid']));
   $a_domain_data = db_get('domain_gallery',array(),array('galleryid'=>$attributes['galleryid'],'domainid'=>$_SESSION['domainid']));
   $a_data['active'] = $a_domain_data[0]['active'];
   $a_data['home'] = $a_domain_data[0]['home'];
   $a_data['ordon'] = $a_domain_data[0]['ordon'];
}
else
{
   $i_categoryid = isset($a_search['a_param']['categoryid']) ? $a_search['a_param']['categoryid'] : 0;
   $str_action = 'add';
   $a_data = array('galleryid'=>'','categoryid'=>$i_categoryid,'title'=>'','ordon'=>db_getNextOrdon('domain_gallery',array('domainid'=>$_SESSION['domainid'])),'active'=>1,'home'=>1,'image'=>'');
}


//-- build some form vars
$a_category = db_get('category',array('orderby'=>'title'));
$a_category_option = array('0'=>$_l['uncategorized']);
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];

$a_row = array
(
  'categoryid'=>array('caption'=>$_l['category'],'type'=>'select','a_value'=>$a_category_option),
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox'),
  'image'=>array('caption'=>_l('image'),'type'=>'textbox'),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'50'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no'])),
  'home'=>array('caption'=>$_l['home'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
);

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'galleryid',
 'row'=>$a_row,
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form); 
?>