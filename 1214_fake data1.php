<?php
mb_internal_encoding("UTF-8");
//中文編碼 15年前的...
require __DIR__ . '/db_connect.php';

$str = "寶佳炒遠百捅出大事謝金河誰招惹了徐旭東稍不小心容易出事";

function str_shuffle_unicode($str)
{
    $tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    shuffle($tmp);
    return join("", $tmp);
}


$sql = "INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`)
 VALUES (
    ?, ?, ?, ?, ?, NOW()
)";

$stmt = $pdo->prepare($sql);

for ($i = 0; $i < 10; $i++) {
    $stmt->execute([
        //分割sting方法：substr ( string $string , int $offset [, int|null $length = null ] ) : string
        //mb_substr()分割中文字串＊substring:分隔字串
        mb_substr(str_shuffle_unicode($str), 0, 3),
        'test@gmail.com',
        '0918-444-777',
        '1999-5-5',
        '台北市',
    ]);
}

echo 'ok';
