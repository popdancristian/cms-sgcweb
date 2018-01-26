<?php
$a_result = $o_db->getAll("SELECT * from ".DB_PREFIX."lang WHERE domainid = ".$_SESSION['domainid']);
$a_row = array();
$a_lang = array();
for ($i=0;$i<count($a_result);$i++) 
{
    $a_row['l_'.$a_result[$i]['lang_name']] = array('caption'=>$a_result[$i]['lang_name'],'type'=>'textbox','required'=>true);
    $a_lang['l_'.$a_result[$i]['lang_name']] = $a_result[$i]['lang_value'];
}

//-- define and assign form data
$a_form = array
(
 'name'=>'frmManage',
 'action'=>'mod',
 'title'=>$_l['manage'],
 'data'=>$a_lang,
 'row'=>$a_row,
 'button'=>$_l['update']
);

$o_smarty->assign("a_form",$a_form);
?>