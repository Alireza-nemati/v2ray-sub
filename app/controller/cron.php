<?php

function cronPage(): void
{
    global $db;
    $server_info = $db['server'];

    $api = new xui($server_info['address'], $server_info['port'], $server_info['username'], $server_info['password'], 'main');
    $api->getList();
    $users = $api->getInbound(0);


    if ($users) {
        setDB('servers-account', $users);
        echo "Users Updated Successfully";
    }else{
        echo "Users Updated Failed - ";
    }


}

add_page('cron', 'cronPage');