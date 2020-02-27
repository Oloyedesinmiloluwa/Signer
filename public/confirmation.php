<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Signer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet" />
</head>
<body>
    
</body>
</html>
<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
ob_start();
session_start();
use src\controller\UserController;
$identity_token = 'fCsSUk9oT8Cv7umVjvidELNIZmVi6GHLYGFJnF-Yh1IAr_VvfDc2S6oAAXS';
if (isset($_GET['tx'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.sandbox.paypal.com/cgi-bin/webscr');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'cmd' => '_notify-synch',
          'tx' => $_GET['tx'],
          'at' => $identity_token,
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $users = json_decode($_SESSION['usersData'], true);
    $user = json_decode($_SESSION['userData'], true);
    $userfromFilter = array_filter($users, function($element) use ($user) {
        return $element['id'] === $user['id'];
    });
    if (1) {//strpos($response, 'SUCCESS') === 0) {
        echo '<h4 id="messageText">We have received your payment, your transaction detail has been sent to your email. Please check your paypal account to see more detail<br> You will be redirected to the account page in 40 seconds</h4>';
        UserController::updateStatus($user['id'], !$userfromFilter[1]['status']);
        header("Refresh: 5, URL=http://{$_SERVER['HTTP_HOST']}/public/users.php");        
    
        } else {
            echo '<h4 id="messageText">Failure, we could not verify your purchase, Please try again. If you think this is a problem from us, please reach out to our support team at email_support@signer.com</h4>';
        }
}
