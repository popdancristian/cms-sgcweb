<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from d:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template/module_script_bottom.html */ ?>
<?php $_from = $this->_tpl_vars['a_script']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php if (( in_array ( 'bottom' , $this->_tpl_vars['a_item']['a_position'] ) )): ?><?php echo $this->_tpl_vars['a_item']['content']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?>