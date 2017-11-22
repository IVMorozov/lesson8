<!DOCTYPE html>
<html lang="ru">
  <head>
	  <meta charset="utf-8">
	  <title>Авторизация</title>
  	<link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <section class="bgrnd-main">
      <nav>
        <a class="navigation active" href="index.php">Авторизация</a>
        <a class="navigation" href="admin.php">Загрузка теста</a>
        <a class="navigation" href="list.php">Выбор тестов</a>
        <a class="navigation" href="test.php">Тестирование</a>
      </nav>
      
    <?php
         session_start();
         //var_dump ($_SESSION['usertype']);
         error_reporting(0);
         require_once 'functions.php';
         if (!$_SESSION['usertype'])
         {
         login ($_POST['login'],$_POST['pw']);
         }
         //var_dump ($_SESSION['usertype']);
         
         if (is_null($_SESSION['usertype']))
        {
    ?>
        <p class="help-block">Требуется авторизация </p>
        <p> (если ввести только логин, то можно авторизоваться как Гость)</p>

        <form method="POST"> 
        <p><input class="login_pw" type="text" name="login"></p>
        <p><input class="login_pw" type="password" name="pw"></p>
        <p><input class="login_pw" type="submit" value="OK"></p>
        </form>  
    </section>';
    <?
        }
        if ($_SESSION['usertype'] == 'user') 
        {
          echo'<p class="help-block">Добро пожаловать, '.$_SESSION['user']['username'].'</p>';
    ?>      
            <a class="navigation" href="logout.php">
            <span>Log out</span>
            </a>
    <?
  
        }
        if ($_SESSION['usertype'] == 'guest')
        { 
          $_SESSION['guest']=$_POST['login'];
          echo'<p class="help-block">Вы авторизовались как Гость. Добро пожаловать, '.$_POST['login'].'</p>';
    ?>
            <a class="navigation" href="logout.php">
              <span>Log out</span>
            </a>
    <?
        }
    ?>
  </body>
</html>