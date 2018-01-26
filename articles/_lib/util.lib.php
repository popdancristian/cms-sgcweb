<?php
function generate_sitemap($a_param = array())
{
    global $o_db,$_DOMAIN,$_CONFIG;
        
    $a_log = array();

    $str_sitemap_path = $_DOMAIN['path'];
    if (!empty($_CONFIG['sitemap_dir'])) $str_sitemap_path.=DIR_SEP.$_CONFIG['sitemap_dir'];
    
    if (isset($a_param['file']) and (!is_array($a_param['file']))) $a_param['file'] = array($a_param['file']);

    //-- SITEMAP.XML
    if (empty($a_param) or (isset($a_param['file']) and (in_array('sitemap.xml',$a_param['file']))))
    {
        //-- BEGIN general sitemap
        $str_sitemap ='<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $str_sitemap.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        $a_page = $o_db->getAssoc("SELECT * from ".DB_PREFIX."page p
                                   INNER JOIN ".DB_PREFIX."domain_page dp ON p.pageid = dp.pageid
                                   WHERE active = 1 AND dp.domainid=".$_DOMAIN['domainid']." ORDER BY ordon",'name');

        page_prepare($a_page);

		//-- page template
		$a_page_template = array();
		foreach ($a_page as $str_key=>$a_value) $a_page_template[$a_value['template']] = $str_key;

        foreach ($a_page as $i_key=>$a_value)
        {
			if (PAGE_SEARCH!=$i_key)
			{
			 $str_sitemap.='<url>'."\n";
			 $str_sitemap.=" <loc>".$a_value['url']."</loc>"."\n";
			 $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
			 $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
			 $str_sitemap.=' <priority>0.5</priority>'."\n"; 
			 $str_sitemap.='</url>'."\n";
			}
        }

        //-- read and assign categories
        $a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
                                       INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                       WHERE dc.active = 1 AND dc.domainid=".$_DOMAIN['domainid']." ORDER BY ".$_CONFIG['category_ordon'],'categoryid');

        category_prepare($a_category);

        foreach ($a_category as $i_key=>$a_value)
        {
         $str_sitemap.='<url>'."\n";
         $str_sitemap.=" <loc>".$a_value['url']."</loc>"."\n";
         $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
         $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
         $str_sitemap.=' <priority>0.5</priority>'."\n"; 
         $str_sitemap.='</url>'."\n";
		 $str_sitemap.='<url>'."\n";
         $str_sitemap.=" <loc>".$a_value['url_gallery']."</loc>"."\n";
         $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
         $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
         $str_sitemap.=' <priority>0.5</priority>'."\n"; 
         $str_sitemap.='</url>'."\n";
        }

		//-- get and assign faq
		$a_faq = $o_db->getAssoc("SELECT * from ".DB_PREFIX."faq f
						   INNER JOIN ".DB_PREFIX."domain_faq df ON f.faqid = df.faqid
						   WHERE df.active = 1 AND df.domainid=".$_DOMAIN['domainid']." ORDER BY df.ordon desc","faqid");

		$a_faq = buildRewriteEngineUrl($a_faq,'faq',array('faqid','title'),'url');//-- fix rewrite engine url

		foreach ($a_faq as $i_key=>$a_value)
        {
         $str_sitemap.='<url>'."\n";
         $str_sitemap.=" <loc>".$a_value['url']."</loc>"."\n";
         $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
         $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
         $str_sitemap.=' <priority>0.5</priority>'."\n"; 
         $str_sitemap.='</url>'."\n";
        }

        $str_sitemap.='</urlset>';

        $handle = @fopen ($str_sitemap_path.DIR_SEP.'sitemap.xml', "w+");
        if ($handle)
        {
            fputs($handle,$str_sitemap);
            fclose ($handle);    
            $a_log[] = 'sitemap.xml';
        }
    }
    
    //-- KEYWORD.XML
    if (empty($a_param) or (isset($a_param['file']) and (in_array('keyword.xml',$a_param['file']))))
    {
        //-- BEGIN keyword sitemap
        $str_sitemap ='<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $str_sitemap.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        //-- get the keywords
        $a_keyword = db_search('keyword',array('orderby'=>'total desc','active'=>1,'domainid'=>$_DOMAIN['domainid']));
        $a_keyword = buildRewriteEngineUrl($a_keyword,'keyword',array('keywordid','name'),'url');//-- fix rewrite engine url
        foreach ($a_keyword as $i_key=>$a_value)
        {
         $str_sitemap.='<url>'."\n";
         $str_sitemap.=" <loc>".$a_value['url']."</loc>"."\n";
         $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
         $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
         $str_sitemap.=' <priority>0.5</priority>'."\n"; 
         $str_sitemap.='</url>'."\n";
        }
        $str_sitemap.='</urlset>';
        $handle = @fopen ($str_sitemap_path.DIR_SEP.'keyword.xml', "w+");
        if ($handle)
        {
            fputs($handle,$str_sitemap);
            fclose ($handle);
            $a_log[] = 'keyword.xml';
        }
    }
    
    //-- TAG.XML
    if (empty($a_param) or (isset($a_param['file']) and (in_array('tag.xml',$a_param['file']))))
    {
        //-- BEGIN TAG sitemap
        $str_sitemap ='<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $str_sitemap.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        //-- get the tags
        $a_tag = db_search('tag',array('orderby'=>'total desc','domainid'=>$_DOMAIN['domainid'],'total'=>$_CONFIG['tag_total']));
        $a_tag = buildRewriteEngineUrl($a_tag,'tag',array('tagid','name'),'url');//-- fix rewrite engine url
        foreach ($a_tag as $i_key=>$a_value)
        {
         $str_sitemap.='<url>'."\n";
         $str_sitemap.=" <loc>".$a_value['url']."</loc>"."\n";
         $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
         $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
         $str_sitemap.=' <priority>0.5</priority>'."\n"; 
         $str_sitemap.='</url>'."\n";
        }
        $str_sitemap.='</urlset>';
        $handle = @fopen ($str_sitemap_path.DIR_SEP.'tag.xml', "w+");
        if ($handle)
        {
            fputs($handle,$str_sitemap);
            fclose ($handle);
            $a_log[] = 'tag.xml';
        }
    }       

    if (empty($a_param) or (isset($a_param['categoryid']) and (!empty($a_param['categoryid']))))
    {   
        //-- if we don't have category
        if (isset($a_param['categoryid']))
        {
            $a_param_category = is_array($a_param['categoryid']) ? $a_param['categoryid'] : array($a_param['categoryid']);
         
            //-- read and assign categories
            $a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
                                           INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                           WHERE dc.active = 1 AND dc.domainid=".$_DOMAIN['domainid']." AND 
                                           c.categoryid in (".implode(',',$a_param_category).") ORDER BY ".$_CONFIG['category_ordon'],'categoryid');
            category_prepare($a_category);
        }

        if (!empty($a_category))
        {
            //-- begin categories sitemap
            foreach ($a_category as $i_key=>$a_value)
            {	
				 //-- get and assign last articles
                 $a_article = db_search('article',array(
                                                            'orderby'=>$_CONFIG['article_ordon'].',ordon desc',
                                                            'active'=>1,
                                                            'publish'=>1,
                                                            'domainid'=>$_DOMAIN['domainid'],
                                                            'categoryid'=>$i_key
                                                           ));
				 
				if (count($a_article)>0)
				{
                 article_prepare($a_article);//-- prepare articles

                 $str_sitemap ='<?xml version="1.0" encoding="UTF-8"?>'."\n";
                 $str_sitemap.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
                 $str_sitemap.='<url>'."\n";
                 $str_sitemap.=" <loc>".$a_value['url_sitemap']."</loc>"."\n";
                 $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
                 $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
                 $str_sitemap.=' <priority>0.5</priority>'."\n"; 
                 $str_sitemap.='</url>'."\n";
                
                 foreach ($a_article as $i_key1=>$a_value1)
                 {
                    $str_sitemap.='<url>'."\n";
                    $str_sitemap.=" <loc>".$a_value1['url']."</loc>"."\n";
                    $str_sitemap.=' <lastmod>'.date('Y-m-d').'</lastmod>'."\n";
                    $str_sitemap.=' <changefreq>weekly</changefreq>'."\n";
                    $str_sitemap.=' <priority>0.5</priority>'."\n"; 
                    $str_sitemap.='</url>'."\n";
                 }
                 $str_sitemap.='</urlset>';

                 $str_sitemap_file = str_replace(' ','_',strtolower($a_value['title']));
				 $str_sitemap_file = str_replace('&amp;','and',strtolower($str_sitemap_file));
				 $str_sitemap_file = str_replace('&','and',strtolower($str_sitemap_file));

                 $handle = @fopen($str_sitemap_path.DIR_SEP.$str_sitemap_file.'.xml', "w+");
                 if ($handle)
                 {
                    fputs($handle,$str_sitemap);
                    fclose ($handle);
                    $a_log[] = $str_sitemap_file.'.xml';
                 }
				}
            }
        }
    }
    return $a_log;
}

function generate_tag($i_domainid)
{
    global $o_db;
    
    $a_log = array();
    $i_total = $o_db->getOne('select count(*) from '.DB_PREFIX.'domain_article where domainid = '.$i_domainid.' and publish = 1 and updatetag = 0');
    for ($i=0;$i<(intVal($i_total/100)+1);$i++)
    {
        $i_start = $i * 100;
        $a_article =  $o_db->getAll('SELECT a.tag,a.articleid
                                     FROM '.DB_PREFIX.'article a 
                                     INNER JOIN '.DB_PREFIX.'domain_article da ON da.articleid = a.articleid
                                     WHERE domainid = '.$i_domainid.' and publish = 1 and updatetag = 0 ORDER BY a.articleid LIMIT '.$i_start.',100');
        
        for ($j=0;$j<count($a_article);$j++) 
        {
            $a_log[] = $a_article[$j]['articleid'].' '.$a_article[$j]['tag'];
            $a_tag = explode(',',trim($a_article[$j]['tag']));
            if (!empty($a_tag))
            {   
                for ($k=0;$k<count($a_tag);$k++)
                {
                    $str_tag = trim($a_tag[$k]);                    
                    if (!empty($str_tag))
                    {
                        $i_tagid = $o_db->getOne("select tagid from ".DB_PREFIX."tag where domainid = ".$i_domainid." and name = '".addslashes($str_tag)."'");
                        if (empty($i_tagid))
                        {
                            //-- insert new tag
                            $o_db->query("INSERT INTO ".DB_PREFIX."tag (domainid, name, total) VALUES ($i_domainid,'".addslashes($str_tag)."',1)");
                        }
                        else
                        {
                            //-- update old tag
                            $o_db->query("UPDATE ".DB_PREFIX."tag SET total = total + 1 WHERE domainid = ".$i_domainid." and tagid = ".$i_tagid);
                        }
                    }

                }
            }
        }    
    }
    $o_db->query("UPDATE ".DB_PREFIX."domain_article SET updatetag = 1 WHERE updatetag = 0 AND domainid = ".$i_domainid." and publish = 1");
    return $a_log;
}

function submit_sitemap($a_param)
{
    global $o_db,$_DOMAIN,$_CONFIG;

	$str_sitemap_path = $_DOMAIN['path'];
    if (!empty($_CONFIG['sitemap_dir'])) $str_sitemap_path.=DIR_SEP.$_CONFIG['sitemap_dir'];
    
    $a_log = array();    
    $wt = new WebmasterTools($_CONFIG['google_email'], $_CONFIG['google_password']);
        
    if (isset($a_param['file']))
    {
        $b_success = $wt->submitSitemap('www.'.$_DOMAIN['name'],$a_param['file']);
        if ($b_success) $a_log[] = $a_param['file'].' [DONE]';
        else $a_param['file'].' [ERROR]';       

        if (!empty($a_param['categoryid']))
        $o_db->query('UPDATE '.DB_PREFIX.'domain_category SET google = 1 WHERE domainid='.$_DOMAIN['domainid'].' AND categoryid = '.$a_param['categoryid']);
    }
    else
    {
        //-- add default sitemaps
        if ($_DOMAIN['google'] == 0)
        {
            $b_success = $wt->submitSitemap('www.'.$_DOMAIN['name'],'sitemap.xml');
            if ($b_success) $a_log[] = 'sitemap.xml [DONE]';
            else $a_log[] = 'sitemap.xml [ERROR]';
            sleep(1);
            $b_success = $wt->submitSitemap('www.'.$_DOMAIN['name'],'tag.xml');
            if ($b_success) $a_log[] = 'tag.xml [DONE]';
            else $a_log[] = 'tag.xml [ERROR]';
            sleep(1);
            $b_success = $wt->submitSitemap('www.'.$_DOMAIN['name'],'keyword.xml');
            if ($b_success) $a_log[] = 'keyword.xml [DONE]';
            else $a_log[] = 'keyword.xml [ERROR]';
            sleep(1);
            $o_db->query('UPDATE '.DB_PREFIX.'domain SET google = 1 WHERE domainid='.$_DOMAIN['domainid']);
        }

        //-- read and assign categories
        $a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
                                       INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                       WHERE dc.active = 1 AND dc.google = 0 AND dc.domainid=".$_DOMAIN['domainid']." ORDER BY c.title",'categoryid');

        if (!empty($a_category))
        {
            foreach ($a_category as $i_key=>$a_value)
            {
                $str_sitemap_file = str_replace(' ','_',strtolower($a_value['title'])).'.xml';
				$str_sitemap_file = str_replace('&amp;','and',strtolower($str_sitemap_file));
				$str_sitemap_file = str_replace('&','and',strtolower($str_sitemap_file));
				if (file_exists($str_sitemap_path.DIR_SEP.$str_sitemap_file))
				{
					$b_success = $wt->submitSitemap('www.'.$_DOMAIN['name'],$str_sitemap_file);
					$b_success = true;
					if ($b_success) 
					{
						$o_db->query('UPDATE '.DB_PREFIX.'domain_category SET google = 1 WHERE domainid='.$_DOMAIN['domainid'].' AND categoryid = '.$i_key);
						$a_log[] = $str_sitemap_file." [DONE]";
					}
					else $a_log[] = $str_sitemap_file." [ERROR]";
					sleep(1);
				}
            }
        }
    }
    return $a_log;
}

function array_to_phpfile($a_data,$str_domain,$str_name,$str_dir = '')
{
    $str_result="<?php\n";
    $str_result.='$'.$str_name.' = ';
    $str_result.=" array(\n";
    foreach ($a_data as $str_key=>$a_value)
    {
        if (is_array($a_value))
        {
            $str_result.="'$str_key'=>array(\n";

            foreach ($a_value as $str_key1=>$a_value1) 
            {
                if (is_array($a_value1))  
                {
                    $str_result.="'$str_key1'=>array(\n";
                    foreach ($a_value1 as $str_key2=>$a_value2)
                       $str_result.="'$str_key2'=>'".str_replace("'","\'",$a_value2)."',\n";
                    $str_result.="),\n";
                }   
                else
                $str_result.="'$str_key1'=>'".str_replace("'","\'",$a_value1)."',\n";

            }

            $str_result.="),\n";
        }
        else $str_result.="'$str_key'=>'".str_replace("'","\'",str_replace("
    ","",$a_value))."',\n";
    }
    $str_result.=");?>";

    if ( ($str_dir!='') and (!file_exists(PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.$str_domain.DIR_SEP.$str_dir)))
    {
        mkdir(PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.$str_domain.DIR_SEP.$str_dir);
    }
    
    if ($str_dir=='') $handle = fopen (PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.$str_domain.DIR_SEP.$str_name.'.php', "w+");
    else $handle = fopen (PATH_SITE.DIR_SEP.'_cache'.DIR_SEP.$str_domain.DIR_SEP.$str_dir.DIR_SEP.$str_name.'.php', "w+");
    fputs($handle,$str_result);
    fclose ($handle);
}

function update_cache($i_domainid,$a_param = array())
{
    global $o_db;

    $a_log = array();    
    
    if (empty($a_param) or in_array('config',$a_param))
    {
        $_CONFIG = getConfig($i_domainid);
        array_to_phpfile($_CONFIG,$i_domainid,'_CONFIG');
        $a_log[] = 'Config';
    }

    if (empty($a_param) or in_array('dbform',$a_param))
    {
        $a_dbform = getDbForm();
        array_to_phpfile($a_dbform,$i_domainid,'a_dbform');
        $a_log[] = 'DbForm';
    }
    
    if (empty($a_param) or in_array('lang',$a_param))
    {
        $_l = array();
        $a_lang = $o_db->getAll("SELECT * from cms_lang WHERE domainid = ".$i_domainid);
        for ($j=0;$j<count($a_lang);$j++) $_l[$a_lang[$j]['lang_name']] = $a_lang[$j]['lang_value'];
        array_to_phpfile($_l,$i_domainid,'_l');
        $a_log[] = 'Lang';
    }

    if (empty($a_param) or in_array('page',$a_param))
    {
        //-- read pages
        $a_page = $o_db->getAssoc("SELECT * from ".DB_PREFIX."page p
                                    INNER JOIN ".DB_PREFIX."domain_page dp ON p.pageid = dp.pageid
                                    WHERE active = 1 AND dp.domainid=".$i_domainid." ORDER BY ordon",'name');
        
        array_to_phpfile($a_page,$i_domainid,'a_page');

        $a_log[] = 'Page';
    }

    if (empty($a_param) or in_array('category',$a_param))
    {
        //-- read and assign categories
        $a_category = $o_db->getAssoc("SELECT * from ".DB_PREFIX."category c
                                       INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                       WHERE dc.active = 1 AND dc.domainid=".$i_domainid." ORDER BY ".$_CONFIG['category_ordon'],'categoryid');

        $a_category_articles = $o_db->getAssoc("SELECT c.categoryid,count(a.articleid) as total from ".DB_PREFIX."category c
                                         INNER JOIN ".DB_PREFIX."domain_category dc ON c.categoryid = dc.categoryid
                                         INNER JOIN ".DB_PREFIX."article a ON a.categoryid = c.categoryid
                                         INNER JOIN ".DB_PREFIX."domain_article da ON a.articleid = da.articleid
                                         WHERE dc.active = 1 AND da.publish = 1 AND dc.domainid=".$i_domainid." AND da.domainid=".$i_domainid." GROUP BY c.categoryid",'categoryid');
                           
        foreach ($a_category as $i_key=>$a_value) $a_category[$i_key]['articles'] = isset($a_category_articles[$i_key]['total']) ? $a_category_articles[$i_key]['total'] : 0;

        array_to_phpfile($a_category,$i_domainid,'a_category');

        $a_log[] = 'Category';
    }
    
    if (empty($a_param) or isset($a_param['a_category']))
    {
        if (isset($a_param['a_category'])) 
        {
            $a_category = array();
            for ($i=0;$i<count($a_param['a_category']);$i++) $a_category[$a_param['a_category'][$i]] = array('categoryid'=>$a_param['a_category'][$i]);
        }
        foreach ($a_category as $i_categoryid=>$a_value)
        {
            //-- get the articles
            $a_article_param = array('categoryid'=>$i_categoryid, 'active'=>1,'publish'=>1,'domainid'=>$i_domainid);
            $a_article_param['orderby'] = $_CONFIG['article_ordon'].',datepublished desc';
            $a_article = db_search('article',$a_article_param);
            array_to_phpfile($a_article,$i_domainid,'a_category_article',$i_categoryid);

            //-- get the articles
            $a_article_param = array('categoryid'=>$i_categoryid, 'active'=>1,'publish'=>1,'domainid'=>$i_domainid);
            $a_article_param['orderby'] = 'datepublished desc';
            $a_article = db_search('article',$a_article_param);
            array_to_phpfile($a_article,$i_domainid,'a_category_article_latest',$i_categoryid);

            //-- get the articles
            $a_article_param = array('categoryid'=>$i_categoryid, 'active'=>1,'publish'=>1,'domainid'=>$i_domainid);
            $a_article_param['orderby'] = 'da.total desc,datepublished desc';
            $a_article = db_search('article',$a_article_param);
            array_to_phpfile($a_article,$i_domainid,'a_category_article_popular',$i_categoryid);


            //-- get and assign last articles
            $a_article_last = db_search('article',array(
                                                        'orderby'=>'total desc,datepublished desc',
                                                        'active'=>1,
                                                        'publish'=>1,
                                                        'categoryid'=>$i_categoryid,
                                                        'domainid'=>$i_domainid,
                                                        'limit'=>$_CONFIG['article_news_limit']
                                                       ));
            array_to_phpfile($a_article_last,$i_domainid,'a_article_last',$i_categoryid);
            $a_log[] = 'Category #'.$i_categoryid;
        }
    }   

    if (empty($a_param) or in_array('article_last',$a_param))
    {        
        //-- get and assign last articles
        $a_article_last = db_search('article',array(
                                                    'orderby'=>'datepublished desc,ordon desc',
                                                    'active'=>1,
                                                    'publish'=>1,
                                                    'domainid'=>$i_domainid,
                                                    'limit'=>$_CONFIG['article_last_limit']
                                                   ));

        array_to_phpfile($a_article_last,$i_domainid,'a_article_last');


        //-- get and assign last articles
        $a_article_last = db_search('article',array(
                                                    'orderby'=>'datepublished desc,a.articleid desc',
                                                    'active'=>1,
                                                    'publish'=>1,
                                                    'domainid'=>$i_domainid,
                                                    'limit'=>$_CONFIG['article_news_limit']
                                                   ));
        array_to_phpfile($a_article_last,$i_domainid,'a_article_news');
    }

    if (empty($a_param) or in_array('article_best',$a_param))
    {
        //-- get and assign best articles
        $a_article_best = db_search('article',array(
                                                    'orderby'=>'total desc,ordon desc',
                                                    'active'=>1,
                                                    'publish'=>1,
                                                    'domainid'=>$i_domainid,
                                                    'limit'=>$_CONFIG['article_best_limit']
                                                   ));
        array_to_phpfile($a_article_best,$i_domainid,'a_article_best');
    }

    
    if (empty($a_param) or in_array('article_best_rated',$a_param))
    {
        //-- get and assign best articles
        $a_article_best_rated = db_search('article',array(
                                            'orderby'=>'raty desc,ordon desc',
                                            'active'=>1,
                                            'publish'=>1,
                                            'domainid'=>$i_domainid,
                                            'limit'=>$_CONFIG['article_best_rated_limit']
                                          ));
        array_to_phpfile($a_article_best_rated,$i_domainid,'a_article_best_rated');
    }

    if (empty($a_param) or in_array('article_most_rated',$a_param))
    {
        //-- get and assign best articles
        $a_article_most_rated = db_search('article',array(
                                            'orderby'=>'totalraty desc,ordon asc',
                                            'active'=>1,
                                            'publish'=>1,
                                            'domainid'=>$i_domainid,
                                            'limit'=>$_CONFIG['article_most_rated_limit']
                                          ));
        array_to_phpfile($a_article_most_rated,$i_domainid,'a_article_most_rated');
    }

	if (empty($a_param) or in_array('gallery',$a_param))
    { 
		$a_result = $o_db->getAll("SELECT g.title,
										  g.image,
										  g.categoryid,
										  c.directory as category_directory
								   from ".DB_PREFIX."gallery g
								   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
								   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
								   WHERE dg.active = 1 AND dg.home = 1 AND dg.domainid=$i_domainid ORDER BY ordon");

		$a_gallery_home  = array();
		for ($i=0;$i<count($a_result);$i++) 
		{
			if (!isset($a_gallery_home[$a_result[$i]['categoryid']])) $a_gallery_home[$a_result[$i]['categoryid']] = array();
			$a_gallery_home[$a_result[$i]['categoryid']][] = $a_result[$i];
		}
		array_to_phpfile($a_gallery_home,$i_domainid,'a_gallery_home');

		$a_gallery = $o_db->getAll("select g.*,
									   c.title as category,
									   c.directory
								from ".DB_PREFIX."gallery g
								inner join ".DB_PREFIX."category c ON c.categoryid = g.categoryid
								inner join ".DB_PREFIX."domain_category dc ON dc.categoryid = c.categoryid
								inner join ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
								where dg.home = 1 AND dg.domainid = ".$i_domainid." 
								AND dc.home = 1 AND dc.domainid = ".$i_domainid);

		array_to_phpfile($a_gallery,$i_domainid,'a_gallery');

		foreach ($a_category as $categoryid=>$a_value)
        {
			$a_result = $o_db->getAll("SELECT g.galleryid,
										  g.title,
										  g.image,
										  g.categoryid,
										  c.directory as category_directory
								   from ".DB_PREFIX."gallery g
								   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
								   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
								   WHERE dg.active = 1 AND g.categoryid = $categoryid AND dg.domainid=$i_domainid ORDER BY ordon");

			$a_gallery  = array();
			for ($i=0;$i<count($a_result);$i++) 
			{
				if (!isset($a_gallery[$a_result[$i]['categoryid']])) $a_gallery[$a_result[$i]['categoryid']] = array();
				$a_gallery[$a_result[$i]['categoryid']][] = $a_result[$i];
			}
			array_to_phpfile($a_gallery,$i_domainid,'a_gallery',$categoryid);
            $a_log[] = 'Gallery #'.$categoryid;


			$a_result = $o_db->getAll("SELECT g.title,
									  g.image,
									  g.categoryid,
									  c.directory as category_directory
							   from ".DB_PREFIX."gallery g
							   INNER JOIN ".DB_PREFIX."domain_gallery dg ON dg.galleryid = g.galleryid
							   INNER JOIN ".DB_PREFIX."category c ON c.categoryid = g.categoryid
							   WHERE dg.active = 1 AND g.categoryid = ".$categoryid." AND dg.domainid=$i_domainid ORDER BY dg.total DESC LIMIT ".$_CONFIG['article_news_limit']);

			$a_gallery_best  = array();
			for ($i=0;$i<count($a_result);$i++) 
			{
				if (!isset($a_gallery_best[$a_result[$i]['categoryid']])) $a_gallery_best[$a_result[$i]['categoryid']] = array();
				$a_gallery_best[$a_result[$i]['categoryid']][] = $a_result[$i];
			}

			array_to_phpfile($a_gallery_best,$i_domainid,'a_gallery_best',$categoryid);
            $a_log[] = 'Gallery Best #'.$categoryid;
		}

		$a_log[] = 'Gallery';
    }
  
    if (empty($a_param) or in_array('script',$a_param))
    {
        //-- get and assign scripts
        $a_script = db_get('script',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>$i_domainid));
        array_to_phpfile($a_script,$i_domainid,'a_script');
        $a_log[] = 'Script';
    }
	if (empty($a_param) or in_array('faq',$a_param))
    {
        //-- get and assign faq
		$a_faq = $o_db->getAssoc("SELECT * from ".DB_PREFIX."faq f
						   INNER JOIN ".DB_PREFIX."domain_faq df ON f.faqid = df.faqid
						   WHERE df.active = 1 AND df.domainid=$i_domainid ORDER BY df.ordon desc","faqid");

        array_to_phpfile($a_faq,$i_domainid,'a_faq');
        $a_log[] = 'Faq';
    }
    if (empty($a_param) or in_array('link',$a_param))
    {
        //-- get and assign links
        $a_elink = db_get('link',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>$i_domainid));
        array_to_phpfile($a_elink,$i_domainid,'a_elink');
        $a_log[] = 'Link';
    }
    if (empty($a_param) or in_array('banner',$a_param))
    {
        //-- get and assign banners
        $a_banner = db_get('banner',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>$i_domainid));
        array_to_phpfile($a_banner,$i_domainid,'a_banner');
        $a_log[] = 'Banner';
    }
    if (empty($a_param) or in_array('adsense',$a_param))
    {
        $a_adsense = db_get('adsense',array('orderby'=>'ordon'),array('active'=>1,'domainid'=>$i_domainid));
        array_to_phpfile($a_adsense,$i_domainid,'a_adsense');
        $a_log[] = 'Adsense';
    }
    if (empty($a_param) or in_array('keyword',$a_param))
    {
        $a_keyword_best = db_search('keyword',array('orderby'=>'total desc','active'=>1,'limit'=>$_CONFIG['keyword_limit'],'domainid'=>$i_domainid));
        array_to_phpfile($a_keyword_best,$i_domainid,'a_keyword_best');

        $a_keyword_last = db_search('keyword',array('orderby'=>'k.keywordid desc','active'=>1,'limit'=>$_CONFIG['keyword_limit'],'domainid'=>$i_domainid));
        array_to_phpfile($a_keyword_last,$i_domainid,'a_keyword_last');

        $a_log[] = 'Keyword';
    }
    return $a_log;
}
?>