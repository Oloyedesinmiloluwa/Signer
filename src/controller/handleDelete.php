<?php
namespace src\controller;
// require_once dirname(__DIR__) . '/vendor/autoload.php';

use UserController;

class deleteUser{
 public function __construct()
 {
  UserController::deleteUser();
 }
}
new deleteUser();
