<?php /* Smarty version 2.6.22, created on 2018-01-26 06:37:33
         compiled from default.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['a_domain'][$_SESSION['domainid']]['name']; ?>
 <?php echo $this->_tpl_vars['html_title']; ?>
</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo @URL_SMARTY_TEMPLATE; ?>
/default.css" rel="stylesheet" type="text/css" />
<?php if (( ! empty ( $this->_tpl_vars['a_form'] ) || ! empty ( $this->_tpl_vars['a_form_add'] ) )): ?>
<script src="<?php echo @URL_SITE; ?>
/_class/qforms/lib/qforms.js"></script>
<script language="javascript">
<!--//
// set the path to the qForms directory
qFormAPI.setLibraryPath("<?php echo @URL_SITE; ?>
/_class/qforms/lib");
// this loads all the default libraries
qFormAPI.include("*");
//-->
</script>
<?php endif; ?>
<script src="<?php echo @URL_SITE; ?>
/_js/functions.js"></script>
<?php if (( ! empty ( $this->_tpl_vars['b_calendar'] ) )): ?>
<link type="text/css" rel="stylesheet" href="<?php echo @URL_SITE; ?>
/_class/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="<?php echo @URL_SITE; ?>
/_class/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<?php endif; ?>
</head>
<body>
<table width="100%">
<tr>
 <td id="menu" valign="top">
 <div>
   <select style="width:100%;" name="domainid" onchange="document.location.href='index.php?page=domain&oldpage=<?php echo $this->_tpl_vars['page']; ?>
&action=change&submit=1&new_domainid='+this[selectedIndex].value"><?php $_from = $this->_tpl_vars['a_domain']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_item']):
?><option value="<?php echo $this->_tpl_vars['a_item']['domainid']; ?>
" <?php if (( $_SESSION['domainid'] == $this->_tpl_vars['a_item']['domainid'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['a_item']['name']; ?>
</option><?php endforeach; endif; unset($_from); ?></select>
 </div>
 <ul>
    <li><a href="index.php"><?php echo $this->_tpl_vars['_l']['home']; ?>
</a></li>
    <?php $_from = $this->_tpl_vars['_MODULE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['str_item']):
?>
      <li<?php if (( $this->_tpl_vars['page'] == $this->_tpl_vars['str_item'] )): ?> class="current_page_item"<?php endif; ?>><a href="index.php?page=<?php echo $this->_tpl_vars['str_item']; ?>
"><?php echo $this->_tpl_vars['_l'][$this->_tpl_vars['str_item']]; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
	<li><a href="index.php?page=login&action=logout&submit=1"><?php echo $this->_tpl_vars['_l']['logout']; ?>
</a></li>
 </ul>
 <center>
 <?php if (( isset ( $this->_tpl_vars['success'] ) )): ?>
	<?php if (( $this->_tpl_vars['success'] )): ?><img src="<?php echo @URL_SMARTY_TEMPLATE; ?>
/images/success.gif">
	<?php else: ?><img src="<?php echo @URL_SMARTY_TEMPLATE; ?>
/images/error.gif"><?php endif; ?>
 <?php endif; ?>
 </center>
 </td>
 <td id="content" valign="top">
  <a href="<?php echo $this->_tpl_vars['a_domain'][$_SESSION['domainid']]['url']; ?>
" target="_blank"><h3><?php echo $this->_tpl_vars['a_domain'][$_SESSION['domainid']]['name']; ?>
</h3></a><br/>
  <div id="a_path"><a href="index.php?page=<?php echo $this->_tpl_vars['page']; ?>
<?php if (( ! empty ( $this->_tpl_vars['str_search_param'] ) )): ?><?php echo $this->_tpl_vars['str_search_param']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['str_page_title']; ?>
</a></div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['include_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
 </td>
</tr>
</table>
<!-- end footer -->
</body>
</html>