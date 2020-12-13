<!-- cookie資料存放在http headers(表頭)
所以設定要記得放在最前面 -->
<?php

if (isset($_COOKIE["mycookie"])) {
    $myc = $_COOKIE["mycookie"] + 1;
} else {
    $myc = 1;
}

setcookie("mycookie", $myc);
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
    <?= $myc ?>
</body>

</html>