<?php

namespace src;

require 'Helpers.php';

if ($code = $_GET['code']) {
    $url = "http://services.groupkt.com/state/get/$code/all";
    $_SESSION['states'] = json_encode(Helpers::fetchFromApi($url));
    print_r($_SESSION['states']);
}
