<?php

namespace src\module;

use src\controller\UserController;
// signup::signup();
class signup
{
  public function returnUser()
  {

  }
  public function confirmEmail($email)
  {
    if (!$cleanUser['email']) {
            header('location: signup.php');
            $_SESSION['msg'] = '<h4 id="messageText">Email is not in the correct format </h4>';
            return;
          };
  }
  public static function signup()
  {
    if (isset($_POST['register-user'])) {
      $user = [];
      $user['email'] = $_POST['email'];
      $user['password'] = $_POST['password'];
      $user['firstName'] = $_POST['firstName'];
      $user['lastName'] = $_POST['lastName'];

      $trimmed = array_map(function ($element) {
        return trim($element);
      }, $user);
      $cleanUser['firstName'] = filter_var($trimmed['firstName'], FILTER_SANITIZE_STRING);
      $cleanUser['lastName'] = filter_var($trimmed['lastName'], FILTER_SANITIZE_STRING);
      $cleanUser['password'] = filter_var($trimmed['password'], FILTER_SANITIZE_STRING);
      $cleanUser['email'] = filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL);
      if (!$cleanUser['email']) {
        header('location: signup.php');
        $cleanUser['email'] = $_POST['email'];
        // unset($cleanUser['email']);
        $_SESSION['userData'] = json_encode($cleanUser);
        $_SESSION['msg'] = '<h4 id="messageText">Email is not in the correct format </h4>';

        return;
      };
      $cleanUser['password'] = md5($cleanUser['password']);
// $cleanUser['email'] ?: print_r('fdlsfjdfjldfs');

      UserController::signUp($cleanUser);
    }
  }
  public static function signIn()
  {
    if(!isset($_POST['login-user'])) return;
    $user = [];
    $user['email'] = trim($_POST['email']);
    $user['password'] = trim($_POST['password']);
    $cleanUser['email'] = filter_var($user['email'], FILTER_VALIDATE_EMAIL);
    $cleanUser['password'] = filter_var($user['password'], FILTER_SANITIZE_STRING);
    if (!$cleanUser['email']) {
            header('location: signup.php');
            $_SESSION['msg'] = '<h4 id="messageText">Email is not in the correct format </h4>';
            return;
          };
        UserController::signIn($cleanUser);
  }
}


// class signup {
// public static function signup()
// {
//   echo json_encode($_POST);
//   if (!isset($_POST['password'])) {echo 'shit'; return;}
//   $user = [];
// $user['email'] = $_POST['email'];
// $user['password'] = $_POST['password'];
// $user['firstName'] = $_POST['firstName'];
// $user['lastName'] = $_POST['lastName'];

//  UserController::signUp($user);
// }
// }
