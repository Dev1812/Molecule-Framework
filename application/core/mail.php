<?php
/**
 *
 * @code $mail = new Mail("no-reply@mysite.ru"); // Создаём экземпляр класса
 *       $mail->setFromName("Иван Иванов"); // Устанавливаем имя в обратном адресе
 *       if ($mail->send("abc@mail.ru", "Тестирование", "Тестирование<br /><b>письма<b>")) echo "Письмо отправлено";
 *       else echo "Письмо не отправлено";

         $this->mail->setEmail('test@mail.ru');
        $this->mail->setFromName($initials);
        $this->mail->send("test@mail.ru'", 'Поздравляем! Вы успешно Зарегестрированы.', '');
        
 */
class Mail {
  private $from_email;
  private $from_name = '';
  private $type = 'text/html';
  private $encoding = 'utf-8';
  private $notify = false;

  public function __construct($from_email = '', $from_name = '') {
    $this->from_email = $from_email;
    $this->from_name = $from_name;
  }

    /**
     * @desc Изменение обратного e-mail адреса 
     *
     */
    public function setEmail($from_email) {
        $this->from_email = $from_email;
    }




    /**
     * @desc Изменение имени в обратном адресе
     *
     */
    public function setFromName($from_name) {
        $this->from_name = $from_name;
    }


    /**
     * @desc Изменение типа содержимого письма
     *
     */
    public function setType($type) {
        $this->type = $type;
    }


    /**
     * @desc Нужно ли запрашивать подтверждение письма
     *
     */
    public function setNotify($notify) {
        $this->notify = $notify;
    }

    /**
     * @desc Изменение кодировки письма
     *
     */
    public function setEncoding($encoding) {
        $this->encoding = $encoding;
    }

    /**
     * @desc Метод отправки письма
     * @date 16.4.2016
     * @param <int> to        - Email получателя
     * @param <Text> subject  - Тема письма
     * @param <Text> message  - Сообщение
     * @return <Boolean> true - Если успешно
     *
     */
    public function send($to, $subject, $message) {
        $from = '=?utf-8?B?'.base64_encode($this->from_name).'?='.' <'.$this->from_email.'>'; // Кодируем обратный адрес (во избежание проблем с кодировкой)
        $headers = 'From: '.$from_email."\r\nReply-To: ".$from_email."\r\nContent-type: ".$this->type.'; charset='.$this->encoding."\r\n"; // Устанавливаем необходимые заголовки письма
        if($this->notify) {
            //Подтверждение???
            $headers .= 'Disposition-Notification-To: '.$this->from_email."\r\n"; // Добавляем запрос подтверждения получения письма, если требуется
        }
        $subject = '=?utf-8?B?'.base64_encode($subject).'?='; // Кодируем тему (во избежание проблем с кодировкой)
        mail($to, $subject, $message, $headers);
        return true;
    }

}
?>