<!-- cookie資料存放在http headers(表頭)
所以設定要記得放在最前面 -->
<!-- 第一次設定cookie的時候request方還未收到cookie,
第二次request方回傳給respond方才會收到cookie.
第一次：
respond:1
request:0
第二次：
respond:2
request:1 -->
<?php
setcookie("mycookie", "2"); //setcookie(cookie名稱,cookie value,time()單位是timestamp 2秒)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- 呼叫cookie時，要用＄_COOKIE -->
    <?= $_COOKIE["mycookie"]; ?>
</body>

</html>