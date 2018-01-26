<?php /* Smarty version 2.6.22, created on 2013-02-05 02:49:47
         compiled from I:%5CUSBWebserver%5Croot%5Crims.ro%5Carticles%5C_template/header.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php if (( $this->_tpl_vars['page'] == 'home' )): ?><?php echo $this->_tpl_vars['_CONFIG']['motto']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['meta_title']; ?>
<?php endif; ?></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['meta_keyword']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['meta_description']; ?>
" />
<meta name="author" content="<?php echo $this->_tpl_vars['_DOMAIN']['name']; ?>
" />
<meta name="copyright" content="Copyright <?php echo $this->_tpl_vars['_DOMAIN']['name']; ?>
 2012-2013. All rights reserved" />
<meta name="publisher" content="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
" />
<meta name="generator" content="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
" />
<meta name="formatter" content="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
" />
<meta name="reply-to" content="<?php echo $this->_tpl_vars['_CONFIG']['email']; ?>
" />
<meta name="email" content="<?php echo $this->_tpl_vars['_CONFIG']['email']; ?>
" />
<meta name="audience" content="Global" />
<meta name="distribution" content="Local" />
<meta name="language" content="ro-RO" />
<meta name="abstract" content="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
" />
<meta name="robots" content="index,follow" />
<meta name="rating" content="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
" />
<meta name="classification" content="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
" />
<link rel="alternate" type="application/rss+xml"  href="<?php echo $this->_tpl_vars['_DOMAIN']['url']; ?>
/rss.xml" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 RSS Feed" />
<?php if (( ! empty ( $this->_tpl_vars['_CONFIG']['google_verify'] ) )): ?>
<meta name="google-site-verification" content="<?php echo $this->_tpl_vars['_CONFIG']['google_verify']; ?>
" />
<?php endif; ?>
<?php if (( ! empty ( $this->_tpl_vars['_CONFIG']['yahoo_verify'] ) )): ?>
<meta name="y_key" content="<?php echo $this->_tpl_vars['_CONFIG']['yahoo_verify']; ?>
" />
<?php endif; ?>
<link href="<?php echo @URL_SMARTY_TEMPLATE; ?>
/<?php echo $this->_tpl_vars['_CONFIG']['site_template']; ?>
/<?php echo $this->_tpl_vars['_CONFIG']['site_style']; ?>
/default.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['_DOMAIN']['url']; ?>
/favicon.ico" />
<script type="text/javascript" src="<?php echo @URL_SITE; ?>
/_js/swfobject.js"></script>
<script type="text/javascript" src="<?php echo @URL_SITE; ?>
/_js/jquery-1.5.1.js"></script>
<link rel="stylesheet" href="<?php echo @URL_SITE; ?>
/_js/JQueryFancybox/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="<?php echo @URL_SITE; ?>
/_js/JQueryFancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo @URL_SITE; ?>
/_js/jquery.featureList-1.0.0.js"></script>

<?php echo '<script type="text/javascript" src="'; ?>
<?php echo @URL_SITE; ?>
<?php echo '/_js/functions.js"></script>'; ?>

<?php if (( ! empty ( $this->_tpl_vars['b_include_raty'] ) )): ?>
<?php echo '<script type="text/javascript" src="'; ?>
<?php echo @URL_SITE; ?>
<?php echo '/_js/jquery.raty.min.js"></script>'; ?>

<?php endif; ?>
<?php echo '
<script language="javascript" type="text/javascript">
$(document).ready(function() 
{
			$("a[rel=pimage]").fancybox({
				\'transitionIn\'	: \'elastic\',
				\'transitionOut\'	: \'elastic\'
			});

			
});
</script>
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@PATH_SMARTY_TEMPLATE)."/module_script_top.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body>