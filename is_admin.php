<?php

//不要讓非管理者看的（新增修改資訊）就require這支php
if (!isset($_SESSION)) {
    session_start();
}


if (!isset($_SESSION['admin'])) {
    header('Location:login.php');
    exit;
}
