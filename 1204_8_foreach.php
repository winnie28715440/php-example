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

    $ar1 = [
        'name' => 'flora',
        'age' => 24,
        100,
    ];

    $ar1[9] = 99;
    $ar1[3] = 33;

    foreach ($ar1 as $k => $v) {
        echo "$k : $v<br>";
    }


    /*印出結果會依照先後順序，不會依照index順序填入
     name : flora
    age : 24
    0 : 100
    9 : 99
    3 : 33
*/


    ?>
   
    </pre>
</body>

</html>