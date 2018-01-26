<?php
//-- define login cookie info
$_COOKIE_EXPIRE = 60*60;
$_COOKIE_NAME   = md5(URL_SITE);

//-- define pages const
DEFINE ('DEFAULT_PAGE_LIMIT',20);
DEFINE ('DEFAULT_PAGE_COUNT',30);

//-- avalilable modules
$_MODULE = array('domain','config','page','category','article','gallery','faq','link','banner','keyword','analytics','tag','adsense','script','lang','comment','sitemap','util','url','dbform','log');

//-- avalilable positions
$_POSITION = array(
                   'top'=>_l('top'),
                   'left'=>_l('left'),
                   'right'=>_l('right'),
                   'bottom'=>_l('bottom'),
                   'center'=>_l('center'),
                   'topleft'=>_l('topleft'),
                   'topright'=>_l('topright'),
                   'centerleft'=>_l('centerleft'),
                   'centerright'=>_l('centerright'),
                   'bottomleft'=>_l('bottomleft'),
                   'bottomright'=>_l('bottomright')
                  );

$_CATEGORY_ORDON = array('ordon'=>$_l['ordon'],'title'=>$_l['title'],'categoryid'=>$_l['id'],'total'=>$_l['total']);
$_ARTICLE_ORDON = array('ordon'=>$_l['ordon'],'title'=>$_l['title'],'articleid'=>$_l['id'],'datepublished'=>$_l['published'],'dateadded'=>$_l['added'],'total'=>$_l['total']);
?>