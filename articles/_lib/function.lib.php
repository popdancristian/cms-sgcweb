<?php
function config_titleSeparator()
{
    global $_CONFIG;
    if (!empty($_CONFIG['title_separator'])) return ' '.$_CONFIG['title_separator'].' ';
    return ' ';
}


function page_getHomeName($a_page)
{
    foreach ($a_page as $str_key=>$a_value) if ($a_value['home'] == 1) return $a_value['name'];
    return PAGE_DEFAULT;
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
    global $_CONFIG;

    //-- get the tags
    $a_tag = db_search('tag',array('orderby'=>'total desc','name'=>$a_tag_cloud,'domainid'=>ID_DOMAIN,'limit'=>$_CONFIG['tag_limit']));
    $a_tag = buildRewriteEngineUrl($a_tag,'tag',array('tagid','name'),'url');//-- fix rewrite engine url
    shuffle($a_tag);
    return $a_tag;
}

function tag_addCloud(&$a_tag_cloud,$a_data,$str_field)
{
    foreach ($a_data as $i_key=>$a_value)
    {
        if (!empty($a_value[$str_field])) 
        {
         $a_tag = explode(',',$a_value[$str_field]);
         for ($i=0;$i<count($a_tag);$i++)
         {
             $str_tag = trim($a_tag[$i]);
             if (!in_array($str_tag,$a_tag_cloud)) $a_tag_cloud[] = $str_tag;
         }
        }                        
    }
}

function page_fixName($str_string)
{
    return strtolower(str_replace(' ','-',keyword_fixString($str_string)));
}

function page_error404()
{
   global $_CONFIG,$_DOMAIN;
   die('Page not found! Try <a href="'.$_DOMAIN['url'].'">'.$_CONFIG['title'].'</a>');
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

function page_prepare(&$a_page)
{
    global $_CONFIG,$a_dbform;

    //-- get extra fields
    $a_field = $a_dbform['page'];

    foreach ($a_page as $str_key=>$a_value) 
    {
      //-- fix config values
      foreach ($_CONFIG as $str_config_key=>$str_config_value)
      {
       if (!is_array($str_config_value))
       {
           $a_page[$str_key]['content'] = str_replace('[config_'.$str_config_key.']',$str_config_value,$a_page[$str_key]['content']);
           $a_page[$str_key]['description'] = str_replace('[config_'.$str_config_key.']',$str_config_value,$a_page[$str_key]['description']);
           $a_page[$str_key]['tag'] = str_replace('[config_'.$str_config_key.']',strtolower($str_config_value),$a_page[$str_key]['tag']);

           for ($i=0;$i<count($a_field);$i++) $a_page[$str_key][$a_field[$i]] =  str_replace('[config_'.$str_config_key.']',$str_config_value,$a_page[$str_key][$a_field[$i]]);
       }            
      }
      $a_page[$str_key]['a_menu'] = explode('|',$a_page[$str_key]['menus']);//-- fix menus
      if (!empty($a_page[$str_key]['tag'])) $a_page[$str_key]['a_tag'] = explode(', ',$a_page[$str_key]['tag']);//-- fix tags
      else $a_page[$str_key]['a_tag'] = array();
    }
    //-- fix rewrite engine url
    $a_page = buildRewriteEngineUrl($a_page,'page',array('name','home'),'url');//-- fix rewrite engine url
}

function article_prepare(&$a_article)
{
    global $_CONFIG,$a_dbform;
    
    $a_field = $a_dbform['article'];

    $a_site_keyword = explode(',',$_CONFIG['site_keyword']);
    
    //-- fix tags
    foreach ($a_article as $i_key=>$a_value) 
    {        
        if (count($_CONFIG['a_url'])==1) $i_rand = 0;
        else $i_rand = rand(0, count($_CONFIG['a_url'])-1);
        $str_url = $_CONFIG['a_url'][$i_rand]['name'];
        
        //-- replace vars 
        $a_article[$i_key]['description'] =  str_replace('[config_title]',$_CONFIG['title'],$a_article[$i_key]['description']);
        $a_article[$i_key]['content'] =  str_replace('[config_title]',$_CONFIG['title'],$a_article[$i_key]['content']);

        $a_article[$i_key]['description'] =  str_replace('[category_title]',$a_article[$i_key]['category'],$a_article[$i_key]['description']);
        $a_article[$i_key]['content'] =  str_replace('[category_title]',$a_article[$i_key]['category'],$a_article[$i_key]['content']);

        $a_article[$i_key]['description'] =  str_replace('[article_title]',$a_article[$i_key]['title'],$a_article[$i_key]['description']);
        $a_article[$i_key]['content'] =  str_replace('[article_title]',$a_article[$i_key]['title'],$a_article[$i_key]['content']);

        for ($i=0;$i<count($a_field);$i++) 
        {
            $a_article[$i_key][$a_field[$i]] =  str_replace('[config_title]',$_CONFIG['title'],$a_article[$i_key][$a_field[$i]]);
            $a_article[$i_key][$a_field[$i]] =  str_replace('[category_title]',$a_article[$i_key]['category'],$a_article[$i_key][$a_field[$i]]);
            $a_article[$i_key][$a_field[$i]] =  str_replace('[article_title]',$a_article[$i_key]['title'],$a_article[$i_key][$a_field[$i]]);
        }

        $a_article[$i_key]['fulltitle'] = trim($_CONFIG['article_prefix'].' '.$a_value['title'].' '.$_CONFIG['article_sufix']);
        $a_article[$i_key]['imageurl'] = $str_url.'/image/'.$a_value['category_directory'].'/'.$a_value['image'];        
        $str_sdescription = strip_tags($a_article[$i_key]['description']);

        $a_article[$i_key]['swfscript'] = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'.$a_value['swfwidth'].'" height="'.$a_value['swfheight'].'"><param name="movie" value="'.$str_url.'/file/'.$a_value['category_directory'].'/'.$a_value['swffile'].'"><param name="quality" value="high"><param name="menu" value="true"><param name="wmode" value="transparent"><embed width="'.$a_value['swfwidth'].'"  wmode="transparent"  height="'.$a_value['swfheight'].'" src="'.$str_url.'/file/'.$a_value['category_directory'].'/'.$a_value['swffile'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed></object>';
        
        $a_article[$i_key]['a_stag'] = array();
        if (!empty($a_value['tag'])) 
        {
            $a_article[$i_key]['a_tag'] = explode(',',$a_value['tag']);
            for ($i=0;$i<3;$i++)
            {
                if (isset($a_article[$i_key]['a_tag'][$i])) $a_article[$i_key]['a_stag'][] = $a_article[$i_key]['a_tag'][$i];
            }
        }
        else {$a_article[$i_key]['a_tag'] = array();}
        
        if (strlen($a_article[$i_key]['description'])>45) $a_article[$i_key]['sdescription'] = substr($str_sdescription,0,45).'...';
        else $a_article[$i_key]['sdescription'] = $str_sdescription;

        if (strlen($a_article[$i_key]['fulltitle'])>35) $a_article[$i_key]['sfulltitle'] = substr($a_article[$i_key]['fulltitle'],0,35).'...';
        else $a_article[$i_key]['sfulltitle'] = $a_article[$i_key]['fulltitle'];

        $a_article[$i_key]['sdescription'] = str_replace($a_value['category'],'<b>'.$a_value['category'].'</b>',$a_article[$i_key]['sdescription']);
        $a_article[$i_key]['sdescription'] = str_replace(strtolower($a_value['category']),'<b>'.strtolower($a_value['category']).'</b>',$a_article[$i_key]['sdescription']);
        
        $a_article[$i_key]['datepublished'] = date('Y-m-d',strtotime($a_article[$i_key]['datepublished']));

        for ($i=0;$i<count($a_site_keyword);$i++)
        {
            $str_keyword = trim($a_site_keyword[$i]);
            $a_article[$i_key]['sdescription'] = str_replace($str_keyword,'<b>'.$str_keyword.'</b>',$a_article[$i_key]['sdescription']);
        }
        $a_article[$i_key]['fullcategory'] =  trim($_CONFIG['category_prefix'].' '.$a_article[$i_key]['category'].' '.$_CONFIG['category_sufix']);
         
    }

    //-- fix rewrite engine url
    $a_article = buildRewriteEngineUrl($a_article,'article',array('articleid','fulltitle','fullcategory','parent'),'url');
}

function category_prepare(&$a_category)
{    
    global $_CONFIG,$a_dbform,$a_page_template;
    
    $a_field = $a_dbform['category'];
       
    foreach ($a_category as $i_key=>$a_value) 
    {
      //-- fix config values
      foreach ($_CONFIG as $str_config_key=>$str_config_value)
      {
       if (!is_array($str_config_value))
       {
           $a_category[$i_key]['content'] = str_replace('[config_'.$str_config_key.']',$str_config_value,$a_category[$i_key]['content']);
           $a_category[$i_key]['description'] = str_replace('[config_'.$str_config_key.']',$str_config_value,$a_category[$i_key]['description']);
           $a_category[$i_key]['tag'] = str_replace('[config_'.$str_config_key.']',strtolower($str_config_value),$a_category[$i_key]['tag']);

           for ($i=0;$i<count($a_field);$i++) $a_category[$i_key][$a_field[$i]] =  str_replace('[config_'.$str_config_key.']',$str_config_value,$a_category[$i_key][$a_field[$i]]);
       }
       
      }
     
      $a_category[$i_key]['content'] = str_replace('[category_title]',$a_category[$i_key]['title'],$a_category[$i_key]['content']);
      $a_category[$i_key]['description'] = str_replace('[category_title]',$a_category[$i_key]['title'],$a_category[$i_key]['description']);
      $a_category[$i_key]['tag'] = str_replace('[category_title]',strtolower($a_category[$i_key]['title']),$a_category[$i_key]['tag']);
      
      for ($i=0;$i<count($a_field);$i++) 
      {
           $a_category[$i_key][$a_field[$i]] =  str_replace('[category_title]',$a_category[$i_key]['title'],$a_category[$i_key][$a_field[$i]]);
      }
      
      $a_category[$i_key]['fulltitle'] =  trim($_CONFIG['category_prefix'].' '.$a_category[$i_key]['title'].' '.$_CONFIG['category_sufix']);

      if (!empty($a_category[$i_key]['tag'])) $a_category[$i_key]['a_tag'] = explode(',',$a_category[$i_key]['tag']);
      else $a_category[$i_key]['a_tag'] = array();
    }
    $a_category = buildRewriteEngineUrl($a_category,'category',array('categoryid','fulltitle'),'url');//-- fix rewrite engine url
    $a_category = buildRewriteEngineUrl($a_category,'sitemap_category',array('categoryid','fulltitle'),'url_sitemap');//-- fix rewrite engine url
    $a_category = buildRewriteEngineUrl($a_category,'gallery_category',array('categoryid','fulltitle'),'url_gallery');//-- fix rewrite engine url
}

function gallery_prepare(&$a_gallery)
{
    global $_CONFIG;
   
    //-- fix tags
    foreach ($a_gallery as $i_key=>$a_category) 
    {        
		for ($i=0;$i<count($a_category);$i++) 
		{
			if (count($_CONFIG['a_url'])==1) $i_rand = 0;
			else $i_rand = rand(0, count($_CONFIG['a_url'])-1);
			$str_url = $_CONFIG['a_url'][$i_rand]['name'];
			$a_gallery[$i_key][$i]['imageurl'] = $str_url.'/image/'.$a_category[$i]['category_directory'].'/'.$a_category[$i]['image'].'.jpg';
			$a_gallery[$i_key][$i]['imageurlb'] = $str_url.'/image/'.$a_category[$i]['category_directory'].'/'.$a_category[$i]['image'].'b.jpg';
		}
    }
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
    
    //if (B_DEV) return true;

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
            $a_result[$i]['title'] = "&nbsp;&laquo;&laquo;&nbsp;";
            $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']);
            $i++;

            $a_result[$i]['title'] = "&nbsp;&laquo;&nbsp;";
            if ($prev==1) $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']);
            else $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$prev));
            $i++;
        }
        else
        {
            $a_result[$i]['title'] = "&nbsp;&laquo;&laquo;&nbsp;";
            $a_result[$i]['url']   = '#';
            $i++;
            $a_result[$i]['title'] = "&nbsp;&laquo;&nbsp;";
            $a_result[$i]['url']   = '#';
            $i++;
        }
        
        $i_start = 1;
        $i_end   = $total_pages;
        if ($total_pages>10)
        {                 
            $i_middle = intVal(10/ 2);               
            if ($current>$i_middle) $i_start = $current - $i_middle;
            if ($current<($total_pages - $i_middle)) $i_end = $current + $i_middle;            
            if (($current - $i_middle)<0) $i_end = $i_end + abs($current - $i_middle);
            if (($total_pages-$current)<$i_middle) $i_start = $i_start - abs($i_middle - ($total_pages - $current));
        }                

        while ( $i_start <= $i_end ) 
        {
            $a_result[$i]['title'] = $i_start;

            if ($i_start==1) $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']);
            else $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$i_start));            
            $i++;
            $i_start++;
        }

        $next = $current + 1;
        if ( $total_pages >= $next ) 
        {
            $a_result[$i]['title'] = "&nbsp;&raquo;&nbsp;";
            $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$next));            
            $i++;
            $a_result[$i]['title'] = "&nbsp;&raquo;&raquo;&nbsp;";
            $a_result[$i]['url']   = getRewriteEngineUrl($a_url['type'],$a_url['param']+array('page'=>$total_pages));
        }
        else
        {
            $a_result[$i]['title'] = "&nbsp;&raquo;&nbsp;";
            $a_result[$i]['url']   = '#';            
            $i++;
            $a_result[$i]['title'] = "&nbsp;&raquo;&raquo;&nbsp;";
            $a_result[$i]['url']   = '#';
        }
    }
          
    return $a_result;
}

function fixMetaKeyword($a_keyword)
{
    $a_result = array();
    for ($i=0;$i<count($a_keyword);$i++) $a_result[] = trim(strtolower($a_keyword[$i]));
    return implode(', ',array_unique($a_result));
}

function get_string(&$str_source,$string1,$string2)
{
    $str_result = '';
    $pos1 = strpos($str_source,$string1);
    if ($pos1 !== false) 
    {
        $str_source = substr($str_source,$pos1+strlen($string1));
        $pos2 = strpos($str_source,$string2);
        if ($pos2 !== false) 
        {
            $str_result = substr($str_source,0,$pos2);
        }
    }
    return $str_result;
}
?>