<?php

function subPage($uid = ''): void
{
    global $db, $users;

    $id = $_GET["id"] ?? $uid;

    if ($id == '') {
        die(vmessMessage('‼️' . '.خطا! کاربر یافت نشد' . '‼️'));
    }
    # Account Information
    $userData = $users[$id] ?? die(vmessMessage('‼️' . '.خطا! کاربر یافت نشد' . '‼️'));

    $export = '';


    if ($userData['enable'] != true) {
        die(vmessMessage('‼️' . 'اکانت غیر فعال است.' . '‼️'));
    }

    # Account Expiry Date
    $expiryTime = $userData['expiryTime'];
    if (!empty($expiryTime) && $expiryTime != 0) {
        if (str_contains($userData['expiryTime'], '-')) {
            $expiryTime = (time() * 1000) + str_replace('-', '', $userData['expiryTime']);
        }

        $expiryTime = date("Y-m-d", substr($expiryTime, 0, -3));
        $expiryTime = expire($expiryTime);
    } else {
        $expiryTime = '♾ Infinite';
    }


    # Account Total GB
    $totalGB = '♾ Infinite';
    if ($userData['totalGB'] != 0) {
        $totalGB = formatBytes($userData['totalGB']);
    }

    $totalR = formatBytes($userData['up'] + $userData['down'], 2);




    $export .= vmessMessage('📅 Expire in: ' . $expiryTime, 'Account.info', '80') . PHP_EOL;
    $export .= vmessMessage('🔄 Total: ' . $totalR . ' / ' . $totalGB, 'Account.info', '80') . PHP_EOL;


    #Account Configuration
    foreach ($db['ip-category'] as $title => $categories) {
        foreach ($categories as $ip) {
            $dataR = [
                '[/uid]' => $id,
                '[/ip]' => $ip,
                '[/title]' => $title,
                '[/port]' => $userData['port'],
                '[/protocol]' => $userData['protocol'],
            ];
            $okLink = multi_replace(base64_decode(str_replace('vmess://', '', $db['config'])), $dataR);
            // if(in_array($id,$filter)){
            $export .= 'vmess://' . base64_encode($okLink) . PHP_EOL;
            // }

        }
    };
    echo isset($_GET['def']) ? $export : base64_encode($export);
}

add_page('sub', 'subPage');
