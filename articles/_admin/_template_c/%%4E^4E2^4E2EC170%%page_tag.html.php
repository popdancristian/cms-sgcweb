<?php /* Smarty version 2.6.22, created on 2011-12-11 17:18:28
         compiled from /home/dorufabr/public_html/games/_admin/_template/page_tag.html */ ?>
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