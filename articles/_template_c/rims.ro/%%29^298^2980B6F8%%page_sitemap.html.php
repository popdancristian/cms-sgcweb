<?php /* Smarty version 2.6.22, created on 2014-03-16 11:08:38
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_sitemap.html */ ?>
<?php echo '<div class="description"><h1>'; ?><?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['menu']; ?><?php echo '</h1><p>'; ?><?php $_from = $this->_tpl_vars['a_page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i_key'] => $this->_tpl_vars['a_item']):
?><?php echo '<a href="'; ?><?php echo $this->_tpl_vars['a_item']['url']; ?><?php echo '"  title="'; ?><?php echo $this->_tpl_vars['a_item']['menu']; ?><?php echo '"><b>'; ?><?php echo $this->_tpl_vars['a_item']['menu']; ?><?php echo '</b></a><br/>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</p></div><div class="description"><h1>'; ?><?php echo $this->_tpl_vars['_l']['categoriesarticles']; ?><?php echo '</h1><p>'; ?><?php $_from = $this->_tpl_vars['a_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo '<a href="'; ?><?php echo $this->_tpl_vars['a_item']['url_sitemap']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['a_item']['fulltitle']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '</a><br/>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</p></div>'; ?><?php if (( ! empty ( $this->_tpl_vars['a_category_article'] ) )): ?><?php echo '<div class="description"><h1>'; ?><?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle']; ?><?php echo '</h1><p>'; ?><?php $_from = $this->_tpl_vars['a_category_article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo '<a href="'; ?><?php echo $this->_tpl_vars['a_item']['url']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '</a><br/>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</p></div>'; ?><?php endif; ?><?php echo '<div class="description"><h1>'; ?><?php echo $this->_tpl_vars['_l']['gallery']; ?><?php echo '</h1><p>'; ?><?php $_from = $this->_tpl_vars['a_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo '<a href="'; ?><?php echo $this->_tpl_vars['a_item']['url_gallery']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['a_item']['fulltitle']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '</a><br/>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</p></div><div class="description"><h1>'; ?><?php echo $this->_tpl_vars['_l']['faq']; ?><?php echo '</h1><p>'; ?><?php $_from = $this->_tpl_vars['a_faq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><?php echo '<a href="'; ?><?php echo $this->_tpl_vars['a_item']['url']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['a_item']['title']; ?><?php echo '</a><br/>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</p></div><div class="description">'; ?><?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['content']; ?><?php echo '</div>'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_article_category_last.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>