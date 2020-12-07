
<?php

//科學符號：5e2=5*10的2次方=500

/*自訂常數
是程式開發者所定義的常數，
可以使用 define() 函式定義
常數'名稱'通常使用'全部大寫的英文字'，
複合字時中間使用underscore(_)分開。
常數內容則可以是數值或字串
define("MY_CONST", "常數 - 值在設定後不可變更");*/

define('MY_CONST', 789);
//呼叫字串的時候直接打不用''
echo MY_CONST . '<br>';

/*變數
名稱開頭用＄，有說明的功能
可以用小駝峰式或底線
ex:myName or my_name
第一個字元不可以是數字*/

$myName = 'David';

//雙引號會帶入變數
echo "Hello $myName<br>";
//單引號不會帶入變數
echo 'Hello $myName<br>';

//123空格
echo "Hello $myName 123<br>";
//123不要空格有下面兩個方法
echo "Hello {$myName}123<br>";
echo "Hello ${myName}123<br>";

//跳脫字元 \n:換行，\跳脫字元
//單引號裡面跳脫字元只能跳脫單引號跟雙反斜線

$a = "xyz\nabc\"def\'ghi\\<br>";
//xyz abc"def\'ghi\
$b = 'xyz\nabc\"def\'ghi\\<br>';
//xyz\nabc\"def'ghi\
echo $a;
echo $b;


//直接輸出布林值要小心
//true輸出會是'1',false輸出會是空字串
//如要顯示要把布林值變字串：'true','false'

$name = 'Bill';
//isset函式判斷是否有設定（結果是布林值）
echo isset($name) ? true : false . '<br>';

//同義
/*
if(isset($name)){
    echo "$name <br>";
} else {
    echo "noname <br>";
}
*/
//類似isset用法但不要用卡好
/*
echo $name ?? 'noname';
*/


//PHP的邏輯運算子結果是布林值
$a = 7 || 5;
$b = 0 || 5;
echo "\$a=$a,\$b=$b<br>";
//$a=1,$b=1

//優先權來說‘＝’比or或是and優先所以不會進行邏輯比較
$c = 7 or 5;
$d = 0 or 5;
echo "\$c=$c,\$d=$d<br>";
//$a=7,$b=0

//var_dump判斷變數結果類型為何
var_dump($a);
echo "<br>";
//bool(true)

//如何把結果印出來？
var_dump($e = 7 and $g = 0);
echo "<br>";

//URL 變數(GET 參數)
$a = isset($_GET['a']) ? $_GET['a'] : '';
// $a = $_GET['a'] ?? '';
echo "$a <br>";

// ?a=hh&b=76%208789
//％20為url空格的意思
//intval：把它變為整數值（int整數value值）
$b = isset($_GET['b']) ? intval($_GET['b']) : 0;
echo $b;

?>

