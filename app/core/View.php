<?php

namespace app\core;

final class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render(string $title, $vars = [])
    {
        extract($vars);
        $path = 'resources/views/'.$this->path.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'resources/views/layouts/'.$this->layout.'.php';
        }
    }

    public function redirect(string $url): void
    {
        header('location: /'.$url);
        exit;
    }

    public static function errorCode($code): void
    {
        http_response_code($code);
        $path = 'resources/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    public function message($status, $message): void
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

}
