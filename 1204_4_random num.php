<?php

for ($i = 0; $i < 10; $i++) {
    echo rand(100, 999) . '<br>';
}

echo '-----------<br>';

for ($i = 0; $i < 10; $i++) {
    printf("%'.07d<br>", rand(1, 10000));
}


/*
補0用法，ex: %'.09d(0=補0,9=9位數,d=數值)
<?php
echo sprintf("%'.9d\n", 123);
echo sprintf("%'.09d\n", 123);
?>
//......123
//000000123
*/
