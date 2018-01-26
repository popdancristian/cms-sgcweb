<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from module_keyword_best.html */ ?>
<?php $_from = $this->_tpl_vars['a_keyword_best']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?> <a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_item']['name']; ?>
"><?php echo $this->_tpl_vars['a_item']['name_keyword']; ?>
</a> <?php endforeach; endif; unset($_from); ?>