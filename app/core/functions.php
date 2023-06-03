<?php

function theme_path(): string
{
    return BASE_PATH . 'themes' . DIRECTORY_SEPARATOR . ACTIVE_THEME . DIRECTORY_SEPARATOR;
}

function add_page($slug, $func): void
{
    global $routes;
    $routes[$slug] = $func;
}

function add_menu($title, $slug)
{
    global $menus;
    $menus[] = [
        'title' => $title,
        'slug' => $slug
    ];
}

function load_menu($html_format)
{
    global $menus;
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    foreach ($menus as $menu) {
        $format = str_replace('[title/]', $menu['title'], $html_format);
        $format = str_replace('[slug/]', $menu['slug'], $format);
        $format = ($url == $menu['slug']) ? str_replace('[active/]', 'active', $format) : str_replace('[active/]', '', $format);
        echo $format;
    }
}

function getDB(string $db_name)
{
    $db_path = BASE_PATH . 'database' . DIRECTORY_SEPARATOR . $db_name . '.json';
    return file_exists($db_path) ? json_decode(file_get_contents($db_path), true) : null;
}

function setDB(string $db_name, $datas = []): bool
{
    $db_path = BASE_PATH . 'database' . DIRECTORY_SEPARATOR . $db_name . '.json';
    return file_put_contents($db_path, json_encode($datas));
}

function vless(string $uid, string $server, int $port, string $path, string $security, string $host, string $sni, string $remark): string
{
    return "vless://$uid@$server:$port?path=$path&security=$security&encryption=none&host=$host&type=ws&sni=$sni#$remark";
}

function tcp(string $uid, string $server, int $port, string $remark): string
{
    return "vless://$uid@$server:$port?encryption=none&security=none&type=tcp&headerType=http#$remark";
}


function go($route = null): void
{
    $url = BASE_URL . $route;
    if (!headers_sent()) {
        header('Location: ' . $url);
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
    }
    exit;
}

function is_login(): bool
{
    $session = base64_encode(SITE_TITLE) . '_Login';
    return isset($_SESSION[$session]) && ($_SESSION[$session] == 'ok');
}

function login(): void
{
    $session = base64_encode(SITE_TITLE) . '_Login';
    $check = isset($_SESSION[$session]) && ($_SESSION[$session] == 'ok');
    if (!$check) {
        go(Login_PAGE);
    }
}


function view($view_Name, $data = [], $need_Login = false): void
{
    $view_Name = str_replace(['.', '/', '\\'], DIRECTORY_SEPARATOR, $view_Name);
    $File_path = theme_path() . $view_Name . '.php';
    extract($data);
    if ($need_Login) {
        is_login() ? include_once $File_path : exit('Limited Access !');
    } else {
        include_once $File_path;
    }
}


function multi_replace($str, $reps = [])
{
    foreach ($reps as $key => $value) {
        $str = str_replace($key, $value, $str);
    }
    return $str;
}

function formatBytes($size, $round = 0): string
{
    if ($size == 0) {
        return '0 B';
    }
    $base = log($size) / log(1024);
    $suffix = array("B", "KB", "MB", "GB", "TB");
    $f_base = floor($base);
    return round(pow(1024, $base - floor($base)), $round) . $suffix[$f_base];
}

function expire($ex_date, $format = '%R%a Days'): string
{
    $date1 = date_create(date("Y-m-d"));
    $date2 = date_create($ex_date);

    $diff = date_diff($date1, $date2);
    return $diff->format($format);
}

function vmessMessage($ps, $add = 'iPlus.vpn', $port = '80')
{
    $vmess = '{
      "v": "2",
      "ps": "' . $ps . '",
      "add": "' . $add . '",
      "port": ' . $port . ',
      "id": "123-123-123-123",
      "aid": 0,
      "net": "ws",
      "type": "none",
      "host": "",
      "path": "/",
      "tls": "none",
      "sni": "",
      "fp": "",
      "alpn": "",
      "allowInsecure": false
    }';

    return 'vmess://' . base64_encode($vmess);
}

function loading($number): string
{
    if ($number <= 10) {
        return '■□□□□□□□□□';
    } elseif ($number <= 20) {
        return '■■□□□□□□□□';
    } elseif ($number <= 30) {
        return '■■■□□□□□□□';
    } elseif ($number <= 40) {
        return '■■■■□□□□□□';
    } elseif ($number <= 50) {
        return '■■■■■□□□□□';
    } elseif ($number <= 60) {
        return '■■■■■■□□□□';
    } elseif ($number <= 70) {
        return '■■■■■■■□□□';
    } elseif ($number <= 80) {
        return '■■■■■■■■□□';
    } elseif ($number <= 100) {
        return '■■■■■■■■■□';
    } elseif ($number >= 100) {
        return '■■■■■■■■■■';
    }
    return '□□□□□□□□□□';
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}