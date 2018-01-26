<?php
include_once PATH_CLASS.DIR_SEP.'DbGrid.class.php';

$o_dbgrid = new DbGrid(array('page'=>$page,'name'=>'frmManage','title'=>_l('manage'),'action'=>'','id'=>'keywordid'));
$o_dbgrid->SetAttribute($attributes);
$o_dbgrid->SetSqlCount('select count(*) as nr 
                       from '.DB_PREFIX.'keyword k
					   left join '.DB_PREFIX.'category c on c.categoryid = k.categoryid
                       where k.domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSql('select k.*,
						  c.title as category
                   from '.DB_PREFIX.'keyword k
				   left join '.DB_PREFIX.'category c on c.categoryid = k.categoryid
                   where k.domainid = '.$_SESSION['domainid']);

$o_dbgrid->SetSqlSearch
(
     array
     (  
      'name'=> "name like '%".$o_dbgrid->GetSqlSearchParam('name')."%'",
	  'active'=> "active = ".intVal($o_dbgrid->GetSqlSearchParam('active')),
      'completed'=> "completed = ".intVal($o_dbgrid->GetSqlSearchParam('completed')),
      'total'=> "total > ".intVal($o_dbgrid->GetSqlSearchParam('total'))
     )
);


$o_dbgrid->SetSqlOrderBy(array('field'=>'total','type'=>'desc'));
$o_dbgrid->SetSqlLimit(DEFAULT_PAGE_LIMIT);
$o_dbgrid->setColumns
(
   array
   ( 
    array('type'=>'text','field'=>'name','caption'=>_l('name'),'ordon'=>'title','th'=>array('align'=>'center','style'=>'width:25%;')),
    array('type'=>'textbox','field'=>'alias','caption'=>_l('alias'),'ordon'=>'alias','th'=>array('align'=>'center','style'=>'width:25%;'),'action'=>'alias'),
    array('type'=>'text','field'=>'total','caption'=>_l('total'),'ordon'=>'total','th'=>array('align'=>'center','style'=>'width:80px;')),
	array('type'=>'text','field'=>'category','caption'=>_l('category'),'ordon'=>'category','th'=>array('align'=>'center','style'=>'width:120px;')),


    array('type'=>'checkbox','field'=>'active','caption'=>_l('active'),'ordon'=>'active','align'=>'center','action'=>'active',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
    array('type'=>'checkbox','field'=>'completed','caption'=>_l('completed'),'ordon'=>'completed','align'=>'center','action'=>'completed',
          'th'=>array('align'=>'center'),'td'=>array('align'=>'center')),
	array('type'=>'link','name'=>_l('mod'),'action'=>'addmod','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:70px;'),'td'=>array('align'=>'center')),
	array(
	      'type'=>'link','name'=>_l('del'),'action'=>'del','align'=>'center',
		  'th'=>array('align'=>'center','style'=>'width:70px;'),'td'=>array('align'=>'center'),
		  'param'=>array('submit'=>1),
		  'onclick'=>"return confirm('"._l('confirmdelete')."');"
		 )
   )
);

$a_grid = $o_dbgrid->Get();

//-- assign grid data
$o_smarty->assign("a_grid",$a_grid);

//-- define and assign form data
$a_form_import = array
(
 'name'=>'frmImportList',
 'action'=>'importlist',
 'title'=>$_l['import'],
 'data'=>array('keywordid'=>'','name'=>'','active'=>1),
 'id'=>'keywordid',
 'row'=>array
 (  
  'name'=>array('caption'=>$_l['name'],'type'=>'textarea','required'=>true,'height'=>150),
  'alias'=>array('caption'=>$_l['alias'],'type'=>'textbox','height'=>150),
  'active'=>array('caption'=>$_l['active'],'type'=>'radio','a_value'=>array('1'=>$_l['yes'],'0'=>$_l['no']))
 ),
 'button'=>$_l['import']
);

$o_smarty->assign("a_form_import",$a_form_import);
?>