<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from module_menu_bottom.html */ ?>
<?php echo ''; ?><?php $_from = $this->_tpl_vars['a_page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo ''; ?><?php if (( in_array ( 'bottom' , $this->_tpl_vars['a_item']['a_menu'] ) )): ?><?php echo ' <a href="'; ?><?php echo $this->_tpl_vars['a_item']['url']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['a_item']['menu']; ?><?php echo '" class="link">'; ?><?php echo $this->_tpl_vars['a_item']['menu']; ?><?php echo '</a> &nbsp; '; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>