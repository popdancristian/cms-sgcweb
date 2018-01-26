<?php
$a_dbform = db_get('dbform',array('orderby'=>'ordon'),array('tablename'=>'article'));
if (!empty($attributes['articleid']))
{
   $str_action = 'mod';
   $a_data =  db_get('article',array('articleid'=>$attributes['articleid']));
   $a_domain_data = db_get('domain_article',array(),array('articleid'=>$attributes['articleid'],'domainid'=>$_SESSION['domainid']));
   $a_data['active'] = $a_domain_data[0]['active'];
   $a_data['publish'] = $a_domain_data[0]['publish'];
   $a_data['ordon'] = $a_domain_data[0]['ordon'];
}
else
{
   $i_categoryid = isset($a_search['a_param']['categoryid']) ? $a_search['a_param']['categoryid'] : 0;
   $str_action = 'add';
   $a_data = array('articleid'=>'','categoryid'=>$i_categoryid,'title'=>'','description'=>'','content'=>'','swffile'=>'','image'=>'','tag'=>'','ordon'=>db_getNextOrdon('domain_article',array('domainid'=>$_SESSION['domainid'])),'active'=>1,'publish'=>1,'swfwidth'=>'800','swfheight'=>'600','script'=>'');
    
    //-- add dinamic fields
   for ($i=0;$i<count($a_dbform);$i++) $a_data[$a_dbform[$i]['fieldname']] = $a_dbform[$i]['defaultvalue'];
}


//-- build some form vars
$a_category = db_get('category',array('orderby'=>'title'));
$a_category_option = array('0'=>$_l['uncategorized']);
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];

$a_row = array
(
  'categoryid'=>array('caption'=>$_l['category'],'type'=>'select','a_value'=>$a_category_option),
  'title'=>array('caption'=>$_l['title'],'type'=>'textbox','required'=>true),
  'description'=>array('caption'=>_l('description'),'type'=>'textarea'),
  'content'=>array('caption'=>_l('content'),'type'=>'editor','editor'=>html_getEditor('content',$a_data['content'],array('height'=>'150'))),
  'tag'=>array('caption'=>$_l['tag'],'type'=>'textarea'),
  'swffile'=>array('caption'=>_l('file'),'type'=>'textbox'),
  'swfwidth'=>array('caption'=>_l('width'),'type'=>'textbox'),
  'swfheight'=>array('caption'=>_l('height'),'type'=>'textbox'),
  'image'=>array('caption'=>_l('image'),'type'=>'textbox'),
  'script'=>array('caption'=>_l('script'),'type'=>'textarea'),
  'ordon'=>array('caption'=>$_l['ordon'],'type'=>'textbox','width'=>'50'),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no'])),
  'publish'=>array('caption'=>$_l['publish'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
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
 'id'=>'articleid',
 'hidden' => array(array('name'=>'old_tag','value'=>$a_data['tag']),array('name'=>'old_publish','value'=>$a_data['publish'])),
 'row'=>$a_row,
 'button'=>$_l[$str_action]
);

$o_smarty->assign("a_form",$a_form); 
?>