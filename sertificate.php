<?php
    session_start();
        
    header("Content-type: image/png");

    if ($_SESSION['usertype'] == 'user') 
    {
      $name = $_SESSION['user']['username'];
      $Size=50;
    }
    else
    {
      $name = $_SESSION['guest'];
      $Size=50;
    }
    $font = (__DIR__. DIRECTORY_SEPARATOR  .'times.ttf');

    $sert = imagecreatetruecolor(800, 600);
    $text_color = imagecolorallocate($sert, 120, 220, 100);

    imagefill($sert, 0, 0, $bgrndcolor);
    $sert_png = imagecreatefrompng(__DIR__. DIRECTORY_SEPARATOR  .'sertificate.png');
    imagecopy($sert, $sert_png, 0, 0, 0, 0, 800, 600);

    $sert_text = imagecreate(700, 500);
    $text_color = imagecolorallocate($sert, 255, 255, 255);
    imagettftext($sert, 50, 0, 180, 120, $text_color, $font, "СЕРТИФИКАТ");
    imagettftext($sert, 25, 0, 250, 200, $text_color, $font, "выдан пользователю");
    imagettftext($sert, $Size, 0, 180, 320, $text_color, $font, $name);
    imagettftext($sert, 20, 0, 180, 420, $text_color, $font, "Результат прохождения теста - ".$_SESSION['mark']."%");
    imagePNG($sert);
    imageDestroy($sert);
?>