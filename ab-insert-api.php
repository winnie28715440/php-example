<?php
//負責儲存新增資料
require __DIR__ . '/is_admin.php';
require __DIR__ . '/db_connect.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];

if (!isset($_POST['sid']) or !isset($_POST['name']) or !isset($_POST['email'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查欄位格式

//從後端檢查信箱格式
$email_re = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
if (!preg_match($email_re, $_POST['email'])) {
    $output['code'] = 400;
    $output['error'] = 'Email 格式錯誤';

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
//preg開頭的功能都跟regular expression有關
//preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] ) : int

$sql = "UPDATE `address_book` SET 
`name`=?,
`email`=?,
`mobile`=?,
`birthday`=?,
`address`=? 
WHERE `sid`=?";


//‘？’prepare&execute是為了避免SQL injection語法重大安全問題先幫未來的值佔位子
//可以幫忙跳脫單引號避免用戶輸入sql語法


$stmt = $pdo->prepare($sql);
//值是從外面進來的時候要用prepare
$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    empty($_POST['birthday']) ? NULL : $_POST['birthday'],
    //empty()php語法，判斷是否為空值，結果為布林值
    $_POST['address'],
    $_POST['sid'],
]);

//rowCount()算出新增幾筆資料
$output['rowCount'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['success'] = true;
    unset($output['error']);
} else {
    $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
