<?php
    session_start();
?>         
<!DOCTYPE html>
<html lang="ru">
  <head>
	  <meta charset="utf-8">
	  <title>Выбор теста</title>
  	<link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <section class="bgrnd-main">
      <nav>
        <a class="navigation" href="index.php">Авторизация</a>
        <a class="navigation" href="admin.php">Загрузка теста</a>
        <a class="navigation active" href="list.php">Выбор тестов</a>
        <a class="navigation" href="test.php">Тестирование</a>
      </nav>
      
    </section>
    <?php
      error_reporting(0);
      if (!$_SESSION['usertype'])
      {
        echo '<p class="help-block">Пожалуйста авторизуйтесь!</p>';
        header('HTTP/1.1 403');
        exit;
     }
  
      $dir = (__DIR__  .  DIRECTORY_SEPARATOR  . Tests);
      $files = scandir($dir);
      foreach ($files as $index => $filetype) {
        If  (strrpos($filetype, 'json')) {$Testlist[]= $filetype;}
      }    
    ?>

    <section class="bgrnd-test">
      <div class="testlist">
        <form class="list" action="test.php" method="GET" >
          <?php
              if ($_SESSION['usertype'] == 'user') 
              {
                echo '<p class="help-block">Выберите тест</p>
                      <p><a class="actbtn" href="admin.php"><span> Добавить тест </span></a>
                      <a class="actbtn" href="dellist.php"><span> Удалить тест </span></a></p>';
                
                foreach ($Testlist as $index => $file) 
                {
                  $_delfile = 'delfile.php'.$dir . DIRECTORY_SEPARATOR  . $file;
                  echo '<input class="item" type="radio" name="item" value='.$file.'>'.$file.'<Br>';
                }
              }
              else
              {
                foreach ($Testlist as $index => $file) 
                {
                  echo '<input class="item" type="radio" name="item" value='.$file.'>'.$file.'<Br>';
                }
              }
              //header('Location: delfile.php')          
          ?>
          <p>
            <input class="testchoice" type="submit" value="Пройти тест">
          </p>
        </form>
      </div>
    </section>
  </body>
</html>