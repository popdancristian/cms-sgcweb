<?php /* Smarty version 2.6.22, created on 2014-03-16 11:02:32
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_category.html */ ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle']; ?>
</h1>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['content']; ?>

 <p class="post-footer align-right"><?php $_from = $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['a_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_tag']):
?> <?php echo $this->_tpl_vars['str_tag']; ?>
 <?php endforeach; endif; unset($_from); ?></p>
</div>
<?php if (( ! empty ( $this->_tpl_vars['a_gallery_best'][$this->_tpl_vars['categoryid']] ) )): ?>
<?php $_from = $this->_tpl_vars['a_gallery_best'][$this->_tpl_vars['categoryid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
<div class="gallery"><a rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
"><img src="<?php echo $this->_tpl_vars['a_image']['imageurl']; ?>
" border="0" width="130" height="97" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>" alt="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>"/></a></div>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<div class="clear"></div>
<p class="post-footer align-right"><a href="<?php echo @URL_SITE; ?>
/_file/file/<?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['directory']; ?>
.pdf" title="Oferta <?php echo $this->_tpl_vars['a_item']['fulltitle']; ?>
" target="_blank">Oferta <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
</a>&nbsp;<a href="<?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['url_gallery']; ?>
" title="<?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle']; ?>
"><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
</a></p>

<?php $this->assign('navigator_title', ($this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle'])); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_navigator.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_article.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_navigator.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (( ! empty ( $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['footer'] ) )): ?><div class="description"><p><?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['footer']; ?>
</p></div><?php endif; ?>