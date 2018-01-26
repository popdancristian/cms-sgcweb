<?php
class DbGrid
{
    var $a_info          = array();
    var $a_column        = array();
    var $a_attribute     = array();//-- array with the attributes
    
    var $str_sql_count   = '';
    var $str_sql         = '';
    var $a_sql_search    = array();
	var $a_hidden		 = array();

    var $i_count         = 0;
    var $a_data          = array();

    var $i_start         = 0;
    var $i_sql_limit     = 0;

    var $a_sql_order_by  = '';
    
    function DbGrid($a_info) 
    {
        $this->a_info = $a_info;
    }

    function SetAttribute($a_attribute) {$this->a_attribute = $a_attribute;}
    
    /**
     * \brief function SetSqlCount
     * set sql for count
     */
    function SetSqlCount($str_sql_count)
    {
        $this->str_sql_count = $str_sql_count;
    }

    /**
     * \brief function GetSqlCount
     * get sql for count
     */
    function GetSqlCount()
    {
        return $this->str_sql_count;
    }
    
    /**
     * \brief function SetSql
     * set sql
     */
    function SetSql($str_sql)
    {
        $this->str_sql = $str_sql;
    }

    /**
     * \brief function GetSql
     * set sql
     */
    function GetSql()
    {
        return $this->str_sql;
    }
    
    /**
     * \brief function SetSqlSearch
     * set sql for search
     */
    function SetSqlSearch($a_sql_search)
    {
        $this->a_sql_search = $a_sql_search;
    }

    /**
     * \brief function GetSqlSearch
     * set sql for search
     */
    function GetSqlSearch()
    {
        return $this->a_sql_search;
    }

    function GetSqlSearchParam($str_param)
    {
        if (isset($this->a_attribute['search'][$str_param])) return $this->a_attribute['search'][$str_param];
    }

    function SetSqlOrderBy($a_sql_order_by)
    {
        $this->a_sql_order_by = $a_sql_order_by;
    }
    function SetSqlLimit($i_sql_limit)
    {
        $this->i_sql_limit = $i_sql_limit;
    }      

    function getData()
    {        
        if (empty($this->a_data))
        {
            global $o_db;    

            //-- build search sql
            $str_sql_search = '';
            if (!empty($this->a_attribute['search']))
            {
                $a_result = array();
                foreach ($this->a_attribute['search'] as $str_key=>$str_value)
                {
                    if (isset($this->a_sql_search[$str_key]) and ($str_value!='')) $a_result[] = $this->a_sql_search[$str_key];
                }
                if (!empty($a_result)) $str_sql_search = ' AND '.implode(' AND ',$a_result);
            }
            
            //-- build limit sql and count if the limit is not empty
            $str_limit_sql = '';
            if (!empty($this->i_sql_limit))
            {
                //-- get count
                $this->i_count = $o_db->GetOne($this->GetSqlCount().$str_sql_search);//-- get count

                $this->i_start = isset($this->a_attribute['search']['_start_']) ? abs(intval($this->a_attribute['search']['_start_'])) : 1;
                if (($this->i_start<0) or ($this->i_start>ceil($this->i_count/$this->i_sql_limit))) $this->i_start = 1;
                $str_limit_sql = ' LIMIT '.(($this->i_start-1)*$this->i_sql_limit).', '.$this->i_sql_limit;
            }

            //-- build order by sql
            $str_order_by_sql = '';
            if (isset($this->a_attribute['search']['_orderby_']))
            {
                $a_order_by = explode('|',$this->a_attribute['search']['_orderby_']);
                $this->a_sql_order_by = array('field'=>$a_order_by[0],'type'=>$a_order_by[1]);
            }
            if (!empty($this->a_sql_order_by)) $str_order_by_sql=' order by '.$this->a_sql_order_by['field'].' '.$this->a_sql_order_by['type'];
            
            //-- get data
            $this->a_data  = $o_db->GetAll($this->GetSql().$str_sql_search.$str_order_by_sql.$str_limit_sql);//-- get data

            //-- if the limit not exits set count
            if (empty($this->i_sql_limit)) $this->i_count = count($this->a_data);
        }
        return $this->a_data;
    }

    function SetColumns($a_column)
    {
        $this->a_column = $a_column;
    }
    function GetColumns()
    {
        return $this->a_column;
    }
	function SetHidden($a_hidden)
    {
        $this->a_hidden = $a_hidden;
    }
	function GetHidden()
    {
        return $this->a_hidden;
    }
    function Get()
    {                       
        $a_grid = array
        (
            'name'=>$this->a_info['name'],
			'page'=>$this->a_info['page'],
            'action'=>$this->a_info['action'],
            'id'=>$this->a_info['id'],
            'data'=>$this->getData(),
            'title'=>$this->a_info['title'],
            'a_navigator'=>$this->getNavigator(),
            'start'=>$this->getStart(),
            'order'=>$this->getOrder(),
            'order_link'=>$this->buildOrderByUrl(),
            'column'=>$this->GetColumns(),
			'a_hidden'=>$this->GetHidden(),
            'count'=>$this->getCount()
        );
        return $a_grid;
    }

    function getCount()    {return $this->i_count;}
    function getStart()    {return $this->i_start;}
    function getOrder()    {return $this->a_sql_order_by;}
    function getSqlLimit() {return $this->i_sql_limit;}  
   
    /**
     * Create text navigation	
     * @param integer $offset
     * @return string
     **/
    function getNavigator()
    {    
        $total   = $this->getCount();
        $perpage = $this->getSqlLimit();
        $current = $this->getStart();

        $a_result = array();
        if ( $total <= $perpage ) {return $a_result;}

        $i = 0;
        $total_pages = ceil($total / $perpage);
        if ($total_pages > 1 )
        {
            $prev = $current - 1;
            if ( $prev >= 1 ) 
            {         
                $a_result[$i]['title'] = "&laquo;";
                if ($prev==1) 
                {
                    $a_result[$i]['url'] = $this->buildNavigatorUrl();
                }
                else 
                {
                    $a_result[$i]['url'] = $this->buildNavigatorUrl(array('start'=>$prev));
                }
                $i++;
            }
            
            $i_start = 1;
            $i_end   = $total_pages;
            if ($total_pages>DEFAULT_PAGE_COUNT)
            {                 
                $i_middle = intVal(DEFAULT_PAGE_COUNT / 2);               
                if ($current>$i_middle) $i_start = $current - $i_middle;
                if ($current<($total_pages - $i_middle)) $i_end = $current + $i_middle;
            }         

            while ( $i_start <= $i_end ) 
            {
                $a_result[$i]['title'] = $i_start;
                if ($i_start==1) 
                {
                    $a_result[$i]['url'] = $this->buildNavigatorUrl();
                }
                else 
                {
                    $a_result[$i]['url'] = $this->buildNavigatorUrl(array('start'=>$i_start));
                }
                $i++;
                $i_start++;
            }

            $next = $current + 1;
            if ( $total_pages >= $next ) 
            {
                $a_result[$i]['title'] = "&raquo;";
                $a_result[$i]['url'] = $this->buildNavigatorUrl(array('start'=>$next));
            }
        }
        
      
        return $a_result;
    }

    function buildNavigatorUrl($a_param = array())
    {
        $str_url = 'index.php?page='.$this->a_info['page'];

		$a_hidden = $this->GetHidden();
		foreach ($a_hidden as $str_key=>$str_value) $str_url.='&'.$str_key.'='.$str_value;

        if (!empty($this->a_attribute['search']))
        {
            foreach ($this->a_attribute['search'] as $str_key=>$str_value) 
            {
                if (!in_array($str_key,array('_start_','_orderby_'))) $str_url.="&search[$str_key]=$str_value";
            }
        }
        if (isset($a_param['start']))   $str_url.='&search[_start_]='.$a_param['start'];
        $a_sql_order_by = $this->getOrder();
        if (!empty($a_sql_order_by)) $str_url.='&search[_orderby_]='.implode('|',$a_sql_order_by);       
        return $str_url;
    }
    function buildOrderByUrl()
    {
        $str_url = 'index.php?page='.$this->a_info['page'];

		$a_hidden = $this->GetHidden();
		foreach ($a_hidden as $str_key=>$str_value) $str_url.='&'.$str_key.'='.$str_value;

        if (!empty($this->a_attribute['search']))
        {
            foreach ($this->a_attribute['search'] as $str_key=>$str_value) 
            {
                if (!in_array($str_key,array('_orderby_'))) $str_url.="&search[$str_key]=$str_value";
            }
        }
        return $str_url;
    }       
}
?>