<?php

class Controller_Not_Found {
  public function action_index() {
$captcha = new Captcha;

$captcha->generate();
  }
}
?>