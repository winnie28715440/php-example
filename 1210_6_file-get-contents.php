<?php
//Get and output the source of the homepage of a website
//只會有html檔或文字檔
$homepage = file_get_contents('http://www.pchome.com.tw/');
echo $homepage;
