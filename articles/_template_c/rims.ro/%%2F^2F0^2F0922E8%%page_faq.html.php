<?php /* Smarty version 2.6.22, created on 2017-10-26 07:32:19
         compiled from d:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_faq.html */ ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['meta_title']; ?>
</h1>
<?php if (empty ( $this->_tpl_vars['a_faqq'] )): ?>
<?php $_from = $this->_tpl_vars['a_faqqs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?>
    <h3><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_item']['title']; ?>
"><?php echo $this->_tpl_vars['a_item']['title']; ?>
</a></h3>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<?php echo $this->_tpl_vars['a_faqq']['content']; ?>

<p class="post-footer align-right"><?php $_from = $this->_tpl_vars['a_faqq']['a_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_tag']):
?> <?php echo $this->_tpl_vars['str_tag']; ?>
 <?php endforeach; endif; unset($_from); ?></p>
<?php endif; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_gallery_best'] ) )): ?>
<?php $_from = $this->_tpl_vars['a_gallery_best']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
 <div class="gallery"><a rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['search_keyword']; ?>
"><img src="<?php echo $this->_tpl_vars['a_image']['imageurl']; ?>
" border="0" width="130" height="97" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
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
" class="details"><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['title']; ?>
</a></p>
<?php endif; ?>
</div>