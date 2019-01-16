<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use src\module\signup;
use src\controller\UserController;
ob_start();
session_start();
// $db1 = getenv('test');
// $db1 = $_ENV;
// $db2= getenv('DB_NAME');
// $bb = $_ENV['test'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Signer</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" shrink-to-fit=no">
<link href="css/main.css" rel="stylesheet" />
<link href="css/normalize.css" rel="stylesheet" />
</head>
<body>
    <nav role="navigation" class="navContainer">
        <ul class="nav navItem navStart">
            <li><a href="index.html">Signer</a></li>
        </ul>
        <ul class="nav navContainer navEnd">
            <li><a href="index.html">Home</a></li>
            <li><a href="#"></a></li>
            <li><a href="signin.php">Sign in</a></li>
        </ul>
    </nav>
    <h1 class="text-center" id= "logo">Signer</h1>
    <p class="text-center" id="welcome-text">We simply show you all the users on our app</p>
    <div class="form-container">
    <h3 class="text-center" id ="login-text">Create an account with us</h3>
<div class="container">
          <?php
            if(isset($_SESSION['msg']))echo($_SESSION['msg']);
            unset($_SESSION['msg']);
            // $inputData=['firstName' => '', 'lastName' => '', 'email' => ''];
            if(isset($_SESSION['userData'])) {
              $inputData = json_decode($_SESSION['userData'],true);
              unset($_SESSION['userData']);
            }

          ?>
    <form id="signup-form" method="POST" action="<?php signup::signup(); ?>" actioffn="../src/controller/UserController.php"  actffion="http://localhost:8000/src/controller/UserController.php">
      <ul class="flex-outer">
          <p id = "messageText" ></p>
        <li>
          <label for="first-name">First Name<span class="red-text">*</span></label>
          <input type="text" id="first-name" value="<?php echo isset($inputData)?$inputData['firstName']:null ?>" name="firstName" placeholder="First name">
        </li>
        <li>
          <label for="last-name">Last Name<span class="red-text">*</span></label>
          <input type="text" name="lastName" value="<?php echo isset($inputData)?$inputData['lastName']:null ?>" id="last-name" placeholder="Last name">
        </li>
        <li>
          <label for="email">Email<span class="red-text">*</span></label>
          <input type="email****" id="email" value="<?php echo isset($inputData)?$inputData['email']:null ?>" name="email" placeholder="Email">
        </li>
        <li>
          <label for="password">Password<span class="red-text">*</span></label>
          <input type="password" id="password" name="password" placeholder="Password">
        </li>
        <li>
          <button id="submitButton" name="register-user" type="submit">Sign up</button>
        </li>
      </ul>
    </form>
  </div>
  </div>
  <p class="text-center">All rights reserved. Signer &copy;2018</p>
</body>
</html>
