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
      <button disabled><i class="fa fa-arrow-circle-left"></i> Prev</button>
      <button id="next-btn" data-offset="0" data-paginate-count="0">Next <i class="fa fa-arrow-circle-right"></i> </button>
    </div>
  <div class="modal">
        <div class="modal-content clearfix"> 
            <div class="close">&times;</div>
            <h4>States in selected Country</h4> 
      <p>These are all the states in this country</p>
  <div class="email-container">
  <ul class="modal-display">
  No data found
    </ul>
            <form method="POST" action="">
          </div>
          <button id="modal-btn" type="submit">Close</button>
        </form>
      </div>
    </div>
    <p class="text-center">All rights reserved. Signer &copy;2018</p>
    <script>
      // const displayState = document.querySelectorAll('.display-state');
      const table = document.querySelector('table');
      const modal = document.getElementsByClassName('modal')[0];
      table.addEventListener('click', (event) => {
  event.preventDefault();
  if (event.target.matches('button')) {
    event.preventDefault();
  modal.style.display = 'block';
    // window.location.href = 'detail.html';
  }
});
//       displayState.addEventListener('click', (event) => {
//   event.preventDefault();
//   modal.style.display = 'block';
// });
const closeBtn = document.querySelector('.close');
closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
  // modalMessageText.textContent = '';
});
      </script>
<script src="countries.js"></script>
<script type="text/javascript">
  // const countryDropdown = document.getElementByName('country-dropdown');
  // $('thead').hide();
  // function getState(){
    // $url = "http://services.groupkt.com/state/get/USA/all";

    /* function mapCountriesToTable(data, offset=0){
      let disp='';
      let splitData;
      if(data.length >= 50){
        splitData = data.slice(offest, offset + 50);
      }
      splitData.forEach(element => {
          disp +=`<li>${element.name}</li>`;
        });
        return disp;
    } */
  $(document).ready(function(){
    $('#next-btn').click(function(){
      alert(event.target.getAttribute(['data-offset']));
      /* $.ajax({
      url: 'countries.php?offset=0',
      type: 'GET',
      dataType: 'json',
      success:function(data){
      }
    }); */
    });
  $('.display-state').click(function () {
    $.ajax({
      url: `../src/fetchState.php?code=${event.target.name}`,
      type: 'GET',
      dataType: 'json',
      success:function(data){
        /* let disp='';
        // if(data.RestResponse.result.length = 0){
        //   $('ul.modal-display').html(`<li>NO data found</li>`);
        //   return;
        // }

        data.RestResponse.result.forEach(element => {
          disp +=`<li>${element.name}</li>`;
        });
        $('ul.modal-display').html(disp); */
        $('ul.modal-display').html(mapCountriesToTable(data.RestResponse.result));
        },
      error: function (error) {
        $('ul.modal-display').text(`Error fetching data`);
      }
    })
    // fetchState(event.target.name);
    });
  });
  // }
    // const stateUrl = 'http://services.groupkt.com/state/get/IND/all';
    // const result = fetchCountries(stateUrl);
    // return result;
</script>
</body>
</html>
