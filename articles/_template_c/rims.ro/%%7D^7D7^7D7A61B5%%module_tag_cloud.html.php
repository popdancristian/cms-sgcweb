<?php /* Smarty version 2.6.22, created on 2013-02-05 02:03:42
         compiled from module_tag_cloud.html */ ?>
<?php $_from = $this->_tpl_vars['a_tag_cloud']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?> <span style='font-size: 1.<?php echo $this->_tpl_vars['a_item']['total']; ?>
em'><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_item']['name']; ?>
"><?php echo $this->_tpl_vars['a_item']['name']; ?>
</a></span><?php endforeach; endif; unset($_from); ?>