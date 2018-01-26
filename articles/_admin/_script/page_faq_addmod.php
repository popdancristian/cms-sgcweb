<?php
$a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'faq'));
if (!empty($attributes['faqid']))
{
   $str_action = 'mod';
   $a_data =  db_get('faq',array('faqid'=>$attributes['faqid']));
   $a_domain_data = db_get('domain_faq',array(),array('faqid'=>$attributes['faqid'],'domainid'=>$_SESSION['domainid']));
   $a_data['active'] = $a_domain_data[0]['active'];
   $a_data['ordon'] = $a_domain_data[0]['ordon'];
}
else
{
   $str_action = 'add';
   $a_data = array('faqid'=>'','name'=>'','directory'=>'','description'=>'','content'=>'','tag'=>'','ordon'=>db_getNextOrdon('domain_faq',array('domainid'=>$_SESSION['domainid'])),'active'=>1);

}

//-- build some form vars
$a_category = db_get('category',array('orderby'=>'title'));
$a_category_option = array('0'=>$_l['uncategorized']);
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];

$a_row = array
(  
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','required'=>true),
  'description'=>array('caption'=>$_l['description'],'type'=>'textarea','width'=>'500','height'=>'80'),
  'content'=>array('caption'=>$_l['content'],'type'=>'editor','editor'=>html_getEditor('content',$a_data['content'],array('height'=>'150'))),
  'tag'=>array('caption'=>$_l['tag'],'type'=>'textarea','height'=>'40'),
  'categoryid'=>array('caption'=>$_l['category'],'type'=>'select','a_value'=>$a_category_option),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'50'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
);


//-- define and assign form data
$a_form = array
(
 'name'=>'frm'.ucfirst($str_action),
 'action'=>$str_action,
 'title'=>$_l[$str_action],
 'data'=>$a_data,
 'id'=>'faqid',
 'hidden' => array(array('name'=>'old_tag','value'=>$a_data['tag'])),
 'row'=>$a_row,
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form);

?>