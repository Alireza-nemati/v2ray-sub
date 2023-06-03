<?php


add_menu('<i class="bi bi-speedometer2"></i> داشبورد', BASE_URL . 'dashboard');
add_menu('<i class="bi bi-hdd-stack"></i> سرور', BASE_URL . 'server');
add_menu('<i class="bi bi-people"></i> کاربران', BASE_URL . 'users');
add_menu('<i class="bi bi-database-fill-gear"></i> کانفیگ ها', BASE_URL . 'config');
//add_menu('<i class="bi bi-gear"></i> تنظیمات', BASE_URL . 'settings');



function dashboardPage()
{
    global $users, $db;

    $count_all_ip = 0;
    foreach ($db['ip-category'] as $category){
        $count_all_ip = $count_all_ip + count($category);

    }
    view('header', [], true);
    view('dashboard', ['count_all_ip' => $count_all_ip, 'users' => $users]);
    view('footer');
}
add_page('dashboard', 'dashboardPage');









