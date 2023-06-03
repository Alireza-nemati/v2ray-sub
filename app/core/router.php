<?php

function router()
{
    global $routes;
    $url = $_GET['url'] ?? 'index';
    $ex_url = explode('/', $url);
    $cut_url = ($ex_url);
    $index_0 = $cut_url[0];
    if (isset($routes[($index_0)])) {
        $func = $routes[($index_0)];
        unset($cut_url[0]);
        if (function_exists($func)) {
            return call_user_func_array($func, array_values($cut_url));
        }
    }else{
        view('404');
    }
}