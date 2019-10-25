<?php

namespace app\lib;

final class CSRF
{
    private static $tokenName = '_csrf_token';

    public static function createTokenField($tokenName = null)
    {
        if (empty($tokenName)) {
            $tokenName = self::$tokenName;
        }

        if (empty($_SESSION[$tokenName])) {
            $_SESSION[$tokenName] = bin2hex(random_bytes(32));
        }
        $token = $_SESSION['_csrf_token'];

        $field = "<input type='hidden' name='{$tokenName}' value='{$token}' id='{$tokenName}'>";

        echo $field;
    }

    public static function isTokenValid($tokenName = null)
    {
        if (empty($tokenName)) {
            $tokenName = self::$tokenName;
        }

        if (!hash_equals($_SESSION[$tokenName], $_POST[$tokenName])) {
            $errors[] = 'Invalid csrf token';
            return false;
        }

        return true;
    }
}
