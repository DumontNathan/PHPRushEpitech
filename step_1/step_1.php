<?php

function inscription()
{
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password_confirmation"]))
        {
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
              $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
              $sql = "INSERT INTO users(username, email, password, admin) VALUES(:username, :email, :password, 0)";
              $sth = $conn->prepare($sql);
              $sth->bindParam(':username', $username, PDO::PARAM_STR);
              $sth->bindParam(':email', $email, PDO::PARAM_STR);
              $sth->bindParam(':password', $password, PDO::PARAM_STR);
              $sth->execute();
              echo "User created";
            }
        }
}


function login()
{
    session_start();
    if(!empty($_POST["remember_me"]))
    {
        setcookie('email', $_POST['email'], time() + 3600);
    }
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
        $sql = "SELECT email, password FROM users where email = ?";
        $sth = $conn->prepare($sql);
        $sth->bindParam(1, $_POST["email"], PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $hashed_password = $result['password'];
        if($sth->rowCount() < 1 || !(password_verify($_POST["password"], $hashed_password)))
          echo "Incorrect email/password";
        else
        {
          $_SESSION["email"] = $_POST["email"];
          header("Location: index.php");
        }
      }
}

function sayHello()
{
  session_start();
  if(isSession())
  {
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
    $sql2 = "SELECT username FROM users WHERE email = ?";
    $sth2 = $conn->prepare($sql2);
    $sth2->bindParam(1, $_SESSION["email"], PDO::PARAM_STR);
    $sth2->execute();
    $result = $sth2->fetch(PDO::FETCH_ASSOC);
    echo 'Hello ' . $result['username'];
  }
  elseif(isCookie())
  {
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
    $sql2 = "SELECT username FROM users WHERE email = ?";
    $sth2 = $conn->prepare($sql2);
    $sth2->bindParam(1, $_COOKIE["email"], PDO::PARAM_STR);
    $sth2->execute();
    $result = $sth2->fetch(PDO::FETCH_ASSOC);
    echo 'Hello ' . $result['username'];
  }
  else
    header("Location: login.php");
}

function emailExists($email)
{
  $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
  $sql = "SELECT email FROM users where email = ?";
  $sth = $conn->prepare($sql);
  $sth->bindParam(1, $email, PDO::PARAM_STR);
  $sth->execute();
  if($sth->rowCount() < 1)
    return false;
  else 
    return true;
}

function usernameExists($username)
{
  $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
  $sql = "SELECT username FROM users where username = ?";
  $sth = $conn->prepare($sql);
  $sth->bindParam(1, $username, PDO::PARAM_STR);
  $sth->execute();
  if($sth->rowCount() < 1)
    return false;
  else 
    return true;
}

function passwordTheSame($password, $passwordConfirmation)
{
  if($password == $passwordConfirmation)
    return true;
  else
    return false;
}

function isSession()
{
  if(isset($_SESSION['email']))
    return true;
  else
    return false;
}

function isCookie()
{
  if(isset($_COOKIE['email']))
    return true;
  else
    return false;
}

function isAdmin()
{
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
    $sql = "SELECT admin FROM users where email = ? AND admin = 1";
    $sth = $conn->prepare($sql);
    if(isSession())
      $sth->bindParam(1, $_SESSION['email'], PDO::PARAM_STR);
    elseif(isCookie())
      $sth->bindParam(1, $_COOKIE['email'], PDO::PARAM_STR);
    $sth->execute();
    if($sth->rowCount() < 1)
      return false;
    else 
      return true;
}

function edit_user()
{
    $loginname = $_POST["login"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
 
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
 
      if(isset($_POST['username']) && strlen($_POST['username']) > 0)
      {
        if(usernameExists($_POST["username"]))
          echo "This username is already taken ! Be original...";
 
        $sqlName = "UPDATE users SET username = ? WHERE username = ?";
        $updateName = $conn->prepare($sqlName);
        $updateName->bindParam(1, $_POST['username'], PDO::PARAM_STR);
        $updateName->bindParam(2, $loginname, PDO::PARAM_STR);
        $updateName->execute();
        echo "Username modified";
      }
      if(isset($_POST['email']) && strlen($_POST['email']) > 0)
      {
          if(emailExists($_POST["email"]))
            echo "This email is already taken !";
 
        $sqlEmail = "UPDATE users SET email = ? WHERE username = ?";
        $updateEmail = $conn->prepare($sqlEmail);
        $updateEmail->bindParam(1, $_POST['email'], PDO::PARAM_STR);
        $updateEmail->bindParam(2, $loginname, PDO::PARAM_STR);
        $updateEmail->execute();
        echo "Email modified";
      }
      if(isset($_POST['password']) && isset($_POST['password']) == $password && strlen($_POST['password']) > 0)
      {
          if(!(passwordTheSame($_POST["password"], $_POST["password_confirmation"])))
            echo "Password and password confirmation are not the same... try again.";
 
        $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sqlPassword = "UPDATE users SET password = ? WHERE username = ?";
        $updatePassword = $conn->prepare($sqlPassword);
        $updatePassword->bindParam(1, $new_password, PDO::PARAM_STR);
        $updatePassword->bindParam(2, $loginname, PDO::PARAM_STR);
        $updatePassword->execute();
        echo "Password modified";
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
      $sth->bindParam(':admin', $admin, PDO::PARAM_STR);
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