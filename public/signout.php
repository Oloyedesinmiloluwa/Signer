<?php
session_start();

unset($_SESSION['userData']);
unset($_SESSION['usersData']);
session_destroy();
header('location: signin.php');
