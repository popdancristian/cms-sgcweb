<?php /* Smarty version 2.6.22, created on 2013-02-05 16:00:44
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_all.html */ ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['menu']; ?>
</h1>
<?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['content']; ?>

</div>
<div class="navigator">
<?php $_from = $this->_tpl_vars['a_letter_index']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_key'] => $this->_tpl_vars['a_item']):
?>
 <a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_item']['name']; ?>
"<?php if (( $this->_tpl_vars['str_letter'] == $this->_tpl_vars['str_key'] )): ?> class="current"<?php endif; ?>>&nbsp;<?php echo $this->_tpl_vars['a_item']['name']; ?>
&nbsp;</a> 
<?php endforeach; endif; unset($_from); ?>
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