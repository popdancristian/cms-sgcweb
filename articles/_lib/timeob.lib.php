<?php
$cfgOBGzip = true;
$cfgTime = false;
function TimeObHeader() 
{
  global $cfgOBGzip, $cfgTime;
  $starttime = 0;
  if ($cfgTime) 
  {
    $mtime = microtime();
    $mtime = explode(' ',$mtime);
    $starttime = $mtime[1] + $mtime[0];
  }
  if ($cfgOBGzip) { 
    $ob_mode = out_buffer_mode_get(); 
    if ($ob_mode) out_buffer_pre($ob_mode);
  }
  return $starttime;
}

function TimeObFooter($starttime, $text='Execution time: ') 
{
  global $cfgOBGzip,$cfgTime;

  if ($cfgTime) 
  {
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $endtime   = $mtime;
    $totaltime = ($endtime - $starttime);
	echo '<br/><div style="text-align:center;">';
	printf("$text %f seconds", $totaltime);
    echo "</div>";
  }
  if (isset($cfgOBGzip) && $cfgOBGzip && isset($ob_mode) && $ob_mode) out_buffer_post($ob_mode);
}

if (!defined('__OB_LIB_INC__')) {
  define('__OB_LIB_INC__', 1);

  function out_buffer_mode_get() {
    # This will be used eventually to support more modes.  It is
    # needed because both header and footer functions must know
    # what each other is doing.

    if (@function_exists('ob_start')) $mode = 1; else $mode = 0;
    if (@function_exists('ini_get')) {
      if (@ini_get('output_handler') == 'ob_gzhandler') { $mode = 0; }
    } else {
        if (@get_cfg_var('output_handler') == 'ob_gzhandler') { $mode = 0; }
    }
    header("X-ob_mode: $mode");
    return $mode;
  }

  function out_buffer_pre($mode) {
    # This function will need to run at the top of all pages if
    # output buffering is turned on.  It also needs to be passed $mode
    # from the out_buffer_mode_get() function or it will be useless.

    switch($mode) {
      case 1:
        ob_start('ob_gzhandler');
        $retval = FALSE;
        break;
      case 0:
        $retval = FALSE;
        break;
      default:
        $retval = FALSE;
        break;
    }
    return $retval;
  }

  function out_buffer_post($mode) {
    # This function will need to run at the bottom of all pages if
    # output buffering is turned on.  It also needs to be passed $mode
    # from the out_buffer_mode_get() function or it will be useless.

    switch($mode) {
      case 1:
        # This output buffer doesn't need a footer.
        $retval = TRUE;
        break;
      case 0:
        $retval = FALSE;
      default:
        $retval = FALSE;
    }
    return $retval;
  }
}
?>