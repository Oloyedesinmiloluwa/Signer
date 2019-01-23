<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use src\controller\UserController;

ob_start();
session_start();

if (!isset($_SESSION['userData'])) {
    $_SESSION['msg'] = '<h4 id="messageText">You have to login to proceed! It is pretty easy</h4>';
    header('location: signin.php');
}
if (isset($_POST['reset-password-btn'])) {
    if ($_POST['confirm-password'] === $_POST['new-password']) {
        $email = json_decode($_SESSION['userData'], true)['email'];
        $response = UserController::resetPassword($_POST, $email);
        $_SESSION['msg'] =   $response? '<h4>Password has been updated</h4>' : '<h4 class="red-text">Password could not be reset, try again</h4>';
    } else {
        $_SESSION['msg'] =  '<h4 class="red-text">Password should match</h4>';
    }
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
    $users = UserController::fetchAllUser();
    $_SESSION['usersData']=$users;
    ?>
  <h2 id="request-header" class="text-center">Welcome <?php if (isset($_SESSION['userData'])) echo(json_decode($_SESSION['userData'], true))['firstName'] ?></h2>
  <p class="text-center">Here are all the list of users in this application</p>
  <table class="table-center">
    <thead>
      <th>S/N</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Status</th>
      <th>Action</th>
    </thead>
    <tbody>
        <?php
        if (isset($_SESSION['usersData'])) {
            $users = json_decode($_SESSION['usersData']);
            foreach ($users as $user) {?>
       <tr>
         <td><?php echo($user->id) ?></td>
         <td><?php echo($user->firstName) ?></td>
         <td><?php echo($user->lastName) ?></td>
         <td><?php echo($user->email) ?></td>
         <td><?php echo($user->status ? 'Enabled': 'Disabled') ?></td>
         <td>
           <form name="<?php echo $user->id?>" method="POST" action="<?php UserController::updateStatus($user->id, !$user->status)?>">
           <button class="delete-btn" name="<?php echo "delete-user-$user->id"?>" type="submit"><?php echo($user->status ? 'Disable': 'Enable') ?></button>
           </form>
       </tr>
            <?php }
        };
        ?>
    </tbody>
  </table>
  <div class="hr"></div>
  <div class="reset-password-wrapper">
  <h2>Reset your password</h2>
    <?php
    if (isset($_SESSION['msg'])) {
                echo($_SESSION['msg']);
            unset($_SESSION['msg']);
    }
    ?>
  <form method="POST" action="">
    <ul class="flex-outer-new" id="password-reset-form">
      <li>
    <label for="old-password">Old Password:</label>
    <input name="old-password" type="password" placeholder="Old password" />
  </li>
  <li>
    <label for="new-password">New Password: </label>
    <input name="new-password" type="password" placeholder="New password" />
  </li>
  <li>
    <label for="confirm-password">Confirm Password:</label>
    <input name="confirm-password" type="password" placeholder="Confirm password" />
  </li>
  <li>
 <button name="reset-password-btn">Reset Password</button>
 <li>
  </ul>
  </form>
</div>
</body>
</html>
