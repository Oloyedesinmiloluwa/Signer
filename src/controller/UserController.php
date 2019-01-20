<?php
namespace src\controller;
use src\config\Database;
use PDO;

class UserController
{
  public static function resetPassword($post, $email)
  {
    $query = 'UPDATE user set password=:password WHERE email=:email AND password=:oldPassword';
    $db = new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $db->stmt->bindValue(':password', md5($post['new-password']), PDO::PARAM_STR);
    $db->stmt->bindValue(':oldPassword', md5($post['old-password']), PDO::PARAM_STR);
    $db->stmt->execute();
    return $db->stmt->rowCount();
  }
  public static function sendEmail()
  {
    $query= 'SELECT * FROM user WHERE email=:email';
    $db= new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':email', $_POST['reset-email']);
    $db->stmt->execute();
    if($db->stmt->rowCount()){
    mail($_POST['reset-email'], 'Signer-password reset', 'Hi, we want you to know that you are nice');
    return true;
    }
    else return false;
  }
  public static function deleteUser($id=null)
  {
    if(!isset($_POST["delete-user-$id"])) return;
    $query= 'DELETE FROM user WHERE id=:id';
    $db= new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':id', $id);
    $db->stmt->execute();
    $db->stmt->rowCount();
    header('location: users.php');
  }

  public static function fetchAllUser()
  {
    $query='SELECT * FROM user';
    $db = new Database();
    $db->prepare($query);
    $db->stmt->execute();
    return json_encode($db->stmt->fetchAll());
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
    return $fetchedData;
  }
  public static function signUp($user)
  {
    $query = 'INSERT INTO user (email, firstName, lastName, password) VALUES (:email,:firstName, :lastName, :password)';
    $db = new Database();
    $db->prepare($query);
    $db->stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $db->stmt->bindValue(':firstName', $user['firstName'], PDO::PARAM_STR);
    $db->stmt->bindValue(':lastName', $user['lastName'], PDO::PARAM_STR);
    $db->stmt->bindValue(':password', md5($user['password']), PDO::PARAM_STR);
    $isCreated = $db->stmt->execute();
    return $isCreated;
  }

}
