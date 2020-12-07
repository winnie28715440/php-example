<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>array</title>
</head>

<body>
    <div>
        <!-- <pre>會在html保持空格 -->
        <pre>
        <?php
        // 索引式陣列
        $ar1 = array(2, 4, 6, 8);
        $ar2 = [2, 4, 6, 8];
        // 關聯式陣列(類似js物件有key=>value)
        $ar3 = array(
            'name' => 'David',
            'age' => 25,
            100,
        );
        $ar4 = [
            'name' => 'David',
            'age' => 25,
        ];

        $ar5 = [
            'name' => 'winnie',
            'age' => 16,
        ];

        print_r($ar1);
        var_dump($ar2);

        print_r($ar3);
        var_dump($ar4);

        print_r($ar5);
        var_dump($ar5);

        ?>
        </pre>
    </div>

</body>

</html>