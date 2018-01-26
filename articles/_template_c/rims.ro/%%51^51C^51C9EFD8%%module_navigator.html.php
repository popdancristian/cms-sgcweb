<?php /* Smarty version 2.6.22, created on 2017-11-28 15:36:56
         compiled from module_navigator.html */ ?>
<?php if (( ! empty ( $this->_tpl_vars['a_navigator'] ) )): ?>
<div class="navigator">
 <?php $_from = $this->_tpl_vars['a_navigator']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i_key'] => $this->_tpl_vars['a_item']):
?>
 <?php if (( $this->_tpl_vars['a_item']['url'] == '#' )): ?><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['navigator_title']; ?>
" class="disable">&nbsp;<?php echo $this->_tpl_vars['a_item']['title']; ?>
&nbsp;</a>
 <?php elseif (( $this->_tpl_vars['start'] == $this->_tpl_vars['a_item']['title'] )): ?><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['navigator_title']; ?>
 <?php echo $this->_tpl_vars['_l']['page']; ?>
 <?php echo $this->_tpl_vars['a_item']['title']; ?>
" class="current">&nbsp;<?php echo $this->_tpl_vars['a_item']['title']; ?>
&nbsp;</a>
 <?php else: ?><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" title="<?php echo $this->_tpl_vars['navigator_title']; ?>
 <?php echo $this->_tpl_vars['_l']['page']; ?>
 <?php echo $this->_tpl_vars['a_item']['title']; ?>
">&nbsp;<?php echo $this->_tpl_vars['a_item']['title']; ?>
&nbsp;</a>
 <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>