<?php
//- Set the values for a login operation --------------------------------------------------------------------
function auth_login($username, $password)
{
  global $_COOKIE_NAME;
  
  $a_user = db_get('user',array(),array('username'=>$username,'active'=>1));  
  $sessionid = '';      
  if (!empty($a_user) and ($a_user[0]['password']==md5($password)))
  {
       $sessionid  = uniqid(rand());
       db_del('session',0,array('userid'=>$a_user[0]['userid']));
       db_add('session',array('sessionid'=>$sessionid,'userid'=>$a_user[0]['userid'],'timelogin'=>date('Y-m-d H:i:s')));
    
       //-- set cookie into session
       $_SESSION[$_COOKIE_NAME] = $sessionid;
  }
  return $sessionid;
}

function auth_logged() 
{
  global $_COOKIE_NAME,$_COOKIE_EXPIRE;
    
  $sessionid = isset($_SESSION[$_COOKIE_NAME]) ? $_SESSION[$_COOKIE_NAME] : '';
  
  if (empty($sessionid)) return false;
  else
  {
      $current_time = date('Y-m-d H:i:s');
      $a_session = db_get('session',array(),array('sessionid'=>$sessionid));
      if (empty($a_session) or (strtotime($current_time)-strtotime($a_session[0]['timelogin'])>$_COOKIE_EXPIRE)) 
      {
          if (!empty($a_session)) db_del('session',0,array('userid'=>$a_session[0]['userid']));
          unset($_SESSION[$_COOKIE_NAME]);
          return false;
      }
      else
      {
        db_mod('session',array('timelogin'=>$current_time),$sessionid);
      }  
  }

  return true;
}

function auth_logout() 
{
  global $_COOKIE_NAME;
  $sessionid = isset($_SESSION[$_COOKIE_NAME]) ? $_SESSION[$_COOKIE_NAME] : '';
  if (!empty($sessionid)) db_del('session',0,array('sessionid'=>$sessionid));
  unset($_SESSION[$_COOKIE_NAME]);
}
?>