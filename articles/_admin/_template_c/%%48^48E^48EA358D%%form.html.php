<?php /* Smarty version 2.6.22, created on 2018-01-26 06:36:13
         compiled from form.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count_characters', 'form.html', 29, false),)), $this); ?>
<fieldset>
<legend><?php echo $this->_tpl_vars['a_form']['title']; ?>
</legend>
<form method="POST" action="<?php if (( empty ( $this->_tpl_vars['a_form']['actionscript'] ) )): ?>index.php<?php else: ?><?php echo $this->_tpl_vars['a_form']['actionscript']; ?>
<?php endif; ?>" name="<?php echo $this->_tpl_vars['a_form']['name']; ?>
">
<input type="hidden" name="submit" value="1">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
<input type="hidden" name="action" value="<?php echo $this->_tpl_vars['a_form']['action']; ?>
">
<input type="hidden" name="<?php echo $this->_tpl_vars['a_form']['id']; ?>
" value="<?php echo $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['a_form']['id']]; ?>
">
<?php if (( ! empty ( $this->_tpl_vars['a_form']['hidden'] ) )): ?>
 <?php $_from = $this->_tpl_vars['a_form']['hidden']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_hidden_key'] => $this->_tpl_vars['a_hidden']):
?>
<input type="hidden" name="<?php echo $this->_tpl_vars['a_hidden']['name']; ?>
" value="<?php echo $this->_tpl_vars['a_hidden']['value']; ?>
">
 <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_search'] ) )): ?>
<?php $_from = $this->_tpl_vars['a_search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_search_key'] => $this->_tpl_vars['str_search_value']):
?>
<input type="hidden" name="search[<?php echo $this->_tpl_vars['str_search_key']; ?>
]" value="<?php echo $this->_tpl_vars['str_search_value']; ?>
">
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<table border="0" align="center" bgcolor="#DDDDDD" cellspacing="1" cellpadding="1" width="100%">
<?php $_from = $this->_tpl_vars['a_form']['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_key'] => $this->_tpl_vars['a_row']):
?>
 <tr>
 <?php if (( $this->_tpl_vars['a_row']['type'] == 'textbox' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><input type="text" name="<?php echo $this->_tpl_vars['str_key']; ?>
" id="<?php echo $this->_tpl_vars['str_key']; ?>
" style="width:<?php if (( ! empty ( $this->_tpl_vars['a_row']['width'] ) )): ?><?php echo $this->_tpl_vars['a_row']['width']; ?>
<?php else: ?>400<?php endif; ?>px;" value="<?php echo $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']]; ?>
">
 <?php elseif (( $this->_tpl_vars['a_row']['type'] == 'password' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><input type="password" name="<?php echo $this->_tpl_vars['str_key']; ?>
" id="<?php echo $this->_tpl_vars['str_key']; ?>
" style="width:<?php if (( ! empty ( $this->_tpl_vars['a_row']['width'] ) )): ?><?php echo $this->_tpl_vars['a_row']['width']; ?>
<?php else: ?>400<?php endif; ?>px;" value="">
 <?php elseif (( $this->_tpl_vars['a_row']['type'] == 'textarea' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><textarea name="<?php echo $this->_tpl_vars['str_key']; ?>
" id="<?php echo $this->_tpl_vars['str_key']; ?>
" style="width:<?php if (( ! empty ( $this->_tpl_vars['a_row']['width'] ) )): ?><?php echo $this->_tpl_vars['a_row']['width']; ?>
<?php else: ?>400<?php endif; ?>px;height:<?php if (( ! empty ( $this->_tpl_vars['a_row']['height'] ) )): ?><?php echo $this->_tpl_vars['a_row']['height']; ?>
<?php else: ?>70<?php endif; ?>px;" onkeyup="showNrChar('<?php echo $this->_tpl_vars['str_key']; ?>
','<?php echo $this->_tpl_vars['str_key']; ?>
_chars')" onmouseup="showNrChar('<?php echo $this->_tpl_vars['str_key']; ?>
','<?php echo $this->_tpl_vars['str_key']; ?>
_chars')"><?php echo $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']]; ?>
</textarea>&nbsp;(<span id="<?php echo $this->_tpl_vars['str_key']; ?>
_chars"><b><?php echo smarty_modifier_count_characters($this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']], true); ?>
</b></span>)&nbsp;
 <?php elseif (( $this->_tpl_vars['a_row']['type'] == 'radio' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td">
   <?php $_from = $this->_tpl_vars['a_row']['a_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_value'] => $this->_tpl_vars['str_caption']):
?><input type="radio" name="<?php echo $this->_tpl_vars['str_key']; ?>
" value="<?php echo $this->_tpl_vars['str_value']; ?>
"<?php if (( $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']] == $this->_tpl_vars['str_value'] )): ?> checked="checked"<?php endif; ?>><?php echo $this->_tpl_vars['str_caption']; ?>
<?php endforeach; endif; unset($_from); ?>
 <?php elseif (( $this->_tpl_vars['a_row']['type'] == 'checkbox' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td">
   <?php $_from = $this->_tpl_vars['a_row']['a_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_value'] => $this->_tpl_vars['str_caption']):
?><input type="checkbox" name="<?php echo $this->_tpl_vars['str_key']; ?>
[]" value="<?php echo $this->_tpl_vars['str_value']; ?>
"<?php if (( in_array ( $this->_tpl_vars['str_value'] , $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']] ) )): ?> checked="checked"<?php endif; ?>><?php echo $this->_tpl_vars['str_caption']; ?>
<?php endforeach; endif; unset($_from); ?>
<?php elseif (( $this->_tpl_vars['a_row']['type'] == 'select' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td">
   <select name="<?php echo $this->_tpl_vars['str_key']; ?>
" id="<?php echo $this->_tpl_vars['str_key']; ?>
"> 
   <?php $_from = $this->_tpl_vars['a_row']['a_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_value'] => $this->_tpl_vars['str_caption']):
?><option value="<?php echo $this->_tpl_vars['str_value']; ?>
"<?php if (( $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']] == $this->_tpl_vars['str_value'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['str_caption']; ?>
</option><?php endforeach; endif; unset($_from); ?>
   </select>
<?php elseif (( $this->_tpl_vars['a_row']['type'] == 'date' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><input type="text" value="<?php echo $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']]; ?>
" readonly name="<?php echo $this->_tpl_vars['str_key']; ?>
"><input type="button" value="..." onclick="displayCalendar(document.forms[0].<?php echo $this->_tpl_vars['str_key']; ?>
,'yyyy-mm-dd',this)"></td>
<?php elseif (( $this->_tpl_vars['a_row']['type'] == 'text' )): ?>
  <td class="th"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</td>
  <td class="td"><?php echo $this->_tpl_vars['a_form']['data'][$this->_tpl_vars['str_key']]; ?>

<?php elseif (( $this->_tpl_vars['a_row']['type'] == 'editor' )): ?>
  <td class="td" colspan="2"><div class="th" style="padding: 2px;"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
:</div><?php echo $this->_tpl_vars['a_row']['editor']; ?>

<?php elseif (( $this->_tpl_vars['a_row']['type'] == 'section' )): ?>
  <td class="ts" colspan="2"><?php echo $this->_tpl_vars['a_row']['caption']; ?>
	
<?php endif; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_row']['tips'] ) )): ?><span class="tips">(<?php echo $this->_tpl_vars['a_row']['tips']; ?>
)</span><?php endif; ?>
 </td>
 </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<div style="padding-top: 5px;"><button type="submit"><?php echo $this->_tpl_vars['a_form']['button']; ?>
</button></div>
</form>
</fieldset>
<script language="javascript">
<!--//
// initialize the qForm object
objForm = new qForm("<?php echo $this->_tpl_vars['a_form']['name']; ?>
");
// make these fields required
<?php $_from = $this->_tpl_vars['a_form']['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_key'] => $this->_tpl_vars['a_row']):
?>
<?php if (( ! empty ( $this->_tpl_vars['a_row']['required'] ) )): ?>
 objForm.required("<?php echo $this->_tpl_vars['str_key']; ?>
");
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
//-->
</script>