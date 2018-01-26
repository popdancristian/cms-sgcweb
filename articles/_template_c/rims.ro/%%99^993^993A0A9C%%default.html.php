<?php /* Smarty version 2.6.22, created on 2018-01-26 06:35:43
         compiled from default.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'default.html', 30, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@PATH_SMARTY_TEMPLATE)."/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <div id="wrap">
	<div id="header">
	  <div id="headerleft"><div class="address"></div><div class="contact"></div></div>
	  <div id="headerright"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['_CONFIG']['site_style'])."/module_slider.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	 </div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_menu_top.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="clear"></div>
	<div id="page">
	    <div id="pageleft">
		 <div class="leftheader"><h2><?php echo $this->_tpl_vars['_l']['categoriesarticles']; ?>
</h2></div>
		 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_category.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		 <div class="leftheader"><h2><?php echo $this->_tpl_vars['_l']['gallery']; ?>
</h2></div>
		 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_category_gallery.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_link_left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		 <div class="leftheader"><h2><?php echo $this->_tpl_vars['_l']['faq']; ?>
</h2></div>
		 <div class="leftcontent"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_faq.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		 <div class="leftheader"><h2><?php echo $this->_tpl_vars['_l']['bestkeywords']; ?>
</h2></div>
		 <div class="leftcontent"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_keyword_best.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		</div>
		<div id="pageright"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['include_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><div class="description"><h2>Solutii la cheie in orice tipuri constructii din lemn: casute, case cabane si vile</h2></div></div>
		<div class="clear"></div>
	</div>
	<div id="footer">
	  <div id="footerbody">
	    <div id="footerleft"><a class="rss" href="<?php echo $this->_tpl_vars['_DOMAIN']['url']; ?>
/rss.xml" title="<?php echo $this->_tpl_vars['_CONFIG']['title']; ?>
 RSS Feed"></a></div>
		<div id="footerright">
		 <p><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_menu_bottom.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
		 <p><?php echo $this->_tpl_vars['_CONFIG']['copyright']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['_CONFIG']['title'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo $this->_tpl_vars['_CONFIG']['title_separator']; ?>
 <?php echo $this->_tpl_vars['_CONFIG']['motto']; ?>
</p>
	   </div>
	</div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@PATH_SMARTY_TEMPLATE)."/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>