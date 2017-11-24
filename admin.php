<!DOCTYPE html>
<html lang="ru">
  <head>
	  <meta charset="utf-8">
	  <title>Загрузка тестов</title>
  	<link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <section class="bgrnd-main">
      <nav>
        <a class="navigation" href="index.php">Авторизация</a>
        <a class="navigation active" href="admin.php">Загрузка теста</a>
        <a class="navigation" href="list.php">Выбор тестов</a>
        <a class="navigation" href="test.php">Тестирование</a>
      </nav>
      
<?php
          session_start();
          //var_dump ($_SESSION);
          error_reporting(0);
      
      if (!$_SESSION['usertype'])
      {
        header('HTTP/1.1 403');
        echo'<p class="help-block">Пожалуйста авторизуйтесь!</p>';
        exit;
      }
               
      if ($_SESSION['usertype'] == 'user')
      {
        echo'<p class="help-block">Выберете файл с тестом для загрузки (в формате ***.json)</p>
        <form action="admin.php" method="post" enctype="multipart/form-data"> 
          <input class="btn" type="file" name="userfile" >
          <input type="submit" value="Загрузить тест">
        </form>';  
      }
      if ($_SESSION['usertype'] == 'guest')
      {
        echo'<p class="help-block">Доступ к загрузке тестов запрещен</p>';
        header('HTTP/1.1 403');
        exit;
      }
    echo'
    </section>';
      
      function extCheck($fileName, $ext) 
      {
        return in_array(pathinfo($fileName, PATHINFO_EXTENSION), $ext);
      }  
      
        if(is_uploaded_file($_FILES['userfile']['tmp_name']))
        {
          if (!extCheck($_FILES['userfile']['name'], ['json'])) 
          {
            echo'<p class="help-block">Допускаются только файлы с расширением <strong>json</strong>.</p>';
            exit;
          }
          $tmp_path=file_get_contents($_FILES['userfile']['tmp_name']);
          $tmp_json =json_decode($tmp_path, true);
          if (is_null($tmp_json['Test_Group_id'])) 
          {
            echo'<p class="help-block">Неверный формат теста</p>';
            exit;
          }
          if (is_null($tmp_json[0]['question'])) {
            echo'<p class="help-block">Неверный формат теста</p>';
            exit;
          }
               
          move_uploaded_file($_FILES['userfile']['tmp_name'], __DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $_FILES['userfile']['name']);
          if(file_get_contents(__DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $_FILES["userfile"]["name"]))
          {
          echo'<p class="help-block">Файл успешно загружен</p>';
          header('Location: list.php');
          }
        } 
    ?>
  </body>
</html>