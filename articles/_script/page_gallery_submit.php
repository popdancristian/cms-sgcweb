<?php
$o_db->query('UPDATE '.DB_PREFIX.'domain_gallery SET total = total+1 WHERE domainid='.intval($_DOMAIN['domainid']).' AND galleryid='.intval($attributes['galleryid']));
die();
?>