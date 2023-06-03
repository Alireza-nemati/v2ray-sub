<?php

function adminUsersPage()
{
    global $users, $db;
    view('header', [], true);
    view('users', ['db' => $db, 'users' => $users]);
    view('footer');
}
add_page('users', 'adminUsersPage');