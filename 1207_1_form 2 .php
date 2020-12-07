<?php
echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
//encode編碼轉換
//JSON_UNESCAPED_UNICODE 不要跳脫編碼字元（顯示中文）