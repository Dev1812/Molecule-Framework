<?php
class DebugLog{
  public static function write($message) {
    if(!isset($message) || empty($message)) {
      return false;
    }
//define('ST_T', microtime());//начало
    $time = date('h:i:s');
    $date = explode('.', date('d.m.Y'));

    $log_dir = ROOT_DIR.'core/log/'.$date[2].'_y/'.$date[1].'_m/';
    $file_name = $date[0].'.txt';
  
    if(!file_exists($log_dir)) {
      if(!mkdir($log_dir, 0777, true)) {
        exit;
      }
    }

    $lang_file = fopen($log_dir.'/'.$file_name, 'a+');
    flock($file, LOCK_EX);
    fwrite($lang_file, $time.' ['.$_SERVER['REMOTE_ADDR'].'] '.$message."\r\n");
    flock($file, LOCK_UN); //Снятие блокировки
    fclose($lang_file);   

//printf('debug_log time issue: %.5f', microtime()-ST_T);
  }
}
?>