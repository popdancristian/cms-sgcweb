<?php
//-- init database class
include_once PATH_CLASS.'/Db.class.php';

//-- create the database connection
$o_db = new Db();

//-- GENERAL

/**
* \brief db_get
* get data from table
* @param $str_table table name
* @param $a_param extra sql params ['orderby','limit','field']
* @param $a_search search conditions ['key'=>'value']
*/

function db_get($str_table,$a_param,$a_search = array())
{
    global $o_db;
    $str_key = $str_table.'id';// primary key
    if (isset($a_param[$str_key])) 
    {
         $a_data = $o_db->GetRow("select * from ".DB_PREFIX.$str_table." WHERE ".$str_key."='".$a_param[$str_key]."'");
    }
    else
    {    
        //-- check order by param
        $str_orderby = (!empty($a_param['orderby'])) ? ' ORDER BY '.$a_param['orderby'] : '';
        
        //-- check limit param
        $str_limit = (!empty($a_param['limit'])) ? ' LIMIT '.$a_param['limit'] : '';
        
        //-- search
        $str_search = '';
        if (!empty($a_search)) 
        {
            $a_search_cond = array();
            foreach ($a_search as $str_key=>$str_value)
            {
                $a_search_cond[]=" $str_key = '".$str_value."'";
            }
            $str_search = ' WHERE '.implode(' AND ',$a_search_cond);
        }

        if (!empty($a_param['field'])) 
        {
            $a_data = $o_db->GetAssoc('select * from '.DB_PREFIX.$str_table.$str_search.$str_orderby.$str_limit,$a_param['field']);
        }
        else
        {   
             $a_data = $o_db->GetAll('select * from '.DB_PREFIX.$str_table.$str_search.$str_orderby.$str_limit);  
        }   
    }
   
    return $a_data;
}

function db_add($str_table,$a_data)
{
    global $o_db;
    
    $a_field = array();
    $a_value = array();
    foreach ($a_data as $str_key=>$str_value)
    {
        $a_field[] = $str_key;
        if (is_null($str_value)) $a_value[] = 'NULL';
        else $a_value[] = "'".trim($str_value)."'";
    }
    $o_db->query("insert ignore into ".DB_PREFIX.$str_table." (".implode(',',$a_field).") VALUES (".implode(',',$a_value).")");
    
    if ($o_db->isAffected()) return $o_db->insertId();
    else return 0;
}

function db_mod($str_table,$a_data,$id)
{
    global $o_db;
    
    $a_field_value = array();
    foreach ($a_data as $str_key=>$str_value) $a_field_value[] = $str_key." = '".trim($str_value)."'";

    $o_db->query("update ".DB_PREFIX.$str_table." SET ".implode(',',$a_field_value)." WHERE ".$str_table."id = '".$id."'");
}

function db_del($str_table,$id,$a_condition = array())
{
    global $o_db;
   
    if (!empty($id))
    {
        $a_ids = array();
        if (is_array($id)) for ($i=0;$i<count($id);$i++) $a_ids[] = intVal($id[$i]);
        else $a_ids = array(intVal($id));
        $str_condition = ' WHERE '.$str_table."id in (".implode(',',$a_ids).")";
    }
    else
    {
        if (!empty($a_condition)) 
        {
            $a_condition_cond = array();
            foreach ($a_condition as $str_key=>$str_value)
            {
                $a_condition_cond[]=" $str_key = '".$str_value."'";
            }
            $str_condition = ' WHERE '.implode(' AND ',$a_condition_cond);
        }
    }
    
    $o_db->query("delete from ".DB_PREFIX.$str_table.$str_condition);
}



function db_modFlag($str_table,$str_field,$a_id,$a_flag,$a_condition = array(),$str_pkey='')
{
    global $o_db;
    
    $str_condition = '';
    if (!empty($a_condition)) 
    {
        $a_condition_cond = array();
        foreach ($a_condition as $str_key=>$str_value)
        {
            $a_condition_cond[]=" $str_key = '".$str_value."'";
        }
        $str_condition = 'AND '.implode(' AND ',$a_condition_cond);
    }

    if (empty($str_pkey)) $str_pkey = $str_table."id";

    //-- deactivate all    
    $o_db->query("update ".DB_PREFIX.$str_table." SET $str_field = 0 WHERE ".$str_pkey." in (".implode(',',$a_id).") ".$str_condition);
    
    //-- activate from a_active 
    if (!empty($a_flag)) $o_db->query("update ".DB_PREFIX.$str_table." SET $str_field = 1 WHERE ".$str_pkey." in (".implode(',',$a_flag).") ".$str_condition);
}

function db_modFlagUnique($str_table,$str_field,$id)
{
    global $o_db;
    
    //-- deactivate all    
    $o_db->query("update ".DB_PREFIX.$str_table." SET $str_field = 0 WHERE ".$str_table."id<>$id");
  
    //-- activate unique flag 
    $o_db->query("update ".DB_PREFIX.$str_table." SET $str_field = 1 - $str_field WHERE ".$str_table."id=".intval($id));
}


function db_modOrdon($str_table,$a_id,$a_ordon,$a_condition = array(),$str_pkey='')
{
    global $o_db;

    $str_condition = '';
    if (!empty($a_condition)) 
    {
        $a_condition_cond = array();
        foreach ($a_condition as $str_key=>$str_value)
        {
            $a_condition_cond[]=" $str_key = '".$str_value."'";
        }
        $str_condition = 'AND '.implode(' AND ',$a_condition_cond);
    }

    if (empty($str_pkey)) $str_pkey = $str_table."id";

    for ($i=0;$i<count($a_id);$i++) 
    $o_db->query("update ".DB_PREFIX.$str_table." SET ordon = ".intVal($a_ordon[$i])." WHERE ".$str_pkey."='".intVal($a_id[$i])."' ".$str_condition);
}

function db_getNextOrdon($str_table,$a_condition = array())
{
    global $o_db;

    $str_condition = '';
    if (!empty($a_condition)) 
    {
        $a_condition_cond = array();
        foreach ($a_condition as $str_key=>$str_value)
        {
            $a_condition_cond[]=" $str_key = '".$str_value."'";
        }
        $str_condition = ' WHERE '.implode(' AND ',$a_condition_cond);
    }

    $i_ordon = $o_db->GetOne("select max(ordon) as ordon FROM ".DB_PREFIX.$str_table.$str_condition);
    if (empty($i_ordon)) $i_ordon = 1;
    else $i_ordon++;
    return $i_ordon;
}


function db_import_list($str_table,$a_import_field,$a_data)
{
    global $o_db;
    
    $a_result = array();
    for ($i=0;$i<count($a_data[$a_import_field[0]]);$i++)
    {
        $a_field = array();$a_value = array();
        foreach ($a_data as $str_key=>$str_value)
        {
            $a_field[] = $str_key;
            if (is_array($str_value))  $a_value[] = "'".$str_value[$i]."'";
            else $a_value[] = "'".$str_value."'";
        }
        $o_db->query("insert ignore into ".DB_PREFIX.$str_table." (".implode(',',$a_field).") VALUES (".implode(',',$a_value).")");
        if ($o_db->isAffected()) 
        {
            $a_result[] = $o_db->insertId();
        }
    }
    return $a_result;
}

function get_db_search_cond($str_table,$a_param)
{
    $str_search_cond = '';
    switch ($str_table)
    {
        case 'article':            
            foreach ($a_param as $str_key=>$str_value)
            {
                switch ($str_key)
                {
                    case 'categoryid':
                        $str_search_cond.= ' AND a.categoryid = '.intval($str_value);
                    break; 
                    case 'articleid':
                        $str_search_cond.= ' AND a.articleid = '.intval($str_value);
                    break; 
                    case 'active':
                        $str_search_cond.= ' AND dc.active = 1 AND da.active = '.intval($str_value);
                    break;
                    case 'publish':
                        $str_search_cond.= ' AND dc.active = 1 AND da.publish = '.intval($str_value);
                    break;
                    case 'keyword':
                        $a_cond = array();        
                        if (is_array($str_value)) $str_value = implode(' ',array_unique($str_value));
                       
                        $a_keyword = explode(' ',$str_value);
                        for ($i=0;$i<count($a_keyword);$i++)    
                        {
                            if (strlen($a_keyword[$i])>2) 
                            {
                                $a_cond[] = "a.title like '%".$a_keyword[$i]."%'";
                                $a_cond[] = "a.description like '%".$a_keyword[$i]."%'";
                                $a_cond[] = "a.content like '%".$a_keyword[$i]."%'";
                                $a_cond[] = "a.tag like '%".$a_keyword[$i]."%'";  
                                $a_cond[] = "c.title like '%".$a_keyword[$i]."%'";  
                            }
                        }
                        if (!empty($a_cond)) $str_search_cond.=' AND ('.implode(' OR ',$a_cond).') ';
                    break;
                    case 'tag':
                        $a_cond = array();
                        $a_tag = explode(' ',$str_value);
                        for ($i=0;$i<count($a_tag);$i++)    
                        {
                            if (strlen($a_tag[$i])>2) 
                            {
                                $a_cond[] = "a.tag like '%".$str_value."%'";                               
                            }
                        }
                        if (!empty($a_cond)) $str_search_cond.=' AND ('.implode(' OR ',$a_cond).') ';
                    break;
                }
                    
            } 
        break;
    }
    return $str_search_cond;
}

function db_search_count($str_table,$a_param)
{
    global $o_db;
    
    $i_count = 0;
    switch ($str_table)
    {
        case 'article':            
            //-- get search condition
            $str_search_cond = get_db_search_cond($str_table,$a_param);           
            
            //-- get the count
            $a_result = $o_db->GetRow('select count(*) as nr
                                       from '.DB_PREFIX.'article a 
                                       INNER JOIN '.DB_PREFIX.'domain_article da ON da.articleid = a.articleid
                                       INNER JOIN '.DB_PREFIX.'category c ON a.categoryid = c.categoryid
                                       INNER JOIN '.DB_PREFIX.'domain_category dc ON dc.categoryid = c.categoryid
                                       WHERE dc.domainid = '.$a_param['domainid'].' AND da.domainid = '.$a_param['domainid'].' '.$str_search_cond);

            $i_count = $a_result['nr'];
        break;       
    }         

    return $i_count;
}


function db_search($str_table,$a_param)
{
    global $o_db,$_CONFIG;

    $a_result = array();
    switch ($str_table)
    {
        case 'article':
            //-- check order by param
            $str_orderby = (!empty($a_param['orderby'])) ? ' ORDER BY '.$a_param['orderby'] : '';
            
            //-- check limit param
            if (!empty($a_param['limit']))
            {
                if (!empty($a_param['start'])) $str_limit = ' LIMIT '.abs(intval($a_param['start'])).','.$a_param['limit'];
                else $str_limit = ' LIMIT '.$a_param['limit'];
            }
            else $str_limit = '';
            
            //-- get search condition
            $str_search_cond = get_db_search_cond($str_table,$a_param);           

            $a_result = $o_db->GetAll('select a.*,
                                              da.*,
                                              c.title as category,
                                              c.directory as category_directory
                                       from '.DB_PREFIX.'article a 
                                       INNER JOIN '.DB_PREFIX.'domain_article da ON da.articleid = a.articleid
                                       INNER JOIN '.DB_PREFIX.'category c ON a.categoryid = c.categoryid
                                       INNER JOIN '.DB_PREFIX.'domain_category dc ON dc.categoryid = c.categoryid
                                       WHERE dc.domainid = '.$a_param['domainid'].' AND da.domainid = '.$a_param['domainid'].' '.$str_search_cond.$str_orderby.$str_limit);  
            
        break;

        case 'keyword':
            //-- check order by param
            $str_orderby = (!empty($a_param['orderby'])) ? ' ORDER BY '.$a_param['orderby'] : '';
        
            //-- check limit param
            $str_limit = (!empty($a_param['limit'])) ? ' LIMIT '.$a_param['limit'] : '';

            $str_search_cond = '';
            foreach ($a_param as $str_key=>$str_value)
            {
                switch ($str_key)
                {        
                    case 'active':
                        $str_search_cond.= ' AND active = '.intval($str_value);
                    break;                    
                    case 'letter':
                        $str_search_cond.= " AND lower(k.name) like '".strtolower($str_value)."%'";
                    break;
                    case 'keywordid':
                        if (is_array($str_value))
                        {
                            $str_temp = "'".intVal($str_value[0])."'";
                            for ($i=1;$i<count($str_value);$i++) $str_temp.=",'".intVal($str_value[$i])."'";
                            $str_search_cond.= " AND k.keywordid in ($str_temp)";
                        }
                    break; 
                }
                    
            }
            $a_result = $o_db->GetAll('select *
                                       from '.DB_PREFIX.'keyword k
                                       WHERE domainid = '.$a_param['domainid'].$str_search_cond.$str_orderby.$str_limit);
        break;

        case 'tag':
            //-- check order by param
            $str_orderby = (!empty($a_param['orderby'])) ? ' ORDER BY '.$a_param['orderby'] : '';
        
            //-- check limit param
            $str_limit = (!empty($a_param['limit'])) ? ' LIMIT '.$a_param['limit'] : '';

            $str_search_cond = '';
            foreach ($a_param as $str_key=>$str_value)
            {
                switch ($str_key)
                {        
                    case 'name':
                        if (is_array($str_value) and (!empty($str_value)))
                        {
                            $str_temp = "'".strtolower(trim($str_value[0]))."'";
                            for ($i=1;$i<count($str_value);$i++) $str_temp.=",'".trim(strtolower($str_value[$i]))."'";
                            $str_search_cond.= " AND lower(name) in ($str_temp)";
                        }
                    break; 
                    case 'total':
                        $str_search_cond.= " AND total > ".$str_value;
                    break; 
                }
                    
            }
            $a_result = $o_db->GetAll('select *
                                       from '.DB_PREFIX.'tag 
                                       WHERE domainid = '.$a_param['domainid'].$str_search_cond.$str_orderby.$str_limit);
        break;
    }         

    return $a_result;
}

//-- CONFIG
function getConfig($i_domainid)
{
    global $o_db;
    $a_result = $o_db->getAll('SELECT * FROM '.DB_PREFIX.'config where domainid = '.$i_domainid);

    $a_config = array();
    for ($i=0;$i<count($a_result);$i++) $a_config[$a_result[$i]['config_name']] = $a_result[$i]['config_value'];

    return $a_config;
}

function modConfig($a_config,$i_domainid)
{
    global $o_db;

    foreach ($a_config as $str_key=>$str_value)
    {
        $o_db->query("update ".DB_PREFIX."config set config_value = '".$str_value."' where domainid = ".$i_domainid." and config_name='".$str_key."'");       
    }    
}

function db_tagUpdate($str_new_tag,$str_old_tag = '')
{
    global $o_db;
    
    //-- get and trim the old tags
    if (!empty($str_old_tag))
    {
        $a_tag = explode(',',$str_old_tag);
        for ($i=0;$i<count($a_tag);$i++) $a_tag[$i] = trim($a_tag[$i]);
        for ($i=0;$i<count($a_tag);$i++) $o_db->query("UPDATE ".DB_PREFIX."tag SET total=total-1 WHERE name = '".$a_tag[$i]."'");
    }
    
    if (!empty($str_new_tag))
    {
        $a_result = array();
        //-- get and trim the tags
        $a_tag = explode(',',$str_new_tag);
                   
        $a_exiting_tag = array();    
        $a_result = db_get('tag',array('field'=>'tagid'));
        foreach ($a_result as $i_key=>$a_value) $a_exiting_tag[] = $a_value['name'];

        $a_inc_tag = array();
        $a_new_tag = array();
        
        for ($i=0;$i<count($a_tag);$i++) 
        {
            $a_tag[$i] = trim($a_tag[$i]);
            if (in_array($a_tag[$i],$a_exiting_tag)) $a_inc_tag[] = $a_tag[$i];
            else $a_new_tag[] = $a_tag[$i];
        }
        
        //-- insert new tags
        for ($i=0;$i<count($a_new_tag);$i++) $o_db->query("INSERT IGNORE INTO ".DB_PREFIX."tag (name,total) VALUES ('".$a_new_tag[$i]."',1)");
        //-- increase old tags
        for ($i=0;$i<count($a_inc_tag);$i++) $o_db->query("UPDATE ".DB_PREFIX."tag SET total=total+1 WHERE name = '".$a_inc_tag[$i]."'");
    }
}

function quote($str_string)
{
    if (1 == get_magic_quotes_gpc()) return $str_string;
    else return addslashes($str_string);
}

?>