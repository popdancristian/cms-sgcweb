<?php
$b_success = true;
$a_message = array();
switch ($attributes['action'])
{
    case 'generatecategoriesandarticlesrandom';
        
        //-- publish unpublished articles
        if ('ON' == $attributes['unpublished'])
        {
            $i_total_domains = $o_db->getOne('select count(*) from '.DB_PREFIX.'domain');

            $a_categoryid = $o_db->getCol('SELECT dc.categoryid
                                          FROM `cms_domain_category` dc
                                          INNER JOIN cms_category c ON dc.categoryid = c.categoryid 
                                          WHERE active = 0
                                          GROUP BY dc.categoryid
                                          HAVING count(*) = '.$i_total_domains.'
                                          ORDER BY rand() LIMIT '.intVal($attributes['category']));
            
            if (!empty($a_categoryid))
            $a_category = $o_db->getAll('SELECT categoryid,
                                                title
                                         FROM cms_category WHERE categoryid in ('.implode(',',$a_categoryid).')');
        }
        else
        {
             $a_category = $o_db->getAll('SELECT dc.categoryid,
                                                c.title
                                         FROM `cms_domain_category` dc
                                         INNER JOIN cms_category c ON dc.categoryid = c.categoryid 
                                         WHERE dc.domainid = '.$_SESSION['domainid'].' and active = 0 ORDER BY rand() LIMIT '.intVal($attributes['category']));
        }
        
        if (empty($a_category)) $b_success = false;
        else
        {
            for ($i=0;$i<count($a_category);$i++)
            {
                $a_article = $o_db->getAll('SELECT da.articleid,a.title FROM `cms_domain_article` da
                                        INNER JOIN cms_article a ON da.articleid = a.articleid 
                                        WHERE da.domainid = '.$_SESSION['domainid'].' and publish = 0 AND a.categoryid = '.intVal($a_category[$i]['categoryid']).' ORDER BY rand() LIMIT '.intVal($attributes['article']));
                for ($j=0;$j<count($a_article);$j++)
                {
                   $i_month = rand(1,5);
                   $i_day = rand(1,28);
                   $datepublished = '2011-'.$i_month.'-'.$i_day;

                   $o_db->query("UPDATE cms_domain_article SET publish = 1,datepublished='".$datepublished."' WHERE domainid = ".$_SESSION['domainid']." and articleid = ".$a_article[$j]['articleid']);
                } 
                $o_db->query("UPDATE cms_domain_category SET active = 1 WHERE domainid = ".$_SESSION['domainid']." and categoryid = ".$a_category[$i]['categoryid']);
            }
            $a_message[] = 'Succesfully published '.count($a_category).' categories';
        }  
    break;
    case 'generatearticlesrandom':
        
        //-- publish unpublished articles
        if ('ON' == $attributes['unpublished'])
        {
            $i_total_domains = $o_db->getOne('select count(*) from '.DB_PREFIX.'domain');

            $a_articleid = $o_db->getCol('SELECT da.articleid
                                          FROM `cms_domain_article` da
                                          INNER JOIN cms_article a ON da.articleid = a.articleid 
                                          INNER JOIN cms_domain_category dc ON dc.categoryid = a.categoryid
                                          INNER JOIN cms_category c ON c.categoryid = dc.categoryid
                                          WHERE dc.domainid = '.$_SESSION['domainid'].' and da.publish = 0 and dc.active = 1 
                                          GROUP BY da.articleid
                                          HAVING count(*) = '.$i_total_domains.'
                                          ORDER BY rand() LIMIT '.intVal($attributes['total']));
                
             if (!empty($a_articleid))
             $a_article = $o_db->getAll('SELECT a.articleid,
                                                a.title,
                                                c.title as category
                                        FROM cms_article a 
                                        INNER JOIN cms_category c ON c.categoryid = a.categoryid
                                        WHERE a.articleid in ('.implode(',',$a_articleid).')');
        }
        else
        {
            $a_article = $o_db->getAll('SELECT da.articleid,
                                               a.title,
                                               c.title as category
                                        FROM `cms_domain_article` da
                                        INNER JOIN cms_article a ON da.articleid = a.articleid 
                                        INNER JOIN cms_domain_category dc ON dc.categoryid = a.categoryid
                                        INNER JOIN cms_category c ON c.categoryid = dc.categoryid
                                        WHERE da.domainid = '.$_SESSION['domainid'].' and dc.domainid = '.$_SESSION['domainid'].' 
                                        and da.publish = 0 and dc.active = 1 ORDER BY rand() LIMIT '.intVal($attributes['total']));
        }
        
        if (empty($a_article)) $b_success = false;
        else
        {
            for ($j=0;$j<count($a_article);$j++)
            {
               $i_month = rand(1,5);
               $i_day = rand(1,28);
               $datepublished = '2011-'.$i_month.'-'.$i_day;

               $o_db->query("UPDATE cms_domain_article SET publish = 1,datepublished='".$datepublished."' WHERE domainid = ".$_SESSION['domainid']." and articleid = ".$a_article[$j]['articleid']);
            }
            $a_message[] = 'Succesfully published '.count($a_article).' articles';
        }        
    break;
    case 'generatearticlesfromcategoryrandom':
        
        //-- publish unpublished articles
        if ('ON' == $attributes['unpublished'])
        {
           $i_total_domains = $o_db->getOne('select count(*) from '.DB_PREFIX.'domain');

           //-- get unpublished articles
           $a_articleid = $o_db->getCol('SELECT da.articleid FROM `cms_domain_article` da
                                         INNER JOIN cms_article a ON da.articleid = a.articleid 
                                         WHERE publish = 0 AND a.categoryid = '.intVal($attributes['categoryid']).' 
                                         GROUP BY da.articleid
                                         HAVING count(*) = '.$i_total_domains.'
                                         ORDER BY rand() 
                                         LIMIT '.intVal($attributes['total']));
           if (!empty($a_articleid))
           $a_article = $o_db->getAll('SELECT a.articleid
                                       FROM cms_article a 
                                       WHERE a.articleid in ('.implode(',',$a_articleid).')');
        }
        else
        {
            $a_article = $o_db->getAll('SELECT da.articleid FROM `cms_domain_article` da
                                        INNER JOIN cms_article a ON da.articleid = a.articleid 
                                        WHERE da.domainid = '.$_SESSION['domainid'].' and publish = 0 AND a.categoryid = '.intVal($attributes['categoryid']).' ORDER BY rand() LIMIT '.intVal($attributes['total']));
        }
        
        if (empty($a_article)) $b_success = false;
        else
        {
            for ($j=0;$j<count($a_article);$j++)
            {
               $i_month = rand(1,5);
               $i_day = rand(1,28);
               $datepublished = '2011-'.$i_month.'-'.$i_day;

               $o_db->query("UPDATE cms_domain_article SET publish = 1,datepublished='".$datepublished."' WHERE domainid = ".$_SESSION['domainid']." and articleid = ".$a_article[$j]['articleid']);
            }
            $a_message[] = 'Succesfully published '.count($a_article).' articles';
        }       
    break;
}
$_SESSION['success'] = $b_success;
if (!empty($a_message)) $_SESSION['a_message'] = $a_message;

header('Location: index.php?page='.$page);
?>