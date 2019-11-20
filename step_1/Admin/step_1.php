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


function getUserId($username)
{
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=pool_php_rush", 'root', "Bonjourmysql31200!");
    $sql = "SELECT id FROM users where username = ?";
    $sth = $conn->prepare($sql);
    $sth->bindParam(1, $username, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}
?>