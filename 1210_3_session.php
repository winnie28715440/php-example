<?php
/*session是建立在cookie之上，為資料存活時間
//session 是儲存在伺服器端的檔案 vs cookie是儲存在用戶端的檔案
session通常存放在server端,用戶端只有自己的session ID（有保密性的一串數字）
第一次拜訪使用者還未拿到session ID第二次訪問端才會給使用者*/
if (!isset($_SESSION)) {
    session_start(); //預設session是關閉的所以要用seesion時一定要啟用session_start()
}

if (!isset($_SESSION['n'])) {
    $_SESSION['n'] = 0;
}

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
    <?= $_SESSION['n']++; ?>
</body>

</html>