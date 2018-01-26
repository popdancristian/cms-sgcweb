<?php
if (!empty($attributes['action']))
{
    switch ($attributes['action'])
    {
        case 'raty':         
            $raty = isset($attributes['raty']) ? intval($attributes['raty']) : 0;

            if (!empty($raty))
            {
                $articleid = isset($attributes['articleid']) ? intval($attributes['articleid']) : 0;

                //-- get article
                $a_article = db_search('article',array(      
                                                        'articleid'=>$attributes['articleid'],
                                                        'active'=>1,
                                                        'publish'=>1,
                                                        'domainid'=>ID_DOMAIN
                                                      ));

                if (empty($a_article)) page_error404(); //-- check the page

                if ($a_article[0]['raty'] != 0) $raty = ($raty+$a_article[0]['raty'])/2;

                //-- update raty and total raty
                $o_db->query('UPDATE '.DB_PREFIX.'domain_article SET totalraty = totalraty+1,raty = '.$raty.' WHERE domainid = '.ID_DOMAIN.' AND articleid='.$articleid);
                
            }
            die();
        break;

        case 'addcomment':

            $articleid = isset($attributes['articleid']) ? intval($attributes['articleid']) : 0;
            if (!empty($articleid))
            {   
                //-- get article
                $a_article = db_search('article',array(      
                                                        'articleid'=>$attributes['articleid'],
                                                        'active'=>1,
                                                        'publish'=>1,
                                                        'domainid'=>ID_DOMAIN
                                                      ));

                if (empty($a_article)) page_error404(); //-- check the page

                article_prepare($a_article);//-- prepare article

                $str_name = htmlspecialchars($attributes['name']);
                $str_comment = htmlspecialchars($attributes['comment']);

                $pos = strpos($str_comment, 'http');
                if ( ($pos === false) and (strlen($str_comment)<500) )
                {
                  $o_db->query("insert into cms_article_comment (articleid,domainid,name,comment,dateadd,ip) values (".$articleid.",".ID_DOMAIN.",'".$str_name."','".substr($str_comment,0,1500)."',now(),'".$_SERVER['REMOTE_ADDR']."')");
                }
                header('Location: '.$a_article[0]['url']);
                die();
            }
        break;

    }
}

/*
//-- get and assign the category

*/
?>