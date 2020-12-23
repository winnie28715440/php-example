<?php

require __DIR__ . '/db_connect.php';
$pageName = 'login';
$title = "登入";

//帳號寫死固定寫法
// if (isset($_POST['account']) and isset($_POST['password'])) {
//     if ($_POST['account'] === 'winnie' and $_POST['password'] === '111') {
//         //可以登入
//         $_SESSION['admin']='winnie';
//     } else {    
//         $errorMsg = "帳號或密碼錯誤";
//     }
// }

if(isset($_POST['account']) and isset($_POST['password']) ){
$sql = "SELECT * FROM admin WHERE account=? AND password=SHA1(?) ";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['account'],
    $_POST['password'],
]);

$row = $stmt->fetch();
if(empty($row)){
    $errorMsg = "帳號或密碼錯誤";
}else{
    $_SESSION['admin'] = $row;
 }
}
?>

<?php include '/Applications/XAMPP/xamppfiles/htdocs/php-mfee11/parts/html-head.php'; ?>
<?php include 'parts/navbar.php'; ?>



<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">

        <?php if(isset($errorMsg)): ?>
            <div class= "alert alert-warning" role="alert">
               <?= $errorMsg ?>
            </div>
         <? endif?>

        <?php if(isset($_SESSION['admin'])): ?>
        <div>
            <h3>Hello <?= $_SESSION['admin']['account'] ?></h3>
            <p><a href="logout.php">登出</a></p>
        </div>
        <?php else : ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">登入</h5>

                    <form method="post">
                        <div class="form-group">
                            <label for="account">Account</label>
                            <!-- label是提示的名稱，for是id連動下面的input -->
                            <input type="text" class="form-control" id="account" name="account" value="<?= htmlentities($_POST['account'] ?? '') ?>">
                            <!-- htmlentities:把符號實體化ex:>"<會出現 -->
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= htmlentities($_POST['password'] ?? '') ?>">
                        </div>
                        <!-- <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" value="1" id="exampleCheck1" name="exampleCheck1" <?php// isset($_POST['exampleCheck1']) ? 'checked' : '' ?>>
                             checked是html原有的屬性：checkbox格子裡面checked會預設打勾 
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
        <?php endif ?>
    </div>



</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<?php include __DIR__ . '/parts/html-footer.php'; ?>