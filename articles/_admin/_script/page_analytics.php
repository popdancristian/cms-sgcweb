<?php
include_once PATH_CLASS.DIR_SEP.'Analytics.class.php';

//-- define and assign search form
$a_form_search = array
(
 'name'=>'frmSearch',
 'title'=>_l('search'),
 'row'=>array(
               'startdate'=>array('caption'=>_l('startdate'),'type'=>'date'),
               'enddate'=>array('caption'=>_l('enddate'),'type'=>'date')
             ),
 'button'=>_l('search')
);

$o_smarty->assign("a_form_search",$a_form_search); 
$o_smarty->assign("b_calendar",true);

if (!empty($a_search['a_param']['startdate']) and !empty($a_search['a_param']['enddate']))
{
    // construct the class
    $oAnalytics = new analytics($_CONFIG['google_email'], $_CONFIG['google_password']);

    // set it up to use caching
    $oAnalytics->useCache();

    $oAnalytics->setProfileById('ga:'.$_CONFIG['google_profile_id']);

    // set the date range
    $oAnalytics->setDateRange($a_search['a_param']['startdate'], $a_search['a_param']['enddate']);

    $a_data = $oAnalytics->getData(array('dimensions' => 'ga:keyword',
                                         'metrics'    => 'ga:visits',
                                         'sort'       => '-ga:visits',
                                         'max-results'=> '1000'));
    $o_smarty->assign("a_data",$a_data);
}
?>