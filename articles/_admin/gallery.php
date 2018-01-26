<?php
set_time_limit(0);
include_once '../_conf/config.php';//-- include config

//-- include libraries
include_once PATH_LIB.DIR_SEP.'db.lib.php';

//-- read gallery
$a_gallery = db_get('gallery',array('orderby'=>'galleryid'));

$a_category_gallery = array();
for ($i=0;$i<count($a_gallery);$i++) 
{
	$a_category_gallery[$a_gallery[$i]['categoryid']][] = $a_gallery[$i]['image'].'.jpg';
	$a_category_gallery[$a_gallery[$i]['categoryid']][] = $a_gallery[$i]['image'].'b.jpg';
}

//-- update ordon random
$a_category = db_get('category',array('orderby'=>'title'));

$a_new = array();

$total = 0;
//-- read directories
for ($j=0;$j<count($a_category);$j++)
{
  if ($handle = opendir(PATH_SITE.'/_file/image/'.$a_category[$j]['directory'])) 
  {
    while (false !== ($entry = readdir($handle))) 
	{
        if ($entry != "." && $entry != ".." && (!is_dir(PATH_SITE.'/_file/image/'.$a_category[$j]['directory'].'/'.$entry))) 
		{
			if (!in_array($entry,$a_category_gallery[$a_category[$j]['categoryid']]))
			{
				$str_image = str_replace('b.jpg','',$entry);
				$str_image = str_replace('.jpg','',$str_image);
				if (!isset($a_new[$a_category[$j]['categoryid']])) $a_new[$a_category[$j]['categoryid']] = array();
				if (!in_array($str_image,$a_new[$a_category[$j]['categoryid']])) {$a_new[$a_category[$j]['categoryid']][] = $str_image;$total++;}
			}
        }
    }
    closedir($handle);
  }
}


//-- read domain
$a_domain = db_get('domain',array('orderby'=>'domainid'));

$i_ordon = $o_db->getOne("select max(ordon) from ".DB_PREFIX."domain_gallery");
$a_ordon = array();
for ($i=0;$i<$total;$i++) $a_ordon[] = $i_ordon+$i+1;

$a_ordon_domain = array();
for ($i=0;$i<count($a_domain);$i++)
{
	shuffle($a_ordon);
	$a_ordon_domain[$a_domain[$i]['domainid']] = $a_ordon;
}

if (!empty($a_new))
{
	$id = 0;
	foreach ($a_new as $i_categoryid=>$a_value)
	{
		foreach ($a_value as $str_image)
		{
			$o_db->query("INSERT IGNORE INTO ".DB_PREFIX."gallery(categoryid, image, dateadded, datemodified) VALUES (".$i_categoryid.",'".$str_image."',now(),now())");
			$i_galleryid = $o_db->insertId();
			if (!empty($i_galleryid))
			{
				echo $str_image."<br/>";
				for ($i=0;$i<count($a_domain);$i++)
				{	
					$o_db->query("INSERT IGNORE INTO ".DB_PREFIX."domain_gallery(domainid, galleryid, active, ordon) 
								  VALUES (".$a_domain[$i]['domainid'].",".$i_galleryid.",1,".$a_ordon_domain[$a_domain[$i]['domainid']][$id].")");
				}
			}
			$id++;
		}
	}
}
echo 'Done';
?>