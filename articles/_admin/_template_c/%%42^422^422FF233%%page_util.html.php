<?php /* Smarty version 2.6.22, created on 2014-03-16 11:14:10
         compiled from f:%5CUSBWebserver+v8.5%5C8.5%5Croot%5Crims.ro/articles/_admin%5C_template/page_util.html */ ?>
<?php $this->assign('a_form', ($this->_tpl_vars['a_form_category'])); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "form.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (( $this->_tpl_vars['i_total_category'] > 0 )): ?>
<?php $this->assign('a_form', ($this->_tpl_vars['a_form_category_article'])); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "form.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('a_form', ($this->_tpl_vars['a_form_article'])); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "form.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['tag']; ?>
</legend>
<table border="0" cellspacing="3" cellpadding="3">
<tr>
 <td><a href="tag.php?action=new" class="action" target="_blank">Generate New</a></td>
 <td><a href="tag.php?action=all" class="action" target="_blank">Re-Generate All</a></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend><?php echo $this->_tpl_vars['_l']['sitemap']; ?>
</legend>
<table border="0" cellspacing="3" cellpadding="3">
<tr>
<td><a href="sitemap.php?action=new" class="action" target="_blank">Generate New</a></td>
<td><a href="sitemap.php?action=all" class="action" target="_blank">Re-Generate All</a></td>
<td><a href="google.php?action=new" class="action" target="_blank">Submit to Google New</a></td>
<td><a href="google.php?action=all" class="action" target="_blank">Re-Submit to Google All</a></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>RSS</legend>
<table border="0" cellspacing="3" cellpadding="3">
<tr>
 <td><a href="rss.php" class="action" target="_blank">Generate</a></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Cache</legend>
<table border="0" cellspacing="3" cellpadding="3">
<tr>
 <td><a href="cache.php" class="action" target="_blank">Generate</a></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Gallery</legend>
<table border="0" cellspacing="3" cellpadding="3">
<tr>
 <td><a href="gallery.php" class="action" target="_blank">Generate</a></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Keyword & Tags</legend>
<table border="0" cellspacing="3" cellpadding="3">
<tr>
 <td><a href="keyword.php" class="action" target="_blank">Keyword & Tags</a></td>
</tr>
</table>
</fieldset>