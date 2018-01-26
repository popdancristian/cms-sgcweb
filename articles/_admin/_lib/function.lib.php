<?php
function config_titleSeparator()
{
    global $_CONFIG;
    if (!empty($_CONFIG['title_separator'])) return ' '.$_CONFIG['title_separator'].' ';
    return ' ';
}

function html_getEditor($str_field,$str_value,$a_param = array())
{
    //-- include editor
    include_once PATH_CLASS.'/fckeditor/fckeditor.php';
        
    if (empty($a_param['width'])) $width = '100%';
    else $width = $a_param['width'];
    if (empty($a_param['height'])) $height = '300';
    else $height = $a_param['height'];

    $oFCKeditor = new FCKeditor($str_field) ;
    $oFCKeditor->BasePath	= URL_SITE.'/_class/fckeditor/';
    $oFCKeditor->Value		= $str_value ;
    $oFCKeditor->Width      = $width;
    $oFCKeditor->Height     = $height;

    return $oFCKeditor->CreateHtml();
}

function page_getHomeName($a_page)
{
    foreach ($a_page as $str_key=>$a_value) if ($a_value['home'] == 1) return $a_value['name'];
    return PAGE_DEFAULT;
}
//-- build search param from attributes
function search_buildParam($attributes)
{
    $a_result = array('a_param'=>array(),'str_param'=>'');
    if (!empty($attributes['search']))
    {
        foreach ($attributes['search'] as $str_key=>$str_value) 
        {
            if ($str_value!='') 
            {
                $a_result['a_param'][$str_key] = $str_value;
                $a_result['str_param'].="&search[$str_key]=$str_value";
            }
        }    
    }
    return $a_result;
}

function keyword_fixString($str_string)
{
	$search_key = trim($str_string);
	$search_key = str_replace("\\'","",$search_key);
	$search_key = str_replace('\\"',"",$search_key);
    $search_key = str_replace('\\',"",$search_key);
	$search_key = str_replace('+',' ',$search_key);
	$search_key = str_replace('~',' ',$search_key);
	$search_key = str_replace(' ','+',$search_key);
	
	//-- array unique
	$a_search_key = explode('+',$search_key);
	$a_result = array_unique($a_search_key);
	
	return implode(' ',$a_result);
}

function tag_fixString($str_string)
{
    $a_string = explode(',',$str_string);

    $a_result = array();
    $k = 0;
    for ($i=0;$i<count($a_string);$i++) 
    {
       if (trim($a_string[$i])!='')
       {      
         $a_result[$k] = keyword_fixString($a_string[$i]);
         $k++;
       }
    }
    
    return implode(', ',$a_result);
}

function tag_buildCloud($a_tag_cloud)
{
    //-- get the tags
    $a_tag = db_search('tag',array('orderby'=>'total desc','active'=>1,'name'=>$a_tag_cloud));
    $a_tag = buildRewriteEngineUrl($a_tag,'tag',array('tagid','name'),'url');//-- fix rewrite engine url
    shuffle($a_tag);
    return $a_tag;
}

function page_fixName($str_string)
{
    return strtolower(str_replace(' ','-',keyword_fixString($str_string)));
}

function page_error404()
{
   header('Location: '.URL_SITE.'/error.html');
}

function page_getLetter($str_type)
{
    $a_letter = array();
    for ($i=48;$i<58;$i++) $a_letter[] = chr($i);
    for ($i=65;$i<91;$i++) $a_letter[] = chr($i);
    
    $a_result = array();
    for ($i=0;$i<count($a_letter);$i++)
    {
        $a_result[$i]['name'] = $a_letter[$i];
        $a_result[$i]['url']  = getRewriteEngineUrl($str_type,array('letter'=>strtolower($a_letter[$i])));
    }
    return $a_result;
}

function keword_removeSiteKeyword($a_source,$str_field,$str_field_new)
{
    global $_CONFIG;
    $a_keyword = explode(', ',$_CONFIG['site_keyword']);
    if (!empty($a_keyword))
    {
        foreach ($a_source as $i_key=>$a_value) 
        {
            $str_new_value = strtolower($a_value[$str_field]);
            for ($i=0;$i<count($a_keyword);$i++) 
            {
                $str_new_value = str_replace(strtolower(trim($a_keyword[$i])).' ','',trim($str_new_value));
                $str_new_value = str_replace(' '.strtolower(trim($a_keyword[$i])),'',trim($str_new_value));
            }
            if (!empty($str_new_value))  $a_source[$i_key][$str_field_new] = $str_new_value;
            else $a_source[$i_key][$str_field_new] = $a_value[$str_field];
        }
    }    
    return $a_source;
}

function adsense_isIgnore()
{
    global $_CONFIG;
    
    if (B_DEV) return true;

    $a_ip = array();
    if ($_CONFIG['adsense_ignore'] == 'ON')
    {
        $a_ip = explode(',',$_CONFIG['adsense_ignore_ip']);
        for ($i=0;$i<count($a_ip);$i++) $a_ip[$i] = trim($a_ip[$i]);
        if (in_array($_SERVER['REMOTE_ADDR'],$a_ip)) return true;
    }
    return false;
}

/**
 * Create text navigation	
 * @param integer $offset
 * @return string
 **/
function getNavigator($total,$perpage,$current,$a_url)
{    
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
            if ($prev==1) $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']);
            else $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$prev));
            $i++;
        }
        
        $counter = 1;
        while ( $counter <= $total_pages ) 
        {
            $a_result[$i]['title'] = $counter;
            if ($counter==1) $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']);
            else $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$counter));
            $i++;
            $counter++;
        }

        $next = $current + 1;
        if ( $total_pages >= $next ) 
        {
            $a_result[$i]['title'] = "&raquo;";
            $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$next));
        }
    }
    return $a_result;
}
?>