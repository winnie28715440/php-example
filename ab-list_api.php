<?php

require __DIR__ . '/db_connect.php';
$pagename = 'ab_list';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$perPage = 3;
$t_sql = "SELECT COUNT(1) FROM address_book";
$totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
//PDO::FETCH_NUM 索引式陣列
$totalPages = ceil($totalRows / $perPage);
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;
//ceil()會取最大值
// echo $totalRows;
// exit;

$p_sql = sprintf(
    "SELECT * FROM address_book 
    ORDER BY sid DESC LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
);

// ex:SELECT * FROM address_book LIMIT 3(索引值＝第四筆),6（包含第四筆的下面六項）
//$statememt = $pdo->query("SELECT* FROM address_book ORDER BY sid DESC "); //PDO::query($statememt=>SQL的語法)
$statememt = $pdo->query($p_sql);
$rows = $statememt->fetchAll(PDO::FETCH_ASSOC);
$output = [
    'page' => $page,
    'perPage' => $perPage,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => $rows,
];

echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
