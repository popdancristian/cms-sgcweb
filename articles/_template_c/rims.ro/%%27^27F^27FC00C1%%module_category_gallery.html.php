<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from module_category_gallery.html */ ?>
<?php echo '<div class="category"><ul>'; ?><?php $_from = $this->_tpl_vars['a_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo '<li><a href="'; ?><?php echo $this->_tpl_vars['a_item']['url_gallery']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['_l']['gallery']; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['a_item']['fulltitle']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '</a></li>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</ul></div>'; ?>