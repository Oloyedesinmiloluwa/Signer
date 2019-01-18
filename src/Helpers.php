<?php

namespace src;
class Helpers
{
  public function fetchState()
  {
    
  }
  public static function fetchFromApi($url)
  {
    // $url = 'http://services.groupkt.com/country/get/all';
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result,true);
  }
}

?>
