<?php
switch ($attributes['action'])
{
  case 'mod':          
      $a_result = $o_db->getAll("SELECT * from ".DB_PREFIX."lang WHERE domainid = ".$_SESSION['domainid']);   
      for ($i=0;$i<count($a_result);$i++) 
      {
       $o_db->query("UPDATE ".DB_PREFIX."lang SET lang_value='".$attributes['l_'.$a_result[$i]['lang_name']]."' WHERE lang_name = '".$a_result[$i]['lang_name']."' AND domainid = ".$_SESSION['domainid']);
      }
  break;  
}
$_SESSION['success'] = true;//-- success
header('Location: index.php?page='.$page);
?>