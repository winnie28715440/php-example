<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    //php函式不區分大小寫，原則上還是要小寫
    //呼叫的時候要用localhost開
    // phpinfo();

    //php系統內建的常數
    //字串相加要用‘.'

    //系統版本
    echo PHP_VERSION . '<br>';
    //資料夾位址
    echo __DIR__ . '<br>';
    //檔案位址
    echo __FILE__ . '<br>';
    //第幾個line
    echo __LINE__ . '<br> ';
    ?>

</body>

</html>