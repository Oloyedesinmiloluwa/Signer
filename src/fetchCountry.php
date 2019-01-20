<?php

namespace src;
require 'Helpers.php';

if(isset($_GET['offset'])){
  $url = 'http://services.groupkt.com/country/get/all';
  $_SESSION['countries'] = json_encode(Helpers::fetchFromApi($url));
  print_r($_SESSION['countries']);
}
