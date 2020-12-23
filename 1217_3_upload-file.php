<?php

$output = [];

$upload_folder = __DIR__ . '/uploads';

$ext_map = [
    //MIME type => 副檔名
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

//亂碼取得唯一ID
// https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
//另一種方式：uniqid()
//php.net/manual/zh/function.uniqid
function gen_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}


/* json格式的資料：
  {"file":{
      "avatar":{
          "name":"879879yuiyu897987iyui.jpg",
          "type":image/jpeg,->contnet-Type
          "tmp_name":"c:\\xampp\\tmp\\phpe896.tmp",->檔案上傳時的暫存區
          "error":0,
          "size":53810
      }
  }
}*/

//php處理檔案上傳內建的變數$_FILES
if (!empty($_FILES) and $ext_map[$_FILES['avatar']['type']]) {
    $output['file'] = $_FILES;

    $filename = gen_uuid() . $ext_map[$_FILES['avatar']['type']];
    $output['filename'] = $filename;
    move_uploaded_file(
        $_FILES['avatar']['tmp_name'],
        $upload_folder . '/' . $filename
    );
}
//php funtion:move_uploaded_file()將上傳的檔案移動到新位置
//move_uploaded_file ($filename(暫存區的路徑檔名) , $destination ) : bool

header('Content-Type: application/json');
//Json的MIME type:application/json
echo json_encode($output, JSON_UNESCAPED_UNICODE);
