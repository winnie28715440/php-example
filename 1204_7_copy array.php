<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shuffle</title>
</head>

<body>
    <pre>
    <?php

    $ar1 = [1, 3, 5, 7];
    $ar2 = $ar1; //深拷貝（js深拷貝： JSON.stringify(陣列名稱)）
    //$ar2=&$ar1 非拷貝是傳出＄ar1的位置，只有php才能這樣用
    $ar1[2] = 100;
    print_r($ar2); //[1,3,5,7]


    $ar1 = [1, 2, 3, 4];
    $ar2 = $ar1;
    $ar1[3] = 400;
    print_r($ar1);
    print_r($ar2);


    /*js淺拷貝：
    const a=[1,2,3]
    const b=[...a] 方法1
    b=a.slice() 方法2
    b=a.concat() 方法3*/
    ?>
   
    </pre>
</body>

</html>