<?php
$o_db->query('UPDATE '.DB_PREFIX.'banner SET clicks = clicks+1 WHERE bannerid='.intval($attributes['bannerid']));
die();
?>