<?php

session_start();

unset($_SESSION['admin']);
//清掉session
//更暴力的用法會所有東西清掉 session_destroy();

header('Location: login.php');

