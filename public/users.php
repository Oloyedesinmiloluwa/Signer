<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use src\controller\UserController;
ob_start();
session_start();

if (!isset($_SESSION['userData'])) {
  $_SESSION['msg'] = '<h4 id="messageText">You have to login to proceed! It is pretty easy</h4>';
  header('location: signin.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Signer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="./css/main.css" rel="stylesheet" />
<link href="./css/normalize.css" rel="stylesheet" />
</head>
<body>
<nav role="navigation" class="navContainer">
      <ul class="nav navItem navStart">
        <li>
          <a href="index.php">Signer</a>
        </li>
      </ul>
      <ul class="nav navContainer navEnd">
        <li>
          <a href="countries.php">Countries</a>
        </li>
        <li>
          <a href="signout.php">Sign Out</a>
        </li>
      </ul>
    </nav>
  <?php
  $users =UserController::fetchAllUser();
  $_SESSION['usersData']=$users;
  ?>
  <h2 id="request-header" class="text-center">Welcome <?php if(isset($_SESSION['userData'])) echo(json_decode($_SESSION['userData'], true))['firstName'] ?></h2>
  <p class="text-center">Here are all the list of users in this application</p>
  <table class="table-center">
    <thead>
      <th>S/N</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
      if(isset($_SESSION['usersData'])){
       $users= json_decode($_SESSION['usersData']);
       foreach($users as $user){?>
       <tr>
         <td><?php echo($user->id) ?></td>
         <td><?php echo($user->firstName) ?></td>
         <td><?php echo($user->lastName) ?></td>
         <td><?php echo($user->email) ?></td>
         <td>
           <form name="<?php echo $user->id?>" method="POST" action="<?php UserController::deleteUser($user->id)?>">
           <button class="delete-btn" name="<?php echo "delete-user-$user->id"?>" type="submit">Delete</button>
           </form>
         <!-- <a href="">delete</a></td> -->
       </tr>
      <?php }
      };
      ?>
    </tbody>
  </table>

</body>
</html>
