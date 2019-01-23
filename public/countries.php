<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use src\controller\UserController;
use src\Helpers;

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
    <title>Signer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="./css/main.css" rel="stylesheet" />
<link href="./css/normalize.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
          <a href="users.php">Users</a>
        </li>
        <li>
          <a href="signout.php">Sign Out</a>
        </li>
      </ul>
    </nav>

<h2 id="request-header" class="text-center">List of all Countries</h2>
<p class="text-center">We think you will find your country here. Check out to see if we are right</p>

    <?php
    $url = 'http://services.groupkt.com/country/get/all';
    if ($countries = Helpers::fetchFromApi($url)) {
        $_SESSION['countries'] = $countries['RestResponse']['result'];
    }
    ?>

<table class="table-center">
    <thead>
      <th>S/N</th>
      <th>Code</th>
      <th>Country Name</th>
      <th>Action</th>
    </thead>
    <tbody>
        <?php
        if (isset($_SESSION['countries'])) {
            $countries = $_SESSION['countries'];
            if (count($countries) >= 50) {
                $countries = array_slice($countries, 0, 50);
            }
            foreach ($countries as $index => $country) {?>
       <tr>
            <td><?php echo($index + 1) ?></td>
         <td><?php echo($country['alpha3_code']) ?></td>
         <td><?php echo($country['name']) ?></td>
         <td>
             <button id="<?php echo "{$country['alpha3_code']}" ?>" class="display-state" name="<?php  echo "{$country['name']}"?>" type="submit">View States</button>
     </td>
       </tr>
            <?php }
        };
        ?>
    </tbody>
  </table>
  <p class="text-center" id="page-num"></p>
    <div class="pagination">
      <button disabled id="prev-btn"><i class="fa fa-arrow-circle-left"></i> Prev</button>
      <button id="next-btn" data-offset="0" data-paginate-count="0">Next <i class="fa fa-arrow-circle-right"></i> </button>
    </div>
    <p class="text-center">All rights reserved. Signer &copy;2018</p>
    <script src="countries.js"></script>
    <script src="pagination.js"></script>
</body>
</html>
