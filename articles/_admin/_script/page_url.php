<?php
//-- sitemap
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'urlid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr from '.DB_PREFIX.'url u');
$o_dbgrid->SetSql('select * from '.DB_PREFIX.'url u');
$o_dbgrid->SetSqlOrderBy(array('field'=>'name','type'=>'asc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'urlid','caption'=>_l('id'),'ordon'=>'urlid','th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'text','field'=>'name','caption'=>_l('name'),'ordon'=>'name','th'=>array('align'=>'center','style'=>'width:70%;')),
    array('type'=>'checkbox','field'=>'active','caption'=>_l('active'),'ordon'=>'active','align'=>'center','action'=>'active',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
	array('type'=>'link','name'=>_l('mod'),'action'=>'addmod','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:80px;'),'td'=>array('align'=>'center')),
	array(
	      'type'=>'link','name'=>_l('del'),'action'=>'del','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:80px;'),'td'=>array('align'=>'center'),
		  'param'=>array('submit'=>1),
		  'onclick'=>"return confirm('"._l('confirmdelete')."');"
		 )
   )
);

$a_grid = $o_dbgrid->Get();

//-- assign grid data
$o_smarty->assign("a_grid",$a_grid);
?>