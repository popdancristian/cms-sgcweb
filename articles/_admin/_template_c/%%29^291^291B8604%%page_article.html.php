<?php /* Smarty version 2.6.22, created on 2018-01-26 06:37:31
         compiled from d:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles/_admin%5C_template/page_article.html */ ?>
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