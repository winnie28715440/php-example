<div>

    <?php
    //date詳細可去php.net查date
    //date_default_timezone_set('UTC');英國格林威治時間
    //php預設時區為德國柏林
    date_default_timezone_set('Asia/Taipei');
    echo date("Y-m-d H:i:s", time()); //現在的年月日 時分秒
    echo '<br>';
    echo time(); //timestamp
    echo '<br>';
    echo date("Y-m-d H:i:s", time() - 30 * 24 * 60 * 60);
    //計算30天前的時間：30天24時60分60秒


    ?>
</div>