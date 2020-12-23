<?php
//負責儲存新增資料
require __DIR__ . '/db_connect.php';

$upload_folder = __DIR__ . '/uploads';

$output = [
    'files' => [],
];

$ext_map = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];


// photos[] 上傳多個檔案key值要是array[]


if (!empty($_FILES) and  is_array($_FILES['photos']['name'])) {
    foreach ($_FILES['photos']['name'] as $i => $name) {
        if ($ext_map[$_FILES['photos']['type'][$i]]) {
            $filename = uniqid() . $ext_map[$_FILES['photos']['type'][$i]];

            if (move_uploaded_file(
                $_FILES['photos']['tmp_name'][$i],
                $upload_folder . '/' . $filename
            )) {
                $output['files'][] = $filename;
            }
        }
    }
}


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
