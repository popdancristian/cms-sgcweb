<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty repeat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     repeat<br>
 * Purpose:  simple repeat
 * @param string
 * @param integer
 */
function smarty_modifier_string_repeat($string, $multiplier)
{
    return str_repeat($string,$multiplier);
}

/* vim: set expandtab: */

?>
