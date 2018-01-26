<?php
// we will do our own error handling
error_reporting(0);

// user defined error handling function
function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars) 
{
    // timestamp for the error entry
    $dt = date("Y-m-d H:i:s (T)");

    // define an assoc array of error string
    // in reality the only entries we should
    // consider are E_WARNING, E_NOTICE, E_USER_ERROR,
    // E_USER_WARNING and E_USER_NOTICE
    $errortype = array 
    (
                E_ERROR              => 'Error',
                E_WARNING            => 'Warning',
                E_PARSE              => 'Parsing Error',
                E_NOTICE             => 'Notice',
                E_CORE_ERROR         => 'Core Error',
                E_CORE_WARNING       => 'Core Warning',
                E_COMPILE_ERROR      => 'Compile Error',
                E_COMPILE_WARNING    => 'Compile Warning',
                E_USER_ERROR         => 'User Error',
                E_USER_WARNING       => 'User Warning',
                E_USER_NOTICE        => 'User Notice',
                E_STRICT             => 'Runtime Notice',
                E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
    );
    
    // set of errors for which a var trace will be saved
    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

    // set of errors for which a var trace will be saved
    if (isset($errortype[$errno])) $str_error_type = $errortype[$errno];
    else $str_error_type = 'Unknown';
    
    $err .= "Date:" . $dt . "\n";
    $err .= "Error No:" . $errno . "\n";
    $err .= "Error Type:" .$str_error_type. "\n";
    $err .= "Error Msg:" . $errmsg . "\n";
    $err .= "Error file:" . $filename . "\n";
    $err .= "Error line:" . $linenum . "\n";
    $err .= "\n-------------------------------\n";

    //--add server values
    foreach ($_SERVER as $str_key=>$str_value) $err .= $str_key.':'.$str_value."\n";    
    $err .= "\n\n\n";

    if (in_array($errno, $user_errors)) 
    {
        @mail('cms2you@yahoo.com', '[Error] '.$filename.'['.$linenum.']', $err, 'From: ErrorHandler <error@uaau.ro>');
    }
}

$old_error_handler = set_error_handler("userErrorHandler");
?>