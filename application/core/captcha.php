<?php
class Captcha {
  public $width=110;
  public $height=43;
  public $font_size=14;
  public $let_amount = 5;
  public $fon_let_amount=5;
  public $letters = array(1,2,3,4,5,6,7,8,9);
  public $colors = array(90,110,130,150);
   
  public $font = null;//Путь к шрифту

  public function __construct($font = '') {
    if(!empty($font)) {
      $this->font = $font;
    } else {
      $this->font = SITE_ROOT.'/fonts/arial.ttf';
    }
  }

  /**
   * @desc Проверка кода введенного пользоватлем со значем в СЕССИИ
   * @param <Int> code - код введённый пользователем
   */
  public function checkCode($code) {
    return ($code == $_SESSION['captcha_code']) ? true : false;
  }

  public function setWidth($width) {
    $this->width = $width;
  }

  public function setHeight($height) {
    $this->height = $height;
  }

  public function setFontSize($font_size) {
    $this->font_size = $font_size;
  }

  public function setLetAmount($let_amount) {
    $this->let_amount = $let_amount;
  }

  public function setFonLetAmount($fon_let_amount) {
    $this->fon_let_amount = $fon_let_amount;
  }

  public function setLetters($letters) {
    $this->this->letters = $letters;  
  }

  public function setColors($colors) {
    $this->this->colors = $colors;
  }

  public function generate() {

    $src = imagecreatetruecolor($this->width,$this->height);//создаем изображение               

    $fon = imagecolorallocate($src,rand(247, 255),rand(247, 255),rand(247, 255));//создаем фон
    imagefill($src,0,0,$fon);//заливаем изображение фоном
 
    for($i=0;$i<3;$i++) {
      $line_color = imagecolorallocate($src, rand(120,255), rand(120,255), rand(120,255));
      imageline($src,0,rand()%50,200,rand()%50,$line_color);
    }

    for($i=0;$i < $this->fon_let_amount;$i++){//добавляем на фон буковки
      $color = imagecolorallocatealpha($src,rand(0,255),rand(0,255),rand(0,255),100);//случайный цвет
      $letter = $this->letters[rand(0,sizeof($this->letters)-1)];//случайный символ
      $size = rand($this->font_size-3 ,$this->font_size+3);//случайный размер                                                
      imagettftext($src,$size,rand(0,15),
                   rand($this->width*1,$this->width-$this->width*2),
                   rand($this->height*0.2,$this->height),$color,$this->font,$letter);
    }
 
    for($i=0;$i < $this->let_amount;$i++){//то же самое для основных букв
      $color = imagecolorallocatealpha($src,
                                       $this->colors[rand(0,sizeof($this->colors)-1)],
                                       $this->colors[rand(0,sizeof($this->colors)-1)],
                                       $this->colors[rand(0,sizeof($this->colors)-1)],
                                       rand(20,40)); 
      $letter = $this->letters[rand(0,sizeof($this->letters)-1)];
      $size = rand($this->font_size*2-2,$this->font_size*2+2);
      $x = ($i+1.2)*$this->font_size;//даем каждому символу случайное смещение
      $y = (($this->height*2)/2.7) + rand(0,5);                            
      $cod .= $letter;//запоминаем код
      imagettftext($src,$size,rand(0,15),$x,$y,$color,$this->font,$letter);
    }
    header('Content-type: image/png'); 
    $_SESSION['captcha_code'] = $cod;
    imagepng($src); 
  }

}
?>