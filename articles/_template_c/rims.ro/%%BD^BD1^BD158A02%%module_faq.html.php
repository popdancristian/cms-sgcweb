<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from module_faq.html */ ?>
<?php echo ''; ?><?php $_from = $this->_tpl_vars['a_faq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo ''; ?><?php if (( $this->_tpl_vars['a_item']['home'] == 1 )): ?><?php echo '<a href="'; ?><?php echo $this->_tpl_vars['a_item']['url']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '</a><br/>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>