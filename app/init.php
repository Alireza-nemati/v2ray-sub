<?php
session_start();

include_once "config.php";

foreach (glob(BASE_PATH ."core/*.php") as $filename) { include_once $filename; }

$users = getDB('servers-account') ?? [];
$db = getDB('database');

foreach (glob(BASE_PATH ."plugins/*.php") as $filename) { include_once $filename; }

foreach (glob(BASE_PATH ."controller/*.php") as $filename) { include_once $filename; }


router();