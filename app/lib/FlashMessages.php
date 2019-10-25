<?php

namespace app\lib;

final class FlashMessages
{
    public static function set(string $type, string $text, $key = 'Info'): void
    {
        if ($type == 'error') {
            $type = 'danger';
        }
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = '';
        }
        $_SESSION[$key] .= '<div class="alert alert-'.$type.'" role="alert">'.$text.'</div>';
    }

    public static function get($key = 'Info'): string
    {
        if (isset($_SESSION[$key])) {
            $tmp = $_SESSION[$key];
            unset($_SESSION[$key]);

            return $tmp;
        }

        return '';
    }
}
