<?php

function servers_page()
{
    login();
    global $db;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            (isset($_POST['address']) && !empty($_POST['address'])) &&
            (isset($_POST['port']) && !empty($_POST['port'])) &&
            (isset($_POST['user']) && !empty($_POST['user'])) &&
            (isset($_POST['pass']) && !empty($_POST['pass']))
        ) {
            $address = trim($_POST['address']);
            $port = trim($_POST['port']);
            $user = trim($_POST['user']);
            $pass = trim($_POST['pass']);

            $db['server'] = ['address' => $address, 'port' => $port, 'username' => $user, 'password' => $pass];
            setDB('database', $db);
            go('server');
        } else {
            die("input Error");
        }
        die("input Error");
    }
        view('header', [], true);
        view('server', ['server' => ($db['server'])]);
        view('footer');

}

add_page('server', 'servers_page');