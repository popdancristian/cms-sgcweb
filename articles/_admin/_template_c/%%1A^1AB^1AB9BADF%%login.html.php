<?php /* Smarty version 2.6.22, created on 2018-01-26 06:36:13
         compiled from login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['html_title']; ?>
</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo @URL_SMARTY_TEMPLATE; ?>
/default.css" rel="stylesheet" type="text/css" />
<?php if (( ! empty ( $this->_tpl_vars['a_form'] ) )): ?>
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
</head>
<body style="padding-top:20px;">
<table width="300" align="center" border="0">
<tr><td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "form.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
</table>
</body>
</html>