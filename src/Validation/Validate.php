<?php

namespace src\Validation;

class Validate
{
    public static function signup()
    {
        if (isset($_POST['register-user'])) {
            $user = [];
            $user['email'] = $_POST['email'];
            $user['password'] = $_POST['password'];
            $user['firstName'] = $_POST['firstName'];
            $user['lastName'] = $_POST['lastName'];

            $trimmed = array_map(
                function ($element) {
                    return trim($element);
                },
                $user
            );
            $cleanUser['firstName'] = filter_var($trimmed['firstName'], FILTER_SANITIZE_STRING);
            $cleanUser['lastName'] = filter_var($trimmed['lastName'], FILTER_SANITIZE_STRING);
            $cleanUser['password'] = filter_var($trimmed['password'], FILTER_SANITIZE_STRING);
            $cleanUser['email'] = filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL);
            return $cleanUser;
        }
    }
    public static function signIn()
    {
        if (!isset($_POST['login-user'])) {
            return;
        }
        $user = [];
        $user['email'] = trim($_POST['email']);
        $user['password'] = trim($_POST['password']);
        $cleanUser['email'] = filter_var($user['email'], FILTER_VALIDATE_EMAIL);
        $cleanUser['password'] = filter_var($user['password'], FILTER_SANITIZE_STRING);
        return $cleanUser;
    }
}
