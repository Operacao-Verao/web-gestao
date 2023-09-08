<?php
  require_once("vendor/autoload.php");

  use Minishlink\WebPush\VAPID;

  print_r(VAPID::createVapidKeys());

  /*
  [publicKey] => BPwL7jbII3foRiJ180O05ZKwOo7AlAY7on_DLg5p_OuWMOPSDuD4716aWYtqNzIDwpDlONY0tH-hj2dJIktk_0s
  [privateKey] => 28L7I-lUhnAFJWcmJYB0PtYAsfAHJ9sLV2CKhjs475Q
  */
?>