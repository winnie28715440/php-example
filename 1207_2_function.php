<?php

/*php變數不像js可以從全域變數抓取，
雖然常數可以從外面抓取，
建議盡量都在funtion裡面定義好*/

header('Content-Type:text/plain'); //plain=純文字
//如沒打預設會是header('Content-Type:text/html')
define('MY_CONST', 3);
$c = 100;

function multi($a, $b = 10)
{
    global $c; // 雖可以這樣抓取全域變數ｃ但不要這樣用
    //return $a*$b*$c;
    return $a * $b * MY_CONST;
}

echo multi(6, 7);
echo "\n";
echo multi(6);
