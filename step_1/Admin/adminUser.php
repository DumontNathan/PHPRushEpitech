<?php

require_once('step_1.php');

function edit_user()
{
    $loginname = $_POST["login"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $id = getUserId($loginname);
    $admin = 0;
 
    if(isset($_POST["login"]))
    {
        if(usernameExists($_POST["login"]))
        {
          $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
          $sql = "SELECT username FROM users WHERE username = ?";
          $sth = $conn->prepare($sql);
          $sth->bindParam(1, $loginname, PDO::PARAM_STR);
          $sth->execute();
        }
        else
        echo "This user doesn't exist.";
 
      if(isset($_POST['username']) && strlen($_POST['username']) > 0)
      {
        if(usernameExists($_POST["username"]))
          echo "This username is already taken ! Be original...";
        else
        {
            $sqlName = "UPDATE users SET username = ? WHERE id = ?";
            $updateName = $conn->prepare($sqlName);
            $updateName->bindParam(1, $_POST['username'], PDO::PARAM_STR);
            $updateName->bindParam(2, $id, PDO::PARAM_INT);
            $updateName->execute();
            echo "Username modified";
        }
      }
      if(isset($_POST['email']) && strlen($_POST['email']) > 0)
      {
          if(emailExists($_POST["email"]))
            echo "This email is already taken !";
          else
          {
             $sqlEmail = "UPDATE users SET email = ? WHERE id = ?";
             $updateEmail = $conn->prepare($sqlEmail);
             $updateEmail->bindParam(1, $_POST['email'], PDO::PARAM_STR);
             $updateEmail->bindParam(2, $id, PDO::PARAM_INT);
             $updateEmail->execute();
             echo "Email modified";
          }
      }
      if(isset($_POST['password']) && isset($_POST['password']) == $password && strlen($_POST['password']) > 0)
      {
          if(!(passwordTheSame($_POST["password"], $_POST["password_confirmation"])))
            echo "Password and password confirmation are not the same... try again.";
          else
          {
            $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $sqlPassword = "UPDATE users SET password = ? WHERE id = ?";
            $updatePassword = $conn->prepare($sqlPassword);
            $updatePassword->bindParam(1, $new_password, PDO::PARAM_STR);
            $updatePassword->bindParam(2, $id, PDO::PARAM_INT);
            $updatePassword->execute();
            echo "Password modified";
          }
      }
      if(!empty($_POST["SetAdmin"]))
      {
        $admin = 1;
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
        $sql = "UPDATE users SET admin = ? where id = ?";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $admin, PDO::PARAM_INT);
        $sth->bindParam(2, $id, PDO::PARAM_INT);
        $sth->execute();
        echo "Admin privileges added.";
      }
  } 
}

function display_user()
{
  if(isset($_POST["username"]))
      if(usernameExists($_POST["username"]))
      {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
        $sql = "SELECT * FROM users WHERE username = ?";
        $display = $conn->prepare($sql);
        $display->bindParam(1, $_POST["username"], PDO::PARAM_STR);
        $display->execute();
        $result = $display->fetch(PDO::FETCH_ASSOC);
        return $result;
      }
      else 
      echo "Username is incorrect... Try again!";
}

function create_user()
{
 if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password_confirmation"]))
 {
    $admin = 0;
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if(usernameExists($_POST["username"]))
      echo "This username is already taken ! Be original...";
    elseif(emailExists($_POST["email"]))
      echo "This email is already taken !";
    elseif(!(passwordTheSame($_POST["password"], $_POST["password_confirmation"])))
      echo "Password and password confirmation are not the same... try again.";
    else
    {
      if(!empty($_POST["SetAdmin"]))
        $admin = 1;
      $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
      $sql = "INSERT INTO users(username, email, password, admin) VALUES(:username, :email, :password, :admin)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':username', $username, PDO::PARAM_STR);
      $sth->bindParam(':email', $email, PDO::PARAM_STR);
      $sth->bindParam(':password', $password, PDO::PARAM_STR);
      $sth->bindParam(':admin', $admin, PDO::PARAM_INT);
      $sth->execute();
      if($admin == 0)
        echo "User created";
      elseif ($admin == 1)
        echo "Admin user created";
    }
 }
}

function delete_user()
{
 $delete = 0;
 
 if (!empty($_POST["Delete"]))
    $delete = 1;
 elseif (empty($_POST["Delete"]) && isset($_POST["username"]))
    echo "Please confirm your action\n";
 if(isset($_POST["username"]) && $delete == 1)
  if(usernameExists($_POST["username"]))
  {
      $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
      $sql = "DELETE FROM users WHERE username = ?";
      $sth = $conn->prepare($sql);
      $sth->bindParam(1, $_POST["username"], PDO::PARAM_STR);
      $sth->execute();
      echo $_POST["username"] ." deleted";
  }
  else 
      echo "This user doesn't exists";
}



?>