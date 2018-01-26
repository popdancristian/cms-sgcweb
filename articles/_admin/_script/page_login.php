<?php
//-- define and assign form data
$a_form = array
(
 'name'=>'frmLogin',
 'action'=>'login',
 'actionscript'=>'login.php',
 'title'=>$_l['login'],
 'row'=>array
 (  
  'username'=>array('caption'=>$_l['username'],'type'=>'textbox','required'=>true,'width'=>'150'),
  'password'=>array('caption'=>$_l['password'],'type'=>'password','required'=>true,'width'=>'150'),
 ),
 'button'=>$_l['login']
);

$o_smarty->assign("a_form",$a_form);
?>