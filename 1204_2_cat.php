<?php
$age = isset($_GET['age']) ? intval($_GET['age']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1204_2</title>
</head>

<body>

    <?php if ($age < 18) { ?>
        <img src="./img/kitten_vaccination_image.jpg" alt="">
    <?php } else { ?>
        <img src="./img/d8180947d9fe2dd83f44c8058177232c.jpg" alt="">

    <?php } ?>

    <!-- endif跟if同義{}取代成：   -->
    <?php if ($age < 18) : ?>
        <img src="./img/kitten_vaccination_image.jpg" alt="">
    <?php else : ?>
        <img src="./img/d8180947d9fe2dd83f44c8058177232c.jpg" alt="">

    <?php endif; ?>

</body>

</html>