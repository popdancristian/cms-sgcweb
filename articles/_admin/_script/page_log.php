<?php
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'logid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr from '.DB_PREFIX.'log where domainid = '.$_SESSION['domainid']);
$o_dbgrid->SetSql('select * from '.DB_PREFIX.'log where domainid = '.$_SESSION['domainid']);
$o_dbgrid->SetSqlOrderBy(array('field'=>'dateadd','type'=>'desc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'dateadd','caption'=>_l('dateadd'),'ordon'=>'dateadd','th'=>array('align'=>'center','style'=>'width:100px;')),
    array('type'=>'text','field'=>'content','caption'=>_l('content'),'ordon'=>'name','th'=>array('align'=>'center','style'=>'width:85%;'))
   )
);

$a_grid = $o_dbgrid->Get();

//-- assign grid data
$o_smarty->assign("a_grid",$a_grid);
?>