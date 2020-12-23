<?php

require __DIR__. '/is_admin.php';
require __DIR__ . '/db_connect.php';

if(! isset($_GET['sid'])){
    header('Location: ab-list.php');
    exit;
}
$sid = intval($_GET['sid']);

$row = $pdo
    ->query("SELECT * FROM address_book WHERE sid=$sid ")
    ->fetch();//抓一筆資料出來

//如果資料是空值就跳回ab-list.php
if(empty($row)){
    header('Location: ab-list.php');
    exit;
}

?>

<? include __DIR__.'/parts/html-head.php'; ?>
<? include __DIR__.'/parts/navbar.php'; ?>

<style>
    form small.error-msg{
        color: red;
    }
</style>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">

         <div class="alert alert-danger" role="alert" id="info" style="display: none">
                錯誤
         </div>

        <?php if(isset($errorMsg)): ?>
            <div class= "alert alert-warning" role="alert">
               <?= $errorMsg ?>
            </div>
         <? endif?>

        
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>

                    <!-- form下novalidate的屬性表單type的驗證都會消失 -->
                    <form method="post" novalidate onsubmit="checkForm(); return false;" name="form1">
                    <!-- <form method="post" name="form1"> -->
                      <input type="hidden" name="sid" value="<?= $sid ?>">
                       <!-- type="hidden"隱藏的input不會在html顯示,但network看得到 -->
                        <div class="form-group">
                            <label for="account">** name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                            value="<?= htmlentities($row['name']) ?>">
                            <small class="form-text error-msg" style="display: none"></small>
                        </div>
                        <div class="form-group">
                            <label for="account">** email</label>
                            <input type="email" class="form-control" id="email" name="email" required 
                            value="<?= htmlentities($row['email']) ?>">
                            <small class="form-text error-msg" style="display: none"></small>
                        </div>
                        <div class="form-group">
                            <label for="account">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                            value="<?= htmlentities($row['mobile']) ?>"
                            pattern="09\d{2}-?\d{3}-?\d{3}">
                            <!-- 手機格式：09xx-xxx-xxx; ?是‘有沒有’的意思不加也沒關係
                                html標籤裡面的regular expression就不用像js要加\ \用pattern屬性即可 -->
                        </div>
                        <div class="form-group">
                            <label for="account">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                            value="<?= htmlentities($row['birthday']) ?>" >
                        </div>
                        <!-- 當type=number的時候只能填數值 -->
                        <div class="form-group">
                            <label for="account">address</label>
                            <textarea  class="form-control"name="address" id="address"
                             cols="50" rows="3"><?= htmlentities($row['address'])?></textarea>
                            <!-- textarea or select的combobox的值(value)
                            </textarea>要黏著前面不然格式容易跑掉qqq
                            是直接在標籤中間，其他大多是有value屬性可以設定 -->
                        </div>
                
                        <button type="button" class="btn btn-danger">danger</button>
                        <!-- button不要送出type要改button -->
                        <button type="submit" class="btn btn-primary">修改</button>
                        <input type="submit" class="btn btn-warning" value="~~">
                    </form>


                </div>
            </div>
        </div>
       
    </div>



</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    const info = document.querySelector('#info');

    // document.querySelector('#name').style.borderColor = 'red'
    const name = document.querySelector('#name');
    const email = document.querySelector('#email');
    const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
//email的要求格式（regular expression）
//用來判斷字串的格式
//js單一個字元表達ex：/\d{3}/（d=digital=0~9的數字）{3}:選符合的3個數字

    function checkForm(){
        info.style.display = 'none';
        let isPass = true;

        //有符合就不要顯示警告文字
        name.style.borderColor = '#CCCCCC';
        //name.closest('.form-group').querySelector('small').style.display = 'none';
        name.nextElementSibling.style.display = 'none';
        email.style.borderColor = '#CCCCCC';
        //email.closest('.form-group').querySelector('small').style.display = 'none';
        email.nextElementSibling.style.display = 'none';

        //closest()找最近的第一個祖先層元素
        //nextElementSibling下一個元素
        if(name.value.length < 2){
            isPass = false;
            name.style.borderColor = 'red';
            let small = name.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的名字";
            small.style.display = 'block';
    }
    /*
        //test()js測試信箱格式是否有符合如沒符合跳出警告
         if(! email_re.test(email.value)){
             isPass＝false;
            email.style.borderColor = 'red';
            let small = email.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的 email";
            small.style.display = 'block';
        }
    */
        if(isPass){
            const fd = new FormData(document.form1);
            //表單的第一個項目
            fetch('ab-edit-api.php', {
                method: 'POST',
                body: fd
            })

            .then(r=>r.json())
            .then(obj=>{
                console.log(obj);

            if(obj.success){
                    // 修改成功
                    info.classList.remove('alert-danger');
                    info.classList.add('alert-success');
                    info.innerHTML = '修改成功';
                } else {
                    info.classList.remove('alert-success');
                    info.classList.add('alert-danger');
                    info.innerHTML = obj.error || '修改失敗';
                }
                info.style.display = 'block';
            });


        }


}
</script>
<?php include __DIR__ . '/parts/html-footer.php'; ?>