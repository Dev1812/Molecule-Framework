<?php 
/**
 * @date 28 July 2018 20:25
 *
 * 
 */
class i18n{
  /**
   * @example array('lang' => array('key' => 'value'))
   * @example array('ru' => array('hello' => 'Привет'))
   *
   */
  public $cache = array();
  public $lang = 'ru';
  public $supported_languages = array('ru', 'en');

  public function __construct() {
    $this->setLanguage();
  }

  private function setLanguage() {
    $lang = User::getLang();
    if(in_array($lang, $this->supported_languages)) {
      $this->lang = $lang;
    }
  }

  public function openAndCacheFile() {
    $cache = $this->cache;
    $lang = $this->lang;

    if(isset($cache)) {
      if(in_array($lang, $cache)) {
        return $cache[$lang];
      }
    }

    $lang_file = SITE_ROOT.'application/i18n/'.$lang.'.php';
    $file_body = include $lang_file;

    $this->cache = array($lang => $file_body);

    return $file_body;
  }

  public function get($words) {
    if(!isset($words) || empty($words)) {
      return '...';
    }

    $lang_body = $this->openAndCacheFile();

    if(!is_array($words)) {
      return (isset($lang_body[$words])) ? $lang_body[$words] : '';
    }

    $result = array();

    foreach($words as $v) {
      if(isset($lang_body[$v])) {
        $result[$v] = $lang_body[$v];
      }
    }

    //printf('i18n time issue: %.5f <br>', microtime()-ST_TT);
    return $result;
  }
}