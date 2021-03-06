<?php

require __DIR__ . '/db_connect.php';

if (!isset($_SESSION['admin'])) {
    include __DIR__ . '/ab-list-noadmin.php';
    exit;
}



$pageName = 'ab-list';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//看第幾頁是用戶決定，所以用$_GET參數
$search = isset($_GET['search']) ? ($_GET['search']) : '';
$params = [];

$where = ' WHERE 1 '; //預設where的開頭
if (!empty($search)) {
    $where .= sprintf(" AND `name` LIKE %s ", $pdo->quote('%' . $search . '%'));
    $params['search'] = $search;
}
//php的'.=' = js的'+='
//$pdo->quote會幫忙做內部單引號跳脫＆在外面包一對單引號

$perPage = 10;
$t_sql = "SELECT COUNT(1) FROM address_book $where ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
//fetch(PDO::FETCH_NUM)[0]也可以寫成fetch()['COUNT(1)']
//PDO::FETCH_NUM 索引式陣列
// echo $totalRows;
// exit;
$totalPages = ceil($totalRows / $perPage);
if ($page > $totalPages) $page = $totalPages;
if ($page < 1) $page = 1;
//ceil()會取最大值


$p_sql = sprintf(
    "SELECT * FROM address_book %s
    ORDER BY sid DESC LIMIT %s, %s",
    $where,
    ($page - 1) * $perPage,
    $perPage
);


//stars的資料
$f_sql = "SELECT * FROM `address_book` WHERE `stars`=1";
$stmt = $pdo->query($f_sql);
$rr = $stmt->fetch();

//html除錯的方法用完建議就刪掉
echo '<!-- ';
echo $p_sql;
echo ' -->';

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
                <ul class="pagination my-2 ">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = 1;
                                                    echo http_build_query($params); ?>">
                            <!-- 結果：?search=陳&page=1
                            http_build_query(陣列)會輸出query string，例：foo=bar但不包含'？'
                            所以'？'要自己打 -->
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </a></li>

                    <li class="page-item  <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $page - 1;
                                                    echo http_build_query($params); ?>">
                            <i class="far fa-arrow-alt-circle-left"></i>
                        </a></li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?<?php $params['page'] = $i;
                                                            echo http_build_query($params);  ?>">
                                    <?= $i ?>
                                </a></li>
                    <?php endif;
                    endfor ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $page + 1;
                                                    echo http_build_query($params); ?>">
                            <i class="far fa-arrow-alt-circle-right"></i>
                        </a></li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $params['page'] = $totalPages;
                                                    echo http_build_query($params); ?>">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </a></li>
                </ul>
            </nav>
        </div>
        <div class="col d-flex flex-row-reverse bd-highlight">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= htmlentities($search) ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>



    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fas fa-minus-circle"></i>
                        </th>
                        <th scope="col">sid</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>
                        <th scope="col">stars
                            <input type="checkbox" onclick="friend()">
                        </th>
                        <th scope="col">
                            <i class="fas fa-edit"></i>
                        </th>

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
                            <td><?= $r['stars'] ?></td>

                        </tr>
                    <?php endwhile ?>

                    <?php foreach ($row as $r) : ?>
                        <tr>
                            <td class="remove-icon">
                                <a href="ab-delete.php?sid=<?= $r['sid'] ?>" onclick="del_it(event,<?= $r['sid'] ?>)">


                                    <!-- 「第二個用法」<a href="javascript: del_it(<?= $r['sid'] ?>)"> -->
                                    <!-- onclick="return false"也可以讓刪除資料動作失效 -->
                                    <!-- 如a標籤跟onclick同時存在，onclick會先做a標籤再連結到目標網址 -->
                                    <!-- <td class="remove-icon"><a href="javascript:" onclick="removeItem(event)"> -->
                                    <i class="fas fa-minus-circle"></i>
                                </a></td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td>
                                <!--防範XSS(cross site scripts attack)
                                讓輸入的文字跳脫語法
                                //strip_tags()標籤都拿掉
                                //htmlentities()僅跳脫標籤但標籤會在html留著
                              <?= strip_tags($r['address']) ?>
                                 -->
                                <?= htmlentities($r['address']) ?>
                            </td>
                            <td><?= $r['stars'] ?></td>
                            <td>
                                <a href="ab-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
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
    //target是找到click裡面的element：<i class="fas fa-minus-circle"></i>
    //current target是按任何地方都會觸發onclick在的地方不一定是click的地方
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

    //stars的funtion...
    function friend() {

    }
</script>
<?php include __DIR__ . '/parts/html-footer.php'; ?>

<!-- foreach as
foreach ($ar1 as $k => $v) {
echo "$k : $v<br>";
} -->