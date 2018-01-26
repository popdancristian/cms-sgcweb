<?php
if (!isset($attributes['table'])) $attributes['table'] = 'page';

include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManageForm','title'=>_l($attributes['table']),'action'=>'','id'=>'dbformid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount("select count(*) as nr from ".DB_PREFIX."dbform where tablename = '".$attributes['table']."'");
$o_dbgrid->SetSql("select * from ".DB_PREFIX."dbform where tablename = '".$attributes['table']."'");
$o_dbgrid->SetSqlOrderBy(array('field'=>'ordon','type'=>'asc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setHidden(array('table'=>$attributes['table']));
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'title','caption'=>_l('title'),'ordon'=>'title','th'=>array('align'=>'center','style'=>'width:35%;')),
    array('type'=>'text','field'=>'fieldname','caption'=>_l('fieldname'),'ordon'=>'fieldname','th'=>array('align'=>'center','style'=>'width:120px;')),
    array('type'=>'text','field'=>'fieldtype','caption'=>_l('fieldtype'),'ordon'=>'fieldtype','th'=>array('align'=>'center','style'=>'width:120px;')),
    array('type'=>'text','field'=>'fieldlength','caption'=>_l('fieldlength'),'ordon'=>'fieldlength','th'=>array('align'=>'center','style'=>'width:60px;')),    
    array('type'=>'text','field'=>'formtype','caption'=>_l('formtype'),'ordon'=>'formtype','th'=>array('align'=>'center','style'=>'width:120px;')),
    array('type'=>'textbox','field'=>'ordon','caption'=>_l('ordon'),'ordon'=>'ordon','align'=>'center','action'=>'ordon',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center'),'textbox'=>array('style'=>'width:50px;')),
	array('type'=>'link','name'=>_l('mod'),'action'=>'addmod','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:80px;'),'td'=>array('align'=>'center')),
	array(
	      'type'=>'link','name'=>_l('del'),'action'=>'del','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:80px;'),'td'=>array('align'=>'center'),
		  'param'=>array('submit'=>1,'table'=>$attributes['table']),
		  'onclick'=>"return confirm('"._l('confirmdelete')."');"
		 )
   )
);

$a_grid = $o_dbgrid->Get();

//-- assign grid data
$o_smarty->assign("a_grid",$a_grid);
$o_smarty->assign("table",$attributes['table']);

?>