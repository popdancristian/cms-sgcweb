<?php /* Smarty version 2.6.22, created on 2018-01-26 06:37:31
         compiled from formsearch.html */ ?>
<fieldset>
<legend><?php echo $this->_tpl_vars['a_form_search']['title']; ?>
</legend>
<form method="GET" action="<?php if (( empty ( $this->_tpl_vars['a_form_search']['actionscript'] ) )): ?>index.php<?php else: ?><?php echo $this->_tpl_vars['a_form_search']['actionscript']; ?>
<?php endif; ?>" name="<?php echo $this->_tpl_vars['a_form_search']['name']; ?>
">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
<table border="0" cellspacing="1" cellpadding="1">
 <tr>
<?php $_from = $this->_tpl_vars['a_form_search']['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_key'] => $this->_tpl_vars['a_row']):
?>
 <?php if (( $this->_tpl_vars['a_row']['type'] == 'textbox' )): ?>
  <td class="td"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><input type="text" name="search[<?php echo $this->_tpl_vars['str_key']; ?>
]" id="search_<?php echo $this->_tpl_vars['str_key']; ?>
" style="width:<?php if (( ! empty ( $this->_tpl_vars['a_row']['width'] ) )): ?><?php echo $this->_tpl_vars['a_row']['width']; ?>
<?php else: ?>150<?php endif; ?>px;" value="<?php if (( isset ( $this->_tpl_vars['a_search'][$this->_tpl_vars['str_key']] ) )): ?><?php echo $this->_tpl_vars['a_search'][$this->_tpl_vars['str_key']]; ?>
<?php endif; ?>">
 <?php elseif (( $this->_tpl_vars['a_row']['type'] == 'select' )): ?>
  <td class="td"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td">
   <select name="search[<?php echo $this->_tpl_vars['str_key']; ?>
]" id="search_<?php echo $this->_tpl_vars['str_key']; ?>
"> 
   <?php $_from = $this->_tpl_vars['a_row']['a_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_value'] => $this->_tpl_vars['str_caption']):
?><option value="<?php echo $this->_tpl_vars['str_value']; ?>
"<?php if (( ( isset ( $this->_tpl_vars['a_search'][$this->_tpl_vars['str_key']] ) ) && ( $this->_tpl_vars['a_search'][$this->_tpl_vars['str_key']] == $this->_tpl_vars['str_value'] ) )): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['str_caption']; ?>
</option><?php endforeach; endif; unset($_from); ?>
   </select>
<?php elseif (( $this->_tpl_vars['a_row']['type'] == 'date' )): ?>
  <td class="td"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><input type="text" value="<?php if (( isset ( $this->_tpl_vars['a_search'][$this->_tpl_vars['str_key']] ) )): ?><?php echo $this->_tpl_vars['a_search'][$this->_tpl_vars['str_key']]; ?>
<?php endif; ?>" readonly name="search[<?php echo $this->_tpl_vars['str_key']; ?>
]" id="search_<?php echo $this->_tpl_vars['str_key']; ?>
"><input type="button" value="..." onclick="displayCalendar(document.forms[0].search_<?php echo $this->_tpl_vars['str_key']; ?>
,'yyyy-mm-dd',this)"></td>
 <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<td><button type="submit"><?php echo $this->_tpl_vars['a_form_search']['button']; ?>
</button></td>
</tr>
</table>
</form>
</fieldset>