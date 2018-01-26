<?php /* Smarty version 2.6.22, created on 2012-08-20 21:01:02
         compiled from I:%5CUSBWebserver%5Croot%5Cjaluzele-cluj.com%5Carticles%5C_admin%5C_template/page_home.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'I:\\USBWebserver\\root\\jaluzele-cluj.com\\articles\\_admin\\_template/page_home.html', 8, false),)), $this); ?>
<br>
<table border="0" align="center" bgcolor="#DDDDDD" cellspacing="1" cellpadding="5" width="100%">
  <?php $this->assign('i', 0); ?>
    <?php $_from = $this->_tpl_vars['_MODULE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_item']):
?>
	<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
	 <?php if (( $this->_tpl_vars['i']%9 ) == 1): ?><tr><?php endif; ?>
      <td align="center" width="10%" class="td"><a href="index.php?page=<?php echo $this->_tpl_vars['str_item']; ?>
"><img src="<?php echo @URL_SMARTY_TEMPLATE; ?>
/images/<?php echo $this->_tpl_vars['str_item']; ?>
.gif" width="55" height="41" border="0"><br/><?php echo $this->_tpl_vars['_l'][$this->_tpl_vars['str_item']]; ?>
</a></td>
	 <?php if (( $this->_tpl_vars['i']%9 ) != 0 && count($this->_tpl_vars['_MODULE']) == $this->_tpl_vars['i']): ?></tr><?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
</table>
<br/>
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['statistics']; ?>
</legend>
<table border="0" align="center" bgcolor="#DDDDDD" cellspacing="1" cellpadding="5" width="100%">
<tr>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['domain']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['page']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['category']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['article']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['link']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['banner']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['keyword']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['tag']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['adsense']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['script']; ?>
</td>
 <td class="th" align="center"><?php echo $this->_tpl_vars['_l']['comment']; ?>
</td>
</tr>
<?php $_from = $this->_tpl_vars['a_domain']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i_key'] => $this->_tpl_vars['a_item']):
?>
 <tr>
	<td class="td"><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" target="_blank" class="link"><?php echo $this->_tpl_vars['a_item']['name']; ?>
</a></td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['page_count']; ?>
/<?php echo $this->_tpl_vars['a_stat']['page_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['category_count']; ?>
/<?php echo $this->_tpl_vars['a_stat']['category_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['article_count']; ?>
/<?php echo $this->_tpl_vars['a_stat']['article_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['link_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['banner_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['keyword_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['tag_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['adsense_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['script_count']; ?>
</td>
	<td class="td" align="center"><?php echo $this->_tpl_vars['a_domain_stat'][$this->_tpl_vars['i_key']]['comment_count']; ?>
</td>
 </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</fieldset>