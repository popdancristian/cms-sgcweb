<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from d:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_home.html */ ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['menu']; ?>
</h1>
<?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['content']; ?>

</div>
<?php $_from = $this->_tpl_vars['a_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?>
<?php if (( $this->_tpl_vars['a_item']['home'] == 1 )): ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['a_item']['title']; ?>
</h1>
    <?php echo $this->_tpl_vars['a_item']['header']; ?>

	<?php if (( ! empty ( $this->_tpl_vars['a_gallery_home'][$this->_tpl_vars['a_item']['categoryid']] ) )): ?>
	<?php $_from = $this->_tpl_vars['a_gallery_home'][$this->_tpl_vars['a_item']['categoryid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
	 <div class="gallery"><p align="center"><a rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_item']['title']; ?>
"><img src="<?php echo $this->_tpl_vars['a_image']['imageurl']; ?>
" border="0" width="130" height="97" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_item']['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>" alt="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_item']['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>"/></a></p></div>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<div class="clear"></div>
	<p class="post-footer align-right"><a href="<?php echo @URL_SITE; ?>
/_file/file/<?php echo $this->_tpl_vars['a_item']['directory']; ?>
.pdf" title="Oferta <?php echo $this->_tpl_vars['a_item']['fulltitle']; ?>
" target="_blank">Oferta <?php echo $this->_tpl_vars['a_item']['title']; ?>
</a> &nbsp; <a href="<?php echo $this->_tpl_vars['a_item']['url_gallery']; ?>
" title="<?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_item']['fulltitle']; ?>
"><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_item']['title']; ?>
</a></p>
</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<div class="description"><p><?php echo $this->_tpl_vars['a_page'][$this->_tpl_vars['page']]['footer']; ?>
</p></div>