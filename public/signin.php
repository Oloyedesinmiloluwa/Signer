<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use src\module\signup;
use src\controller\UserController;
ob_start();
session_start();
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
            <li><a href="index.html">M-Tracker</a></li>
        </ul>
        <ul class="nav navContainer navEnd">
            <li><a href="index.html">Home</a></li>
            <li><a href="#"></a></li>
            <li><a href="signup.php">Sign up</a></li>
        </ul>
    </nav>
    <h1 class="text-center" id= "logo">Signer</h1>
    <p class="text-center" id="welcome-text">We simply show you all the users on our app</p>
    <div class="form-container">
    <h3 class="text-center" id ="login-text">Provide your login details</h3>
    <?php
            if(isset($_SESSION['msg']))echo($_SESSION['msg']);
            unset($_SESSION['msg']);
          ?>
<div class="container">
<form method="POST" action="<?php signup::signIn() ?>" baction="../src/controller/UserController.php">
      <ul class="flex-outer">
          <p id = "messageText" ></p>
        <li>
          <label for="email">Email<span class="red-text">*</span></label>
          <input type="email"  name="email" id="email" placeholder="Email">
        </li>
        <li>
          <label for="password">Password<span class="red-text">*</span></label>
          <input type="password" name="password" id="password" placeholder="Password">
        </li>
        <li>
          <a href="" id="forgot-pswd"> Forgot your password ?</a>
        </li>
        <li>
        <button id="fit-footer" name="login-user" type="submit">Sign in</button>
        </li>
      </ul>
    </form>
  </div>
    </div>
    <div class="modal">
        <div class="modal-content clearfix"> 
            <div class="close">&times;</div>
            <h4>Password Recovery</h4> 
      <p>Provide the email address you registered with</p>
          <div class="email-container">
            <form method="POST" action="<?php UserController::sendEmail() ?>">
             &nbsp;<i class="fa fa-user"></i>&nbsp; <input type="email" name="reset-email" id="modal-email" placeholder="Email" autofocus>
          </div>
          <p class="text-center"><small> We will send you a link to reset your password</small></p>
          <p id = "modal-messageText" class="text-center" ></p>
          <button name="send-email" id="modal-btn" type="submit">Submit</button>
        </form>
      </div>
    </div>
    <p class="text-center">All rights reserved. M-tracker &copy;2018</p>
    <script>
      const forgotPassword = document.getElementById('forgot-pswd');
      const modal = document.getElementsByClassName('modal')[0];
      forgotPassword.addEventListener('click', (event) => {
  event.preventDefault();
  modal.style.display = 'block';
});
const closeBtn = document.querySelector('.close');
closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
  // modalMessageText.textContent = '';
});
      </script>
</body>
</html>
