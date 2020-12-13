<!-- cookie是共享的資料可以純讀取其他頁面的cookie資訊 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- 呼叫cookie時，要用＄_COOKIE -->
    <?= $_COOKIE['mycookie'] ?? '沒有 mycookie' ?>
</body>

</html>