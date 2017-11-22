<?php
  session_start();
  function login($login, $password) 
  {
      if (getUser($login)) 
      {
      $user = getUser($login);

          if ($password == $user['password']) 
          {
            $_SESSION['user'] = $user;
            $_SESSION['usertype'] = 'user';
            return true;
            die;
          }
          if (is_null($password))
          {
            $_SESSION['user'] = $login;    
            $_SESSION['usertype'] = 'guest';
            return true;
            die;
            
          }
          if ($password == '')
          {
            $_SESSION['user'] = $login;    
            $_SESSION['usertype'] = 'guest';
            return true;
            die;
          }
          else 
          {
            unset($_SESSION['usertype']);
            return false;
            die;
          }
      }
      elseif (is_null($login)) 
      {
        return false;
        die;
      }
      elseif ($login == '') 
      {
        return false;
        die;
      }
      elseif (is_null($password))
      {
        $_SESSION['user'] = $login;    
        $_SESSION['usertype'] = 'guest';
        return true;
        die;
      }
      elseif ($password == '')
      {
        $_SESSION['user'] = $login;    
        $_SESSION['usertype'] = 'guest';
        return true;
        die;
      }

      else {return false;}
  }

  function getUsers() 
  {
      $fileData = file_get_contents (__DIR__  .  DIRECTORY_SEPARATOR  .'Users.json');
      $data = json_decode ($fileData, true);
      if (!$data) {
        return [];
      }
      return $data;
  }

  function getUser($login) 
  {
      $users = getUsers();
      foreach ($users as $user){
        if ($user['login'] == $login) {
          return $user;
        }
      }
      return null;
  }

  function logout()
  {
    session_destroy();
  }

?>  