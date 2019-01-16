<?php
namespace src\controller;
use src\config\Database;
use PDO;
// require "../config/Database.php";
// UserController::signUp($user);

class UserController
{
  public static function sendEmail()
  {
    if (!isset($_POST['reset-email'])) return;
    $query= 'SELECT * FROM user WHERE email=:email';
    $db= new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':email', $_POST['reset-email']);
    $db->stmt->execute();
    if($db->stmt->rowCount()){
    mail($_POST['reset-email'], 'Signer-password reset', 'Hi, we want you to know that you are nice');
    $_SESSION['msg']= '<h4 id="messageText">Email sent please follow the link in the email to reset password</h4>';

    }
    else {
      $_SESSION['msg']= '<h4 id="messageText">Email address does not exist</h4>';
    header('location: signin.php');
  }

  }
  public static function deleteUser($id=null)
  {
    // makes call the number of times as the no of users
    if(!isset($_POST["delete-user-$id"])) return;
    $query= 'DELETE FROM user WHERE id=:id';
    $db= new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':id', $id);
    $db->stmt->execute();
    $db->stmt->rowCount();
    header('location: list.php');
    // $db;
    // $db->stmt->bindValue(':id', $id, PDO::PARAM_INT);

  }
  public static function fetchAllUser()
  {
    $query='SELECT * FROM user';
    $db = new Database();
    $db->prepare($query);
    $db->stmt->execute();

    $_SESSION['usersData']=json_encode($db->stmt->fetchAll());
  }
  public static function signIn($user)
  {
    $hashedPassword = md5($user['password']);
    $query = 'SELECT * FROM user WHERE email=:email AND password=:password';
    $db = new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $db->stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
    $db->stmt->execute();
    $fetchedData = $db->stmt->fetch(PDO::FETCH_ASSOC);
    if($fetchedData){
      unset($fetchedData['password']);
      $_SESSION['userData'] = json_encode($fetchedData);
      header('location: list.php');
    } else {
      $_SESSION['msg']='<h4 id="messageText">Email address and password do not match any account</h4>';
      header('location: signin.php');

    };
    // return print_r(json_encode($db->stmt->fetch(PDO::FETCH_ASSOC)));

  }
  public static function signUp($user)
  {
    // echo "i came here yerserday";

    // if (!isset($_POST['password'])) return;
    // $user = [];
    // $user['email'] = $_POST['email'];
    // $user['password'] = $_POST['password'];
    // $user['firstName'] = $_POST['firstName'];
    // $user['lastName'] = $_POST['lastName'];
    // echo "i came here today";
    // die('$user');
    // $email = 'sinmi@yahoo.com';
    // validate before coming here
    $query = 'INSERT INTO user (email, firstName, lastName, password) VALUES (:email,:firstName, :lastName, :password)';
    $db = new Database();
    $db->prepare($query);

    $db->stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $db->stmt->bindValue(':firstName', $user['firstName'], PDO::PARAM_STR);
    $db->stmt->bindValue(':lastName', $user['lastName'], PDO::PARAM_STR);
    $db->stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);
    // $isCreated = $db->stmt->execute() ?  '<h1>I worked </h1>' : '<h1> Error </h1>';
    $isCreated = $db->stmt->execute();
    if($isCreated){
      header('location: signin.php');
      // header('Content-Type: application/json');
       print_r(json_encode([
        'data' => $user,
        'message' => 'Successfully created account'
      ]));
    }
    
    // return $message;
    // return $db->stmt->execute();
  }

}
