<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

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
          <a href="countries.php">Countries</a>
        </li>
        <li>
          <a href="signout.php">Sign Out</a>
        </li>
      </ul>
    </nav>

<h2 id="request-header" class="text-center">List of States</h2>
<div class="modal-content clearfix">
            <h4>States in <?php echo isset($_GET['name'])? $_GET['name'] : 'Selected Country' ?></h4>
            <p>These are all the states in this country</p>
           <div class="email-container">
          <ul class="modal-display">
            Please wait...
          </ul>
            <form method="POST" action="countries.php">
          </div>
              <button id="modal-btn" type="submit">Go back</button>
            </form>
      </div>
  <p class="text-center" id="page-num"></p>
    <div class="pagination">
      <button disabled id="prev-btn"><i class="fa fa-arrow-circle-left"></i> Prev</button>
      <!-- <button id="next-btn">Next <i class="fa fa-arrow-circle-right"></i> </button> -->
      <button id="next-btn" data-offset="0" data-paginate-count="0">Next <i class="fa fa-arrow-circle-right"></i> </button>

    </div>
    <p class="text-center">All rights reserved. Signer &copy;2018</p>
    <script src="states.js"></script>
    <script src="pagination.js"></script>
</body>
</html>
