<?php
switch ($attributes['action'])
{
  case 'login':                 
    $sessionid  = auth_login($attributes['username'], $attributes['password']);
    if (!empty($sessionid)) 
    {
        $_SESSION['domainid'] = DEFAULT_DOMAINID;
        header("Location: ".URL_SITE."/index.php");
    }
    else header("Location: ".URL_SITE."/login.php");
  break;  
  case 'logout':
    auth_logout();
    unset($_SESSION['domainid']);
    header("Location: ".URL_SITE."/login.php");
  break;
}
?>