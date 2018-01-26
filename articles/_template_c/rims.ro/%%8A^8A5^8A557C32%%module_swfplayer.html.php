<?php /* Smarty version 2.6.22, created on 2013-02-05 02:43:18
         compiled from module_swfplayer.html */ ?>
<div id="swfplayer">
<embed src="<?php echo @URL_SITE; ?>
/_swf/swfplayer.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="850" align="center"></embed>
</div>
<?php echo '
<script type="text/javascript">
  var flashvars = {};
  flashvars.xmlFile = "'; ?>
<?php echo @URL_SITE; ?>
<?php echo '/_swf/swf.php?domainid='; ?>
<?php echo $this->_tpl_vars['_DOMAIN']['domainid']; ?>
<?php echo '";
  flashvars.direction = "horizontal";
  flashvars.dockWidth = "850";
  flashvars.dockHeight = "130";
  flashvars.minThumbWidth = "130";
  flashvars.minThumbHeight = "97";
  flashvars.maxThumbWidth = "167";
  flashvars.maxThumbHeight = "130";
  flashvars.spacing = "8";
  flashvars.expandingDirection = "center";
  flashvars.imagesInfluence = "200";
  flashvars.backgroundColor = "0";
  flashvars.autoScroll = "0";
  flashvars.fontSize = "11";
  flashvars.tooltipPosition = "top";
  var params = {};
  params.scale = "noscale";
  params.salign = "tl";
  params.wmode = "transparent";
  var attributes = {};
  swfobject.embedSWF("'; ?>
<?php echo @URL_SITE; ?>
<?php echo '/_swf/swfplayer.swf", "swfplayer", "850", "130", "9.0.0", false, flashvars, params, attributes);
</script>
'; ?>
