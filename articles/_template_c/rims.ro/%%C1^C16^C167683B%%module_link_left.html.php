<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from module_link_left.html */ ?>
<?php if (( ! empty ( $this->_tpl_vars['a_elink']['left'] ) )): ?>
<div class="leftheader"><h2><?php echo $this->_tpl_vars['_l']['partners']; ?>
</h2></div>
<div class="category">
<ul>
	<?php $_from = $this->_tpl_vars['a_elink']['left']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?>
		<li><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['a_item']['title']; ?>
 - <?php echo $this->_tpl_vars['a_item']['url']; ?>
" target="_blank" onclick="<?php echo '$.ajax({url: \''; ?>
<?php echo $this->_tpl_vars['_DOMAIN']['url']; ?>
<?php echo '/index.php\',data:\'page=link&amp;linkid='; ?>
<?php echo $this->_tpl_vars['a_item']['linkid']; ?>
<?php echo '&amp;submit=1\',success: function(responseText){},error: function(){}});'; ?>
"><?php echo $this->_tpl_vars['a_item']['title']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>