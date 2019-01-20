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

<h2 id="request-header" class="text-center">List of States in</h2>

  <?php
  $url = 'http://services.groupkt.com/country/get/all';
  if($countries = Helpers::fetchFromApi($url)){
  $_SESSION['countries'] = $countries['RestResponse']['result'];
  }
  ?>

<table class="table-center">
    <thead>
      <th>Code</th>
      <th>Country Name</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
      if(isset($_SESSION['countries'])){
        $countries = $_SESSION['countries'];
        if(count($countries) >= 50){
          $countries = array_slice($countries,0,50);
        }
       foreach($countries as $country){?>
       <tr>
         <td><?php echo($country['alpha3_code']) ?></td>
         <td><?php echo($country['name']) ?></td>
         <td>
         	<button class="display-state" id="display-state"  name="<?php echo "{$country['alpha3_code']}"?>" type="submit">View States</button>
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
  <div class="modal">
        <div class="modal-content clearfix">
            <div class="close">&times;</div>
            <h4>States in selected Country</h4>
            <p>These are all the states in this country</p>
           <div class="email-container">
          <ul class="modal-display">
            Please wait...
          </ul>
            <form method="POST" action="">
          </div>
              <button id="modal-btn" type="submit">Close</button>
            </form>
      </div>
    </div>
    <p class="text-center">All rights reserved. Signer &copy;2018</p>
    <script src="countries.js"></script>
</body>
</html>
