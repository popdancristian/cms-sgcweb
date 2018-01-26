<?php
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'article_commentid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr from '.DB_PREFIX.'article_comment ac where domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSql('select * from '.DB_PREFIX.'article_comment where domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSqlSearch
(
     array
     (  
	  'active'=> "active = ".intVal($o_dbgrid->GetSqlSearchParam('active'))
     )
);

$o_dbgrid->SetSqlOrderBy(array('field'=>'dateadd','type'=>'desc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'articleid','caption'=>_l('id'),'ordon'=>'articleid','th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'text','field'=>'name','caption'=>_l('name'),'ordon'=>'name','th'=>array('align'=>'center','style'=>'width:150px;')),
    array('type'=>'text','field'=>'dateadd','caption'=>_l('dateadd'),'ordon'=>'dateadd','th'=>array('align'=>'center','style'=>'width:100px;')),
    array('type'=>'text','field'=>'comment','caption'=>_l('comment'),'ordon'=>'comment','th'=>array('align'=>'center','style'=>'width:50%;')),
    array('type'=>'text','field'=>'ip','caption'=>_l('ip'),'ordon'=>'ip','th'=>array('align'=>'center','style'=>'width:80px;')),
    array('type'=>'checkbox','field'=>'active','caption'=>_l('active'),'ordon'=>'active','align'=>'center','action'=>'active',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
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