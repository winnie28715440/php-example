<?php

require __DIR__ . '/db_connect.php';
$pageName = 'ab-list';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//看第幾頁是用戶決定，所以用$_GET參數

$perPage = 10;
$t_sql = "SELECT COUNT(1) FROM address_book";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
//fetch(PDO::FETCH_NUM)[0]也可以寫成fetch()['COUNT(1)']
//PDO::FETCH_NUM 索引式陣列
// echo $totalRows;
// exit;
$totalPages = ceil($totalRows / $perPage);
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;
//ceil()會取最大值


$p_sql = sprintf(
    "SELECT * FROM address_book 
    ORDER BY sid DESC LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
);


// ex:SELECT * FROM address_book LIMIT 3(索引值＝第四筆),6（包含第四筆的下面六項）
//如是LIMIT 3 會抓前三筆資料
//$statememt = $pdo->query("SELECT* FROM address_book ORDER BY sid DESC "); //PDO::query($statememt=>SQL的語法)
$statememt = $pdo->query($p_sql);
$row = $statememt->fetchAll(PDO::FETCH_ASSOC);

//PDO::FETCH_ASSOC可不填
//如db_connect.php沒有設PDO::FETCH_ASSOC（關聯式陣列）預設是PDO::FETCH_BOTH(索引＋關聯式陣列)
/*
Array
(
    [sid] => 1
    [0] => 1
    [name] => 陳小明
    [1] => 陳小明
    [email] => uiouio@gmail.com
    [2] => uiouio@gmail.com
    [mobile] => 0988999777
    [3] => 0988999777
    [birthday] => 1994-06-30
    [4] => 1994-06-30
    [address] => 台北市
    [5] => 台北市
    [created_at] => 2020-12-08 10:24:34
    [6] => 2020-12-08 10:24:34
)*/
//print_r($row);
//echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>

<? include __DIR__.'/parts/html-head.php'; ?>
<? include __DIR__.'/parts/navbar.php'; ?>

<style>
    .remove-icon a i {
        color: palevioletred;
    }
</style>


<div class="container">

    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </a></li>

                    <li class="page-item  <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="far fa-arrow-alt-circle-left"></i>
                        </a></li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>">
                                    <?= $i ?>
                                </a></li>
                    <?php endif;
                    endfor ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="far fa-arrow-alt-circle-right"></i>
                        </a></li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th scope="col">sid</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>

                    </tr>
                </thead>
                <tbody>

                    <?php while ($r = $statememt->fetch()) : ?>
                        <tr>

                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['address'] ?></td>

                        </tr>
                    <?php endwhile ?>

                    <?php foreach ($row as $r) : ?>
                        <tr>

                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td>
                                <!--防範XSS(cross site scripts attack)
                                讓輸入的文字跳脫語法
                              <?= strip_tags($r['address']) ?>
                                 -->
                                <?= htmlentities($r['address']) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    // function removeItem(event) {
    //     const t = event.target;
    //     t.closest('tr').remove();
    // }
    //target是找到<i class="fas fa-minus-circle"></i>
    //current target是按任何地方都會觸發onclick在的地方
    // <td class="remove-icon"><a href="javascript:" onclick="removeItem(event)">
    // <i class="fas fa-minus-circle"></i>
    //</a></td>

    //confirm()會跳出警告視窗
    //「第一個用法」如按取消資料就不刪掉
    function del_it(event, sid) {
        if (!confirm(`是否要刪除編號 ${sid} 的資料`)) {
            event.preventDefault(); // 避免預設的行為
        }
    }


    // 「第二個用法」如按確定資料就刪掉
    // function del_it(sid){
    //     if(confirm(`是否要刪除編號為 ${sid} 的資料?`)){
    //         location.href = 'ab-delete.php?sid=' + sid;
    //     }
    // }
</script>
<?php include __DIR__ . '/parts/html-footer.php'; ?>

<!-- foreach as
foreach ($ar1 as $k => $v) {
echo "$k : $v<br>";
} -->