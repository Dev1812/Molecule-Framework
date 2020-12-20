<?php
  session_set_cookie_params(199999);
  ini_set('session.gc_maxlifetime', 199999);
  ini_set('session.cookie_lifetime', 199999);
  session_name('sid');
  session_start();
  define('SECURITY_CONST', 'true');
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('PROJECT_NAME', 'Test');
  require_once SITE_ROOT.'application/bootstrap.php';	
?>