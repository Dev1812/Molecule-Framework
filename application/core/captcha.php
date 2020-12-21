<?php
class Captcha {
  public $img_width=110;
  public $img_height=43;
  public $img_font_size=14;
  public $let_amount = 5;
  public $fon_let_amount=5;
  public $letters = array(1,2,3,4,5,6,7,8,9);
  public $colors = array(90,110,130,150);
  /**
   * @desc Проверка кода введенного пользоватлем со значем в СЕССИИ
   * @param <Int> code - код введённый пользователем
   */
  public function checkCode($code) {
    return ($code == $_SESSION['captcha_code']) ? true : false;
  }

  public function generate() {    
    $width = $this->img_width; 
    $height = $this->img_height;
    $font_size = $this->img_font_size;
    $let_amount = $this->let_amount;//Количество главных символоа
    $fon_let_amount = $this->fon_let_amount;// Символы на фоне
    $font = SITE_ROOT.'/fonts/arial.ttf';//Путь к шрифту
    $letters = $this->letters;
    $colors = $this->colors;
 
    $src = imagecreatetruecolor($width,$height);//создаем изображение               

    $fon = imagecolorallocate($src,rand(247, 255),rand(247, 255),rand(247, 255));//создаем фон
    imagefill($src,0,0,$fon);//заливаем изображение фоном
 
    for($i=0;$i<3;$i++) {
      $line_color = imagecolorallocate($src, rand(120,255), rand(120,255), rand(120,255));
      imageline($src,0,rand()%50,200,rand()%50,$line_color);
    }

    for($i=0;$i < $fon_let_amount;$i++){//добавляем на фон буковки
      $color = imagecolorallocatealpha($src,rand(0,255),rand(0,255),rand(0,255),100);//случайный цвет
      $letter = $letters[rand(0,sizeof($letters)-1)];//случайный символ
      $size = rand($font_size-3 ,$font_size+3);//случайный размер                                                
      imagettftext($src,$size,rand(0,15),
                   rand($width*1,$width-$width*2),
                   rand($height*0.2,$height),$color,$font,$letter);
    }
 
    for($i=0;$i < $let_amount;$i++){//то же самое для основных букв
      $color = imagecolorallocatealpha($src,
                                       $colors[rand(0,sizeof($colors)-1)],
                                       $colors[rand(0,sizeof($colors)-1)],
                                       $colors[rand(0,sizeof($colors)-1)],
                                       rand(20,40)); 
      $letter = $letters[rand(0,sizeof($letters)-1)];
      $size = rand($font_size*2-2,$font_size*2+2);
      $x = ($i+1.2)*$font_size;//даем каждому символу случайное смещение
      $y = (($height*2)/2.7) + rand(0,5);                            
      $cod .= $letter;//запоминаем код
      imagettftext($src,$size,rand(0,15),$x,$y,$color,$font,$letter);
    }
    header('Content-type: image/png'); 
    $_SESSION['captcha_code'] = $cod;
    imagepng($src); 
  }

}
?>