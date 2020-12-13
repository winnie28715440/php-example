<?php
//session是共享的資料可以純讀取其他頁面的session資訊
session_start(); //要用seesion的時候一定要啟用session_start()

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
    <?= $_SESSION['n']; ?>
</body>

</html>