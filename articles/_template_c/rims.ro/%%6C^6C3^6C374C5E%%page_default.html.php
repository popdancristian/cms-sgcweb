<?php /* Smarty version 2.6.22, created on 2016-03-25 07:17:44
         compiled from e:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_default.html */ ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['title']; ?>
</h1>
<?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['content']; ?>

</div>
<?php $this->assign('navigator_title', ($this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['title'])); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_navigator.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_article.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_navigator.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>