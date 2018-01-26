<?php
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'categoryid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr 
                        from '.DB_PREFIX.'category c
                        inner join '.DB_PREFIX.'domain_category dc ON dc.categoryid = c.categoryid
                        where dc.domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSql('select c.*,
                          dc.active,
						  dc.home,
                          dc.ordon,
                          dc.total
                   from '.DB_PREFIX.'category c
                   inner join '.DB_PREFIX.'domain_category dc ON dc.categoryid = c.categoryid
                   where domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSqlSearch
(
     array
     (  
      'title'=> "c.title like '%".$o_dbgrid->GetSqlSearchParam('title')."%'",
	  'active'=> "dc.active = ".intVal($o_dbgrid->GetSqlSearchParam('active')),
	  'home'=> "dc.home = ".intVal($o_dbgrid->GetSqlSearchParam('home')),
      'categoryid'=> "c.categoryid = ".intVal($o_dbgrid->GetSqlSearchParam('categoryid'))
     )
);

$o_dbgrid->SetSqlOrderBy(array('field'=>'ordon','type'=>'asc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'categoryid','caption'=>_l('id'),'ordon'=>'categoryid','th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'text','field'=>'title','caption'=>_l('title'),'ordon'=>'title','th'=>array('align'=>'center','style'=>'width:50%;')),
    array('type'=>'text','field'=>'total','caption'=>_l('total'),'ordon'=>'total','th'=>array('align'=>'center','style'=>'width:60px;')),
    array('type'=>'checkbox','field'=>'active','caption'=>_l('active'),'ordon'=>'active','align'=>'center','action'=>'active',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
	array('type'=>'checkbox','field'=>'home','caption'=>_l('home'),'ordon'=>'home','align'=>'center','action'=>'home',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
    array('type'=>'textbox','field'=>'ordon','caption'=>_l('ordon'),'ordon'=>'ordon','align'=>'center','action'=>'ordon',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center'),'textbox'=>array('style'=>'width:50px;')),
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