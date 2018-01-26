<?php
set_time_limit(0);
$b_success = true;
$str_location = 'index.php?page='.$page;
switch ($attributes['action'])
{
    case 'add':        
        $i_domainid = db_add('domain',array('name'=>$attributes['name'],'url'=>$attributes['url'],'path'=>$attributes['path'],'ordon'=>intVal($attributes['ordon'])));
        
        if (empty($i_domainid)) $b_success = false;
        else
        {
            //-- makedir _template_c  and _cache
            @mkdir(PATH_FRONTEND.DIR_SEP.'_template_c'.DIR_SEP.$attributes['name']);
            @mkdir(PATH_FRONTEND.DIR_SEP.'_cache'.DIR_SEP.$i_domainid);
           
            //-- add into config
            $o_db->query("INSERT INTO  ".DB_PREFIX."config (domainid,config_name,config_value) SELECT $i_domainid, config_name, config_value FROM ".DB_PREFIX."config WHERE domainid = ".DEFAULT_DOMAINID);
            //-- add into page
            $o_db->query("INSERT INTO  ".DB_PREFIX."domain_page (domainid,pageid,menus,active,home,ordon) SELECT $i_domainid,pageid,menus,active,home,ordon FROM ".DB_PREFIX."domain_page WHERE domainid = ".DEFAULT_DOMAINID);
            //-- add into category
            $o_db->query("INSERT INTO  ".DB_PREFIX."domain_category(domainid,categoryid,active,ordon) SELECT $i_domainid,categoryid,1,0 FROM ".DB_PREFIX."domain_category WHERE domainid = ".DEFAULT_DOMAINID);
            
            //-- update ordon random
            $a_category = db_get('category',array('orderby'=>'title'));
            $a_ordon = array();
            for ($i=0;$i<count($a_category);$i++) $a_ordon[] = $i+1;
            shuffle($a_ordon);
            for ($i=0;$i<count($a_category);$i++) 
            $o_db->query("UPDATE ".DB_PREFIX."domain_category SET ordon = ".$a_ordon[$i]." WHERE domainid = $i_domainid AND categoryid = ".$a_category[$i]['categoryid']);

            //-- add into article
            $o_db->query("INSERT INTO  ".DB_PREFIX."domain_article (domainid,articleid,active) SELECT $i_domainid,articleid,1 FROM ".DB_PREFIX."domain_article WHERE domainid = ".DEFAULT_DOMAINID);
			
			//-- add into gallery
			$o_db->query("INSERT INTO  ".DB_PREFIX."domain_gallery (domainid,galleryid,active,home) SELECT $i_domainid,galleryid,active,home FROM ".DB_PREFIX."domain_gallery WHERE domainid = ".DEFAULT_DOMAINID);

			//-- add into faq
			$o_db->query("INSERT INTO  ".DB_PREFIX."domain_faq (domainid,faqid,active,home) SELECT $i_domainid,faqid,active,home FROM ".DB_PREFIX."domain_faq WHERE domainid = ".DEFAULT_DOMAINID);

			//-- fix ordon faq
			$a_faq = db_get('faq',array('orderby'=>'faqid'));

			$a_ordon = array();
			for ($i=0;$i<count($a_faq);$i++) $a_ordon[] = $i+1;
			shuffle($a_ordon);
			
			for ($i=0;$i<count($a_faq);$i++) 
			$o_db->query("UPDATE ".DB_PREFIX."domain_faq SET ordon = ".$a_ordon[$i]." WHERE domainid = ".$i_domainid." AND faqid = ".$a_faq[$i]['faqid']);

            //-- update ordon
            for ($j=0;$j<count($a_category);$j++)
            {
                $a_article = db_get('article',array('orderby'=>'title'),array('categoryid'=>$a_category[$j]['categoryid']));
                
                $a_ordon = array();
                for ($i=0;$i<count($a_article);$i++) $a_ordon[] = $i+1;
                shuffle($a_ordon);
                
                for ($i=0;$i<count($a_article);$i++) 
                $o_db->query("UPDATE ".DB_PREFIX."domain_article SET ordon = ".$a_ordon[$i]." WHERE domainid = ".$i_domainid." AND articleid = ".$a_article[$i]['articleid']);
				
				//-- fix ordon gallery
				$a_gallery = db_get('gallery',array('orderby'=>'galleryid'),array('categoryid'=>$a_category[$j]['categoryid']));

				$a_ordon = array();
                for ($i=0;$i<count($a_gallery);$i++) $a_ordon[] = $i+1;
                shuffle($a_ordon);
                
                for ($i=0;$i<count($a_gallery);$i++) 
                $o_db->query("UPDATE ".DB_PREFIX."domain_gallery SET ordon = ".$a_ordon[$i]." WHERE domainid = ".$i_domainid." AND galleryid = ".$a_gallery[$i]['galleryid']);                
            }

            //-- add into lang
            $o_db->query("INSERT INTO ".DB_PREFIX."lang (domainid,lang_name,lang_value) SELECT $i_domainid,lang_name,lang_value FROM ".DB_PREFIX."lang WHERE domainid = ".DEFAULT_DOMAINID);
        }       
    break;
    case 'mod':      
      db_mod('domain',array('name'=>$attributes['name'],'url'=>$attributes['url'],
                            'path'=>$attributes['path'],
                            'ordon'=>intVal($attributes['ordon'])),$attributes['domainid']);
    break;
    case 'del':
        if ($attributes['domainid']!=DEFAULT_DOMAINID)
        {
            db_del('domain',$attributes['domainid']);

            //-- delete from config
            $o_db->query("DELETE FROM  ".DB_PREFIX."config WHERE domainid = ".$attributes['domainid']);
            //-- delete from page
            $o_db->query("DELETE FROM  ".DB_PREFIX."domain_page WHERE domainid = ".$attributes['domainid']);
            //-- delete from category
            $o_db->query("DELETE FROM  ".DB_PREFIX."domain_category WHERE domainid = ".$attributes['domainid']);
            //-- delete from article
            $o_db->query("DELETE FROM  ".DB_PREFIX."domain_article WHERE domainid = ".$attributes['domainid']);
			//-- delete from gallery
            $o_db->query("DELETE FROM  ".DB_PREFIX."domain_gallery WHERE domainid = ".$attributes['domainid']);
			//-- delete from faq
            $o_db->query("DELETE FROM  ".DB_PREFIX."domain_faq WHERE domainid = ".$attributes['domainid']);

            //-- delete from article comment
            $o_db->query("DELETE FROM  ".DB_PREFIX."article_comment WHERE domainid = ".$attributes['domainid']); 
            //-- delete from keyword
            $o_db->query("DELETE FROM  ".DB_PREFIX."keyword WHERE domainid = ".$attributes['domainid']);
            //-- delete from tag
            $o_db->query("DELETE FROM  ".DB_PREFIX."tag WHERE domainid = ".$attributes['domainid']);
             //-- delete from lang
            $o_db->query("DELETE FROM  ".DB_PREFIX."lang WHERE domainid = ".$attributes['domainid']);
             //-- delete from adsense
            $o_db->query("DELETE FROM  ".DB_PREFIX."adsense WHERE domainid = ".$attributes['domainid']);
            //-- delete from link
            $o_db->query("DELETE FROM  ".DB_PREFIX."link WHERE domainid = ".$attributes['domainid']);
            //-- delete from banner
            $o_db->query("DELETE FROM  ".DB_PREFIX."banner WHERE domainid = ".$attributes['domainid']);

            $_SESSION['domainid'] = DEFAULT_DOMAINID;

            //-- deldir _template_c  and _cache
        }
    break;
    case 'cache':
        if (empty($attributes['cache'])) $attributes['cache'] = array();
        db_modFlag('domain','cache',$attributes['domainid'],$attributes['cache']);
    break;
    case 'change':
        $_SESSION['domainid'] = $attributes['new_domainid'];
        $str_location = 'index.php?page='.$attributes['oldpage'];
    break;
    default:
       die();
    break;

}
$_SESSION['success'] = $b_success;
header('Location: '.$str_location);
?>