<?php /* Smarty version 2.6.22, created on 2013-02-06 01:37:07
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_search.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'f:\\USBWebserver v8.5\\8.5\\root\\rims.ro/articles\\_template\\articles-1\\page_search.html', 3, false),)), $this); ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['search_keyword']; ?>
</h1>
<?php echo ((is_array($_tmp=$this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['content'])) ? $this->_run_mod_handler('replace', true, $_tmp, '[category_title]', $this->_tpl_vars['search_keyword']) : smarty_modifier_replace($_tmp, '[category_title]', $this->_tpl_vars['search_keyword'])); ?>

<p class="post-footer align-right"><?php echo $this->_tpl_vars['search_keyword']; ?>
</p>
</div>
<?php if (( ! empty ( $this->_tpl_vars['a_gallery_best'] ) )): ?>
<div class="description">
 <h1><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle']; ?>
</h1>
<?php $_from = $this->_tpl_vars['a_gallery_best']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
 <div class="gallery"><a rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['search_keyword']; ?>
"><img src="<?php echo $this->_tpl_vars['a_image']['imageurl']; ?>
" width="130" height="97" border="0" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['search_keyword']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>" alt="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['search_keyword']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>"/></a></div>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>
<p class="post-footer align-right"><a href="<?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['url_gallery']; ?>
" title="<?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle']; ?>
"><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
</a></p>
</div>
<?php endif; ?>
<?php $this->assign('b_article_category', '1'); ?>
<?php $this->assign('navigator_title', ($this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['title'])); ?>
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
<div class="description"><p><?php echo ((is_array($_tmp=$this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, '[category_title]', $this->_tpl_vars['search_keyword']) : smarty_modifier_replace($_tmp, '[category_title]', $this->_tpl_vars['search_keyword'])); ?>
</p></div>