<?php
set_time_limit(0);
include_once '../_conf/config.php';//-- include config

//-- include libraries
include_once PATH_LIB.DIR_SEP.'db.lib.php';

//-- get categories
$a_category = db_get('category',array('orderby'=>'title'));

//-- update keyword & tag
for ($j=0;$j<count($a_category);$j++)
{
  $o_db->query("UPDATE ".DB_PREFIX."keyword SET categoryid = ".$a_category[$j]['categoryid']." WHERE (name like '%".strtolower($a_category[$j]['title'])."%' or alias like '%".strtolower($a_category[$j]['title'])."%') AND categoryid = 0");

  $o_db->query("UPDATE ".DB_PREFIX."tag SET categoryid = ".$a_category[$j]['categoryid']." WHERE name like '%".strtolower($a_category[$j]['title'])."%' AND categoryid = 0");
}

echo 'Done';
?>