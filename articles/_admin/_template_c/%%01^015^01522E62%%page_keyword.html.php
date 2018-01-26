<?php /* Smarty version 2.6.22, created on 2012-10-12 09:07:59
         compiled from I:%5CUSBWebserver%5Croot%5Cjaluzele-cluj.com%5Carticles/_admin%5C_template/page_keyword.html */ ?>
<form method="GET" action="index.php" name="">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['page']; ?>
">
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['search']; ?>
</legend>
<table border="0" cellspacing="1" cellpadding="1">
<tr>
 <td><?php echo $this->_tpl_vars['_l']['name']; ?>
:</td>
 <td>
  <input name="search[name]" value="<?php if (( isset ( $this->_tpl_vars['a_search']['name'] ) )): ?><?php echo $this->_tpl_vars['a_search']['name']; ?>
<?php endif; ?>">
 </td>
 <td><?php echo $this->_tpl_vars['_l']['active']; ?>
:</td>
 <td>
  <select name="search[active]">
   <option value="" <?php if (( ! isset ( $this->_tpl_vars['a_search']['active'] ) )): ?> selected="selected"<?php endif; ?>>All</option>
   <option value="0" <?php if (( isset ( $this->_tpl_vars['a_search']['active'] ) && ( 0 == $this->_tpl_vars['a_search']['active'] ) )): ?> selected="selected"<?php endif; ?>>No</option>
   <option value="1" <?php if (( isset ( $this->_tpl_vars['a_search']['active'] ) && ( 1 == $this->_tpl_vars['a_search']['active'] ) )): ?> selected="selected"<?php endif; ?>>Yes</option>
  </select>
 </td>
 <td><?php echo $this->_tpl_vars['_l']['completed']; ?>
:</td>
 <td>
  <select name="search[completed]">
   <option value="" <?php if (( ! isset ( $this->_tpl_vars['a_search']['completed'] ) )): ?> selected="selected"<?php endif; ?>>All</option>
   <option value="0" <?php if (( isset ( $this->_tpl_vars['a_search']['completed'] ) && ( 0 == $this->_tpl_vars['a_search']['completed'] ) )): ?> selected="selected"<?php endif; ?>>No</option>
   <option value="1" <?php if (( isset ( $this->_tpl_vars['a_search']['completed'] ) && ( 1 == $this->_tpl_vars['a_search']['completed'] ) )): ?> selected="selected"<?php endif; ?>>Yes</option>
  </select>
 </td>
 <td><?php echo $this->_tpl_vars['_l']['total']; ?>
:</td>
 <td>
  ><input name="search[total]" value="<?php if (( isset ( $this->_tpl_vars['a_search']['total'] ) )): ?><?php echo $this->_tpl_vars['a_search']['total']; ?>
<?php endif; ?>">
 </td>
 <td><button type="submit"><?php echo $this->_tpl_vars['_l']['search']; ?>
</button></td>
</tr>
</table>
</fieldset>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "grid.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&action=addmod" class="action">Add</a>
<?php $this->assign('a_form', ($this->_tpl_vars['a_form_import'])); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "form.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>