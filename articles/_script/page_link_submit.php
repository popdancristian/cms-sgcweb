<?php
$o_db->query('UPDATE '.DB_PREFIX.'link SET clicks = clicks+1 WHERE linkid='.intval($attributes['linkid']));
die();
?>