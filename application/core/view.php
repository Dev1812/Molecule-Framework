<?php
class View {
    /**
     * @desc 
     * @param <String> content_view - Шаблон для каждой страницы
     * @param <String> template_view - Главный Шаблон
     * @param <Array> param - Настройки для страницы
     * @param <Array> data - Информация(lang)
     * @param <Array> i18n - Локализация на сайте
     *
     */
  public function generate($content_view, $template_view, $param, $data = null, $i18n = null) {
   /*if(User::isAuth()) {
      $user = new User;
      $user_info = $user->getInfo(intval($_SESSION['user_id']), 'firstname, lastname, small_photo, big_photo');
      $user_info['initials'] = $user_info['firstname'].' '.$user_info['firstname'];
      $no_photo = '/images/no_photo.png';
      $user_info['small_photo'] = (!empty($user_info['small_photo'])) ? $user_info['small_photo'] : $no_photo;
      $user_info['big_photo'] = (!empty($user_info['big_photo'])) ? $user_info['big_photo'] : $no_photo;
      $data['global_info'] = $user_info;
    }*/
    if(!isset($template_view)) { 
      if(isset($content_view)) {
        include 'application/views/'.$content_view;
      }
    } else {
      include 'application/views/'.$template_view;  
    }
  }

}
?>