<?php /* Smarty version 2.6.22, created on 2012-03-10 12:10:53
         compiled from H:%5CUSBWebserver%5Croot%5Cjaluzele-cluj.com%5Carticles%5C_admin%5C_template/page_analytics.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsearch.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['result']; ?>
</legend>
<textarea style="width:500px;height:200px;">
<?php $_from = $this->_tpl_vars['a_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_key'] => $this->_tpl_vars['i_item']):
?><?php echo $this->_tpl_vars['str_key']; ?>

<?php endforeach; endif; unset($_from); ?>
</textarea>
</fieldset>