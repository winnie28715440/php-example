<!doctype html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        td {
            width: 30px;
            height: 20px;
        }
    </style>
</head>

<body>
    <!-- < ?php echo 省略成< ?= -->
    <table border="1">
        <?php for ($i = 1; $i < 10; $i++) : ?>
            <tr>
                <?php for ($k = 1; $k < 10; $k++) : ?>
                    <td><?= sprintf("%s X %s=%s", $i, $k, $i * $k); ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

    <!-- printf是直接輸出，％s（％：提示,s:string）挖洞填變數 -->
    <!-- sprintf是回傳字串，％s（％：提示,s:string）
    %d(整數)挖洞填變數 -->
    <?php
    $a = 10;
    $b = 7;

    printf("---%s---%s-------<br>", $a, $b);
    printf("---%d---%d-------<br>", $b, $a);
    ?>

    <!-- 16進位色塊漸層 -->
    <!-- 16進位色塊漸層 -->
    <!-- sprintf是回傳字串，％x（％：提示,x:16進位）挖洞填變數 -->
    <table>
        <?php for ($i = 1; $i < 16; $i++) : ?>
            <tr>
                <td style="background-color: #<?= sprintf("%x", $i) ?>00;"></td>
            </tr>
        <?php endfor; ?>
    </table>
</body>

</html>