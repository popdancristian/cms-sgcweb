<?php
$meta_title = $a_page[$page]['title'];
$meta_description = $a_page[$page]['description'];
if (!empty($a_page[$page]['a_tag'])) 
{
    $meta_keyword = array_merge($a_page[$page]['a_tag'],$meta_keyword);
    $a_tag_cloud = array_merge($a_page[$page]['a_tag'],$a_tag_cloud);
}
?>