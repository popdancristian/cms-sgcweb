<?php /* Smarty version 2.6.22, created on 2012-01-12 19:31:16
         compiled from /home/dorufabr/public_html/games/_admin/_template/page_sitemap.html */ ?>
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['manage']; ?>
</legend>
<table border="0" align="center" bgcolor="#DDDDDD" cellspacing="1" cellpadding="1" width="100%">
<tr><td class="th">File</td><td class="th">Status</td><td class="th">Google</td><td class="th" style="width:100px;">&nbsp;</td><td class="th"  style="width:150px;">&nbsp;</td></tr>
<?php $_from = $this->_tpl_vars['a_sitemap']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?>
<?php if (( empty ( $this->_tpl_vars['a_item'] ) )): ?>
<tr><td colspan="5">&nbsp;</td></tr>
<?php else: ?>
<tr>
 <td class="td"><a href="<?php echo $this->_tpl_vars['a_item']['url']; ?>
" target="_blank" class="link"><?php echo $this->_tpl_vars['a_item']['file']; ?>
</a></td>
 <td class="td"><?php if (( $this->_tpl_vars['a_item']['b_found'] )): ?><span style="color:#009900"><b>OK</b></span><?php else: ?><span style="color:#FF0000"><b>NOT FOUND</b></span><?php endif; ?></td>
 <td class="td"><?php if (( $this->_tpl_vars['a_item']['b_google'] )): ?><span style="color:#009900"><b>YES</b></span><?php else: ?><span style="color:#FF0000"><b>NO</b></span><?php endif; ?></td>
 <td class="td" align="center"><a href="sitemap.php?page=<?php echo $this->_tpl_vars['page']; ?>
&categoryid=<?php echo $this->_tpl_vars['a_item']['categoryid']; ?>
&file=<?php echo $this->_tpl_vars['a_item']['file']; ?>
" class="link"><?php echo $this->_tpl_vars['_l']['generate']; ?>
</a></td>
 <td class="td" align="center"><a href="google.php?page=<?php echo $this->_tpl_vars['page']; ?>
&categoryid=<?php echo $this->_tpl_vars['a_item']['categoryid']; ?>
&file=<?php echo $this->_tpl_vars['a_item']['file']; ?>
" class="link">Submit to Google</a></td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>
</fieldset>