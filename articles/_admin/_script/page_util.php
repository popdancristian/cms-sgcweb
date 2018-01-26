<?php
//-- define and assign form data
$a_form_category = array
(
 'name'=>'frmGeneratecategoriesandarticlesrandom',
 'action'=>'generatecategoriesandarticlesrandom',
 'title'=>_l('generatecategoriesandarticlesrandom'),
 'data'=>array('category'=>10,'article'=>50,'unpublished'=>'ON'),
 'row'=>array
 (  
  'category'=>array('caption'=>$_l['category'],'type'=>'textbox','required'=>true),
  'article'=>array('caption'=>$_l['article'],'type'=>'textbox','required'=>true),
  'unpublished'=>array('caption'=>$_l['unpublished'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no']))
 ),
 'button'=>$_l['publish']
);
$o_smarty->assign("a_form_category",$a_form_category);

//-- check the existing sitemaps
$a_category = $o_db->getAssoc("SELECT c.categoryid,c.title from ".DB_PREFIX."category c
                               INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                               WHERE dc.active = 1 and dc.domainid=".$_SESSION['domainid']." ORDER BY title",'categoryid');

$a_category_option = array();
foreach ($a_category as $i_key=>$a_value) $a_category_option[$a_value['categoryid']] = $a_value['title'];

//-- define and assign form data
$a_form_category_article = array
(
 'name'=>'frmGeneratearticlesfromcategoryrandom',
 'action'=>'generatearticlesfromcategoryrandom',
 'title'=>_l('generatearticlesfromcategoryrandom'),
 'data'=>array('total'=>'50','unpublished'=>'ON'),
 'row'=>array
 (  
  'categoryid'=>array('caption'=>$_l['category'],'type'=>'select','a_value'=>$a_category_option),
  'total'=>array('caption'=>$_l['total'],'type'=>'textbox','required'=>true), 
  'unpublished'=>array('caption'=>$_l['unpublished'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no']))
 ),
 'button'=>$_l['publish']
);

$o_smarty->assign("a_form_category_article",$a_form_category_article);
$o_smarty->assign("i_total_category",count($a_category));


//-- define and assign form data
$a_form_article = array
(
 'name'=>'frmGeneratearticlesrandom',
 'action'=>'generatearticlesrandom',
 'title'=>_l('generatearticlesrandom'),
 'data'=>array('total'=>'100','unpublished'=>'ON'),
 'row'=>array
 (  
  'total'=>array('caption'=>$_l['total'],'type'=>'textbox','required'=>true), 
  'unpublished'=>array('caption'=>$_l['unpublished'],'type'=>'radio','a_value'=>array('ON'=>$_l['yes'],'OFF'=>$_l['no']))
 ),
 'button'=>$_l['publish']
);

$o_smarty->assign("a_form_article",$a_form_article);
?>