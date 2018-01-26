<?php
/*
*	Encodes a string to make it usable for building up a rewrited URL
*	@param string
*	@return string : special characters cleaned up
*/
function getEncodeUrl($string)
{
    global $_CONFIG;
       
    $string = str_replace($_CONFIG['rewrite_engine_string'],'', $string);
    $words = explode(' ',$string);
    $min_length = 2;
    $cleaned_words = array();
    foreach($words as $word)
    {
        if(strlen($word) >= $min_length)
        {
            $word = strtolower($word);
			$word = str_replace('&amp;','', $word);
            $word = str_replace(',','', $word);
            $word = str_replace('?','', $word);
            $word = str_replace('-','', $word);
            $word = str_replace('_','', $word);
			$word = str_replace('(','', $word);
			$word = str_replace(')','', $word);
            $word = str_replace('\'','', $word);
            $word = str_replace(':','', $word);
            $word = str_replace(';','', $word);
            $word = str_replace('/','', $word);
            $word = str_replace('~','', $word);
            $word = str_replace('&','', $word);
            $word = str_replace("( |')", "-", $word);
            $accent = array('â','à','é','è','ê','î','ô','û','ç',"'");
            $sans_accent = array('a','a','e','e','e','i','o','u','c','');
            $word = str_replace($accent, $sans_accent, $word);
            $word = preg_replace("[^a-z0-9]","-",$word);
            $word = preg_replace("(^(_)*|(_)*$)","",$word);
            
            $cleaned_words[] = $word;
        }
    }
    $cleaned_string = implode($_CONFIG['rewrite_engine_string'],$cleaned_words);
    
    return $cleaned_string;
}

function getRewriteEngineUrl($str_type,$a_param)
{
    global $_CONFIG,$_DOMAIN,$a_page_template;
    
    $str_url = '#';

    //-- lowercase params
    foreach ($a_param as $str_key=>$str_value) $a_param[$str_key] = strtolower($str_value);
    
    if ($_CONFIG['rewrite_engine'] == 'ON')
    {
        $str_separator = $_CONFIG['rewrite_engine_string'];
        $str_end = '.html';
        if ($_CONFIG['rewrite_engine_method'] == 2) {$str_end='';}

        switch($str_type)
        {
            case 'page':
                
                if ( (isset($a_param['home'])) and ($a_param['home'] == 1)) $str_url = '';
                else $str_url = getEncodeUrl($a_param['name']);

                if (isset($a_param['page'])) $str_url.=$str_separator.'p'.$str_separator.$a_param['page'];
                if (!empty($str_url)) $str_url.=$str_end;
            break;

            case 'category':
                $str_title = $a_param['fulltitle'];
                $str_url = getEncodeUrl($str_title).$str_separator.'c'.$str_separator.$a_param['categoryid'];
                if (isset($a_param['page'])) $str_url.=$str_separator.'p'.$str_separator.$a_param['page'];
                $str_url.=$str_end;
            break;
			case 'faq':
                $str_title = $a_param['title'];
                $str_url = getEncodeUrl($str_title).$str_separator.'q'.$str_separator.$a_param['faqid'];
                $str_url.=$str_end;
            break;
            case 'gallery_category':
                $str_title = $a_param['fulltitle'].' '._l('gallery');
                $str_url = getEncodeUrl($str_title).$str_separator.'g'.$str_separator.$a_param['categoryid'];
                $str_url.=$str_end;
            break;            

            case 'article':  
                $str_title = $a_param['fullcategory'].' '.$a_param['fulltitle'];
                $str_url = getEncodeUrl($str_title).$str_separator.'a'.$str_separator.$a_param['articleid'].$str_end;
            break;

            case 'keyword':
                $str_url = getEncodeUrl($a_param['name']).$str_separator.'k'.$str_separator.$a_param['keywordid'];
                if (isset($a_param['page'])) $str_url.=$str_separator.'p'.$str_separator.$a_param['page'];
                 $str_url.=$str_end;
            break;

            case 'index':
                if (empty($a_param['letter']) or ($a_param['letter'] == '_'))
                    $str_url = getEncodeUrl($a_param['name']);
                else
                    $str_url = getEncodeUrl($a_param['name']).$str_separator.$a_param['letter'];

                if (isset($a_param['page'])) $str_url.=$str_separator.'p'.$str_separator.$a_param['page'];
                $str_url.=$str_end;
            break;

            case 'sitemap_category':
				$str_page = isset($a_page_template[PAGE_SITEMAP]) ? $a_page_template[PAGE_SITEMAP] : 'hartasite';
                $str_url = $str_page.$str_separator.getEncodeUrl($a_param['fulltitle']).$str_separator.$a_param['categoryid'].$str_end;
            break;

            case 'keyword_letter':
				$str_page = isset($a_page_template[PAGE_KEYWORD]) ? $a_page_template[PAGE_KEYWORD] : PAGE_KEYWORD;
                $str_url = $str_page.$str_separator.$a_param['letter'].$str_end;
            break;

            case 'tag':
                $str_url = getEncodeUrl($a_param['name']).$str_separator.'t'.$str_separator.$a_param['tagid'];
                if (isset($a_param['page'])) $str_url.=$str_separator.'p'.$str_separator.$a_param['page'];
                $str_url.=$str_end;
            break;
        }
    }
    else
    {
        switch($str_type)
        {
            case 'page':
                $str_url =  ($a_param['home'] == 1) ? '' : 'index.php?page='.getEncodeUrl($a_param['name']);
            break;

            case 'category':
                $str_url = 'index.php?category='.getEncodeUrl($a_param['title']).'&page='.PAGE_CATEGORY.'&categoryid='.$a_param['categoryid'];
            break;

            case 'article':
                $str_url = 'index.php?article='.getEncodeUrl($a_param['title']).'&page='.PAGE_ARTICLE.'&articleid='.$a_param['articleid'];
            break;

            case 'keyword':
                $str_url = 'index.php?keyword='.getEncodeUrl($a_param['name']).'&page='.PAGE_SEARCH.'&keywordid='.$a_param['keywordid'];
            break;

            case 'keyword_letter':
                $str_url = 'index.php?page='.PAGE_KEYWORD.'&letter='.$a_param['letter'];
            break;

            case 'tag':
                $str_url = 'index.php?tag='.getEncodeUrl($a_param['name']).'&page='.PAGE_SEARCH.'&tagid='.$a_param['tagid'];
            break;
        }
        //-- replace &
        //$str_url = str_replace('&',"&amp;",$str_url);
    }

    if (empty($str_url)) return $_DOMAIN['url'];
    else return $_DOMAIN['url'].'/'.$str_url;
}

function buildRewriteEngineUrl($a_source,$str_type,$a_field,$str_field)
{
    foreach ($a_source as $i_key=>$a_value) 
    {
        $a_param = array();
        for ($i=0;$i<count($a_field);$i++) if (isset($a_value[$a_field[$i]])) $a_param[$a_field[$i]] = $a_value[$a_field[$i]];

        $a_source[$i_key][$str_field] = getRewriteEngineUrl($str_type,$a_param);
    }
    return $a_source;
}
?>