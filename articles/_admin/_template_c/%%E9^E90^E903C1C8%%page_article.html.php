<?php /* Smarty version 2.6.22, created on 2012-08-20 21:45:01
         compiled from I:%5CUSBWebserver%5Croot%5Cjaluzele-cluj.com%5Carticles%5C_admin%5C_template/page_article.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsearch.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "grid.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br/><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
&action=addmod<?php if (( ! empty ( $this->_tpl_vars['str_search_param'] ) )): ?><?php echo $this->_tpl_vars['str_search_param']; ?>
<?php endif; ?>" class="action">Add</a>