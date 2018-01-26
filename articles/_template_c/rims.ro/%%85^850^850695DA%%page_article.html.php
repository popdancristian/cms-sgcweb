<?php /* Smarty version 2.6.22, created on 2013-02-07 11:21:03
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles%5C_template%5Carticles-1%5Cpage_article.html */ ?>
<div class="description">
    <h1><?php echo $this->_tpl_vars['meta_title']; ?>
</h1>
	<div id="raty" style="margin-left:10px;">
		<div id="click"></div>
		<?php echo '
		  <script type="text/javascript">
					$(function() {
						$(\'#click\').raty({
							click: function(score, evt) 
							{	  							  
							   $.ajax({url: \''; ?>
<?php echo $this->_tpl_vars['_DOMAIN']['url']; ?>
<?php echo '/index.php\',data:\'page=article&action=raty&articleid='; ?>
<?php echo $this->_tpl_vars['a_article']['articleid']; ?>
<?php echo '&raty=\'+score+\'&submit=1\',success: function(responseText){},error: function(){}});
							   $(\'#raty\').html(\'<b>Mutumim!</b>\');	
							},
							path: \''; ?>
<?php echo @URL_SITE; ?>
<?php echo '/_js/img/\',
							starOff:    \'star-off-big.png\',
							starOn:     \'star-on-big.png\',
							width: 200, 
							number: 5
						});

					});
			</script>
		'; ?>

	</div>
	<?php echo $this->_tpl_vars['a_article']['content']; ?>

	<p class="post-footer align-right"><?php $_from = $this->_tpl_vars['a_article']['a_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_tag']):
?> <?php echo $this->_tpl_vars['str_tag']; ?>
 <?php endforeach; endif; unset($_from); ?></p>

<?php if (( ! empty ( $this->_tpl_vars['a_article_images'] ) )): ?>
<?php $_from = $this->_tpl_vars['a_article_images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
 <div class="gallery"><a rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_article']['title']; ?>
"><img src="<?php echo $this->_tpl_vars['a_image']['imageurl']; ?>
" width="130" height="97" border="0" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_article']['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>" alt="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_article']['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>"/></a></div>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>
<?php endif; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_article_prev'] ) )): ?>
<h3><a href="<?php echo $this->_tpl_vars['a_article_prev']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_article_prev']['fulltitle']; ?>
"><?php echo $this->_tpl_vars['a_article_prev']['fulltitle']; ?>
</a></h1>
      <p><?php echo $this->_tpl_vars['a_article_prev']['description']; ?>
</p>
	<p class="post-footer align-right"><?php $_from = $this->_tpl_vars['a_article_prev']['a_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_tag']):
?> <a href="<?php echo $this->_tpl_vars['a_article_prev']['url']; ?>
" title="<?php echo $this->_tpl_vars['str_tag']; ?>
"><?php echo $this->_tpl_vars['str_tag']; ?>
</a><?php endforeach; endif; unset($_from); ?></p>
<?php endif; ?>
<br/>
<?php if (( ! empty ( $this->_tpl_vars['a_article_next'] ) )): ?>
<h3><a href="<?php echo $this->_tpl_vars['a_article_next']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_article_next']['fulltitle']; ?>
"><?php echo $this->_tpl_vars['a_article_next']['fulltitle']; ?>
</a></h1>
      <p><?php echo $this->_tpl_vars['a_article_next']['description']; ?>
</p>
	<p class="post-footer align-right"><?php $_from = $this->_tpl_vars['a_article_next']['a_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_tag']):
?> <a href="<?php echo $this->_tpl_vars['a_article_next']['url']; ?>
" title="<?php echo $this->_tpl_vars['str_tag']; ?>
"><?php echo $this->_tpl_vars['str_tag']; ?>
</a><?php endforeach; endif; unset($_from); ?></p>
<?php endif; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_gallery_best'][$this->_tpl_vars['a_article']['categoryid']] ) )): ?>
<?php $_from = $this->_tpl_vars['a_gallery_best'][$this->_tpl_vars['a_article']['categoryid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_image']):
?>
 <div class="gallery"><a rel="pimage" href="<?php echo $this->_tpl_vars['a_image']['imageurlb']; ?>
" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['a_article']['categoryid']]['title']; ?>
"><img src="<?php echo $this->_tpl_vars['a_image']['imageurl']; ?>
" border="0" width="130" height="97" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['a_article']['categoryid']]['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>" alt="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['a_article']['categoryid']]['title']; ?>
<?php if (( ! empty ( $this->_tpl_vars['a_image']['title'] ) )): ?> <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_image']['title']; ?>
<?php endif; ?>"/></a></div>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>
<p class="post-footer align-right"><a href="<?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['a_article']['categoryid']]['url_gallery']; ?>
" title="<?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['a_article']['categoryid']]['fulltitle']; ?>
"><?php echo $this->_tpl_vars['_l']['gallery']; ?>
 <?php echo $this->_tpl_vars['a_category'][$this->_tpl_vars['a_article']['categoryid']]['title']; ?>
</a></p>
<?php endif; ?>
</div>