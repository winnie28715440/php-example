<?php
require __DIR__ . '/is_admin.php';
require __DIR__ . '/db_connect.php';

if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']);
    $pdo->query("DELETE FROM `address_book` WHERE sid=$sid ");
}

//刪除資料後停留在那頁
//$_SERVER['HTTP_REFERER']做動作的那一頁網址
//如果是直接貼網址拜訪不一定會顯示REFERER
$backTo = 'ab-list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $backTo = $_SERVER['HTTP_REFERER'];
}

header('Location: ' . $backTo);
