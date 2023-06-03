<?php



function loginPage()
{
    if (is_login()) {
        go('dashboard');
    }
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $token = $_SESSION['token'];
    view('login', ['token' => $token]);

}
add_page('login', 'loginPage');
add_page('index', 'loginPage');

function adminAction()
{

    if (
        (!empty($_POST['username'])) &&
        (!empty($_POST['password'])) &&
        (!empty($_POST['token'])) &&
        ($_SESSION['token'] === $_POST['token']) &&
        (ADMIN_INFO['username'] == $_POST['username'] && ADMIN_INFO['password'] == $_POST['password'])
    ) {
        $session = base64_encode(SITE_TITLE) . '_Login';
        $_SESSION[$session] = 'ok';
        go('dashboard');
    } else {
        $_SESSION['error'] = 'نام کاربری یا رمزعبور اشتباه است.';
        go('login');
    }

}
add_page('login-action', 'adminAction');


function signoutAction()
{
    session_unset();
    session_destroy();
    go('login');

}

add_page('signout', 'signoutAction');