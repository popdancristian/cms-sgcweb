<?php
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'tagid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr 
                       from '.DB_PREFIX.'tag
                       where domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSql('select *
                   from '.DB_PREFIX.'tag
                   where domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSqlSearch
(
     array
     (  
      'name'=> "name like '%".$o_dbgrid->GetSqlSearchParam('name')."%'",
      'total'=> "total > ".intVal($o_dbgrid->GetSqlSearchParam('total'))
     )
);


$o_dbgrid->SetSqlOrderBy(array('field'=>'total','type'=>'desc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'name','caption'=>_l('name'),'ordon'=>'title','th'=>array('align'=>'center','style'=>'width:80%;')),
    array('type'=>'text','field'=>'total','caption'=>_l('total'),'ordon'=>'total','th'=>array('align'=>'center','style'=>'width:80px;')),
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