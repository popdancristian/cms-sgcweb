<?php
$_SESSION['success'] = true;
$str_location = 'index.php?page='.$page;

switch ($attributes['action'])
{
    case 'add':
        $i_keywordid = db_add('keyword',array(
                                              'name'=>$attributes['name'],
                                              'alias'=>$attributes['alias'],
                                              'domainid'=>$_SESSION['domainid'],
                                              'active'=>intval($attributes['active']),
											  'categoryid'=>intval($attributes['categoryid'])
                                             )
                              );
    break;
    case 'mod':
       db_mod('keyword',array(
                              'name'=>$attributes['name'],
                              'alias'=>$attributes['alias'],
                              'active'=>intval($attributes['active']),
							  'categoryid'=>intval($attributes['categoryid'])
                             ),
               $attributes['keywordid']);
    break;
    case 'active':
        if (empty($attributes['active'])) $attributes['active'] = array();
        db_modFlag('keyword','active',$attributes['keywordid'],$attributes['active']);
    break;
    case 'completed':
        if (empty($attributes['completed'])) $attributes['completed'] = array();
        db_modFlag('keyword','completed',$attributes['keywordid'],$attributes['completed']);
    break;
    case 'del':
        db_del('keyword',$attributes['keywordid']);
    break;
    case 'result':        
        $a_keyword = db_get('keyword',array('keywordid'=>$attributes['keywordid']));
        $i_count_article = db_search_count('article',array(
                                                           'keyword'=>array($a_keyword['alias']),         
                                                           'active'=>1,
                                                           'publish'=>1,
                                                           'domainid'=>$a_keyword['domainid']
                                                          ));

       $o_db->query('UPDATE '.DB_PREFIX.'keyword SET result = '.$i_count_article.' WHERE keywordid = '.$attributes['keywordid']);    
      
    break;
    case 'importlist':        
         $a_name = explode("\r\n",$attributes['name']);        
         $a_name_import = array();
         $a_alias_import = array();
         for ($i=0;$i<count($a_name);$i++) 
         {
           $str_name = keyword_fixString($a_name[$i]);
           if (!empty($str_name)) 
           {
               $a_name_import[] = $str_name;
               if (!empty($attributes['alias']))  $a_alias_import[] = keyword_fixString($attributes['alias']);
               else $a_alias_import[] = $str_name;
           }
         }
         
         $a_import = db_import_list('keyword',array('name'),array('domainid'=>$_SESSION['domainid'],'name'=>$a_name_import,'alias'=>$a_alias_import));                 
    break;
    case 'alias':
        for ($i=0;$i<count($attributes['keywordid']);$i++)
        {
            db_mod('keyword',array('alias'=>$attributes['alias'][$i]),$attributes['keywordid'][$i]);
        }     
    break;
}
header('Location: '.$str_location.$a_search['str_param']);
?>