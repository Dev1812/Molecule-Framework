<?php
class Common {
  public $i18n;
  public function __construct() {
    $this->i18n = new i18n;
  }
  /**
   * Получение сокращённого названия месяца
   * @date 10.04.2016 9:40
   * @return <String> Сокщённое назваие месяца
   */
  function getShortMonth($num) {
    if(!isset($num)) {
      return false;
    }
    $short_months = $this->i18n->get('short_month');
    if($num < 0 || $num > 12) {
      return false;
    }
    return $short_months[$num];
  }

  /**
   * Получение названия месяца
   * @date 10.04.2016 9:45
   * @return <String> Сокщённое назваие месяца
   */
  function getMonth($num) {
    if(!isset($num)) {
      return false;
    } 
    $months = $this->i18n->get('month');
    if($num < 0 || $num > 12) {
      return false;
    }
    return $this->pluralForm($num, $months[$num][0], $months[$num][1],  $months[$num][1]);
  }

  /**
   * Сколнение слов
   * @code pluralForm($n, 'письмо', 'письма', 'писем');
   */
  public static function pluralForm($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if($n > 10 && $n < 20) {
      return $form5;
    } elseif($n1 > 1 && $n1 < 5) {
      return $form2;
    } elseif($n1 == 1) {
      return $form1;
    }
    return $form5;
  }
}

?>