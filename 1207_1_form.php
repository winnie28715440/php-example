<!-- form表單送出要給name=不是id=不然資料給不出去 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>

<body>

    <?php
    print_r($_POST);
    ?>

    <!-- $_POST的話URL才看不到表單輸入的資料(輸入到http body)
$_GET資料會在URL看到（輸入到http headers
html的form要加method="post" -->
    <form name="form1" action="" method="post">

        <input type="text" name="account" id="account" placeholder="帳號">
        <br>
        <input type="password" name="password" id="password" placeholder="密碼">
        <button type="button" onclick="changetype()">顯示密碼</button>
        <!-- 注意：button如不寫type＝"button"會被視為submit送出資料 -->
        <br>
        <input type="submit" name="" id="">


    </form>



    <script>
        //顯示密碼
        const password = document.form1.password;
        //<input type="password" name="password" id="password" placeholder="密碼">
        function changetype() {
            const t = password.getAttribute('type');
            if (t === 'password') {
                password.setAttribute('type', 'text');
            } else {
                password.setAttribute('type', 'password');
            }

        }
    </script>
    <!--
document.getElementById('password').value
document.querySelector('form > input[type=password]').value
document.querySelectorAll('input')[1].value

document.form1.password.value
document.forms[0].elements
document.forms[0].elements[1].value

-->

</body>



</html>