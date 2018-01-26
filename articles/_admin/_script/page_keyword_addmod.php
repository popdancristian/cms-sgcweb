<?php
if (!empty($attributes['keywordid']))
{
   $str_action = 'mod';
   $a_data =  db_get('keyword',array('keywordid'=>$attributes['keywordid']));
}
else
{
   $str_action = 'add';
   $a_data = array('keywordid'=>'','name'=>'','active'=>1,'categoryid'=>'');
}

//-- build some form vars
$a_category = db_get('category',array('orderby'=>'title'));
$a_category_option = array('0'=>$_l['uncategorized']);
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];

//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'keywordid',
 'row'=>array
 (  
  'name'=>array('caption'=>$_l['name'],'type'=>'textbox','required'=>true),
  'alias'=>array('caption'=>$_l['alias'],'type'=>'textbox','required'=>true),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no'])),
  'categoryid'=>array('caption'=>$_l['category'],'type'=>'select','a_value'=>$a_category_option)
 ),
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>