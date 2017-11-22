<?php
$delfile=(__DIR__  .  DIRECTORY_SEPARATOR  . Tests .  DIRECTORY_SEPARATOR  . $_POST['item']);
//var_dump($delfile);

unlink($delfile);
header('Location: list.php ');

?>