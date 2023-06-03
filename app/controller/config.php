<?php

function configPage($slug = 'index')
{
    login();
    global $db;
    switch ($slug) {
        case 'index':
            view('header', [], true);
            view('config', ['category' => ($db['ip-category']),'config'=>($db['config'])]);
            view('footer');
            break;
        case 'create-category':
            $title = $_POST['title'] ?? go('config');
            if (!isset($db['ip-category'][trim($title)])) {
                $db['ip-category'][trim($title)] = [];
                setDB('database', $db);
            }
            go('config');
            break;
        case 'delete-category':
            $id = $_GET['id'] ?? go('config');
            if (isset($db['ip-category'][trim($id)])) {
                unset($db['ip-category'][trim($id)]);
                setDB('database', $db);
            }
            go('config');
            break;
        case 'add-ip':
            $category = $_POST['category'] ?? go('config');
            $ip = $_POST['ip'] ?? go('config');
            $db['ip-category'][trim($category)] [] = trim($ip);
            setDB('database', $db);
            go('config');
            break;
        case 'delete-ip':
            $id = $_GET['id'] ?? go('config');
            $category = $_GET['category'] ?? go('config');

            if (isset($db['ip-category'][trim($category)][trim($id)])) {
                unset($db['ip-category'][trim($category)][trim($id)]);
                setDB('database', $db);
            }
            go('config');
            break;

        case 'set-config':
            $config = $_POST['config'] ?? go('config');
            $db['config'] = trim($config);
            setDB('database', $db);
            go('config');
            break;
        default:
            view('404');
    }


}

add_page('config', 'configPage');


