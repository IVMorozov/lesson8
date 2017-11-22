<!DOCTYPE html>
<html lang="ru">
  <head>
	  <meta charset="utf-8">
	  <title>Выбор теста</title>
  	<link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <?php
      error_reporting(0);
      $dir = (__DIR__  .  DIRECTORY_SEPARATOR  . Tests);
      $files = scandir($dir);
      foreach ($files as $index => $filetype) {
        If  (strrpos($filetype, 'json')) {$Testlist[]= $filetype;}
      }    
    ?>

    <section class="bgrnd-test">
      <div class="testlist">
        <form class="list" action="delfile.php" method="POST" >
          <?php
                foreach ($Testlist as $index => $file) 
                {
                  echo '<input class="item" type="radio" name="item" value='.$file.'>'.$file.'<Br>';
                }
          ?>
          <p>
            <input class="testchoice" type="submit" value="Удалить тест">
          </p>
        </form>
      </div>
    </section>
  </body>
</html>