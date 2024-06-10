<?php
const PATH_ROOT = __DIR__ . '/';

const PATH_ASSET = __DIR__ . '/assets/';

if (!function_exists('asset')) {
    function asset($path)
    {
        return $_ENV['BASE_URL'] . $path;
    }
}

if (!function_exists('url')) {
    function url($uri = null)
    {
        return $_ENV['BASE_URL'] . $uri;
    }
}

if (!function_exists('show_upload')) {
    function show_upload($path)
    {
        return $_ENV['BASE_URL'] . '/assets/' . $path;
    }
}


if (!function_exists('is_logged')) {
    function is_logged()
    {
        return isset($_SESSION['user']);
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return is_logged() && $_SESSION['user']['type'] = 'admin';
    }
}

if (!function_exists('avoid_login')) {
    function avoid_login()
    {
        if (is_logged()) {
            if ($_SESSION['user']['type'] = 'admin') {

                header('Location: ' . url('admin'));
                exit;
            }

            header('Location: ' . url());
            exit;
        }
    }
}




if (!function_exists('middleware_auth')) {
    function middleware_auth()
    {
        if (!isset($_SESSION['user'])) {

            header('location: ' . url('login'));
            exit();
        } else {
            if ($_SESSION['user']['type'] != 'admin') {
                header('location: ' . url(''));
                exit();
            }
        }
    }
}




if (!function_exists('caculator_total_oder')) {
    function caculator_total_oder($product)
    {
        return array_reduce($product, function ($carry, $item) {
            return $carry + (($item["price_sale"] ?: $item["price_regular"]) * $item["quantity"]);
        }, 0);
    }
}
