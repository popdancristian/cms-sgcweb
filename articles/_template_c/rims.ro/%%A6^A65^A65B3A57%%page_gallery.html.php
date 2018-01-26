<?php /* Smarty version 2.6.22, created on 2013-02-07 11:21:20
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_gallery.html */ ?>
<div class="description">
<h1><?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['fulltitle']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['_l']['gallery']; ?>
</h1>
<?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['content']; ?>

<?php $_from = $this->_tpl_vars['a_gallery'][$this->_tpl_vars['categoryid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
 <div class="gallery"><a onclick="<?php echo '$.ajax({url: \''; ?>
<?php echo $this->_tpl_vars['_DOMAIN']['url']; ?>
<?php echo '/index.php\',data:\'page=gallery&amp;galleryid='; ?>
<?php echo $this->_tpl_vars['a_image']['galleryid']; ?>
<?php echo '&amp;submit=1\',success: function(responseText){},error: function(){}});'; ?>
" rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" alt="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
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
<div class="clear"></div>
<p class="post-footer align-right"><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php $_from = $this->_tpl_vars['a_category'][$this->_tpl_vars['categoryid']]['a_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_tag']):
?> <?php echo $this->_tpl_vars['str_tag']; ?>
 <?php endforeach; endif; unset($_from); ?></p>
</div>