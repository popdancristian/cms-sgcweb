<?php /* Smarty version 2.6.22, created on 2013-02-05 02:49:47
         compiled from I:%5CUSBWebserver%5Croot%5Crims.ro%5Carticles%5C_template/module_script_bottom.html */ ?>
<?php $_from = $this->_tpl_vars['a_script']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php if (( in_array ( 'bottom' , $this->_tpl_vars['a_item']['a_position'] ) )): ?><?php echo $this->_tpl_vars['a_item']['content']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?>