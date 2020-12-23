<?php


$ar = ['歡', '迎', '使', '用', '教', '學', '網', '路', '驗', '證'];

shuffle($ar);
echo implode('', $ar);
echo '<br>';

$str = "統一獅隊陳鏞基昨晚對富邦悍將隊完成生涯百盜";

function str_shuffle_unicode($str)
{
    $tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    //preg_split()分隔字串
    //"//u"是跳脫unicode編碼代表中文字
    shuffle($tmp);
    return join("", $tmp);
}

echo str_shuffle_unicode($str);
