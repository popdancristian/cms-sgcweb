<?php /* Smarty version 2.6.22, created on 2016-03-25 07:21:24
         compiled from e:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template/module_script_top.html */ ?>
<?php $_from = $this->_tpl_vars['a_script']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php if (( in_array ( 'top' , $this->_tpl_vars['a_item']['a_position'] ) )): ?><?php echo $this->_tpl_vars['a_item']['content']; ?>
<?php endif; ?><?php endforeach; endif; unset($_from); ?>