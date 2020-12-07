<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shuffle</title>
</head>

<body>

    <!-- <pre>會在html保持空格 -->
    <!-- $ar[]=$i;陣列push的用法 -->
    <div>
        <pre>
        <?php
        $ar = [];
        for ($i = 1; $i <= 42; $i++) {
            $ar[] = $i;
        }
        // impolde為呈現陣列轉字串的函式，用','分開
        // echo implode(','<-glue, $ar<-array);
        //類似js的join
        //字串切成陣列用explode()
        echo implode(',', $ar);
        echo "<br>";

        shuffle($ar); //亂數排序
        echo implode(',', $ar)

        ?>
        </pre>
    </div>

</body>

</html>