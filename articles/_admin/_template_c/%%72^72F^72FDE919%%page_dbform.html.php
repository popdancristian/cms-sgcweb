<?php /* Smarty version 2.6.22, created on 2012-03-10 11:58:16
         compiled from H:%5CUSBWebserver%5Croot%5Cjaluzele-cluj.com%5Carticles%5C_admin%5C_template/page_dbform.html */ ?>
<table cellspacing="5" cellpadding="5" style="font-size:14px;">
<tr>
	<td><?php if (( $this->_tpl_vars['table'] == 'page' )): ?><b><?php echo $this->_tpl_vars['_l']['page']; ?>
</b><?php else: ?><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&table=page" class="link"><b><?php echo $this->_tpl_vars['_l']['page']; ?>
</b></a><?php endif; ?></td>
	<td><?php if (( $this->_tpl_vars['table'] == 'category' )): ?><b><?php echo $this->_tpl_vars['_l']['category']; ?>
</b><?php else: ?><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&table=category" class="link"><b><?php echo $this->_tpl_vars['_l']['category']; ?>
</b></a><?php endif; ?></td>
	<td><?php if (( $this->_tpl_vars['table'] == 'article' )): ?><b><?php echo $this->_tpl_vars['_l']['article']; ?>
</b><?php else: ?><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&table=article" class="link"><b><?php echo $this->_tpl_vars['_l']['article']; ?>
</b></a><?php endif; ?></td>
</tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "grid.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&table=<?php echo $this->_tpl_vars['table']; ?>
&action=addmod" class="action">Add</a>