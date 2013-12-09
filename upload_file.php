<?php

$file = $_FILES['file'];
$file_name = $file['name'];
$file_size = $file['size'] / 1024;
$file_type = strtolower(strrchr($file_name, "."));
$MAX_SIZE = 200;

$estate_id = $_POST['estate_id'];
$file_id = time();

$dst_path = "upload_files/" . $estate_id . '/';
$dst_file_name = $dst_path . $file_id . $file_type;

$type_allow = array(".jpeg", ".bmp", ".gif", ".jpg", ".png");
if (!in_array($file_type, $type_allow)) {
    echo json_encode(array(
        'code' => 403,
        'data' => array(
            'msg' => 'file type : ' . $file_type . ' not allow'
        )
    ));
    return;
}
if (!is_dir($dst_path)) {
    if (!mkdir($dst_path, 0777, true)) {
        echo json_encode(array(
            'code' => 500,
            'data' => array(
                'msg' => '创建文件失败'
            )
        ));
        return;
    }
}


if ($file_size < $MAX_SIZE) {
    if ($file["error"] > 0) {
        echo json_encode(array(
            'code' => 500,
            'data' => array(
                'msg' => $file["error"]
            )
        ));
    } else {
        $ret = move_uploaded_file($file["tmp_name"], $dst_file_name);
        if ($ret) {
            echo json_encode(array(
                'code' => 200,
                'data' => array(
                    'msg' => '上传成功',
                    'src'=>$dst_file_name,
                    'id'=>$file_id.$file_type
                )
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'data' => array(
                    'msg' => '上传失败'
                )
            ));
        }
    }
} else {
    echo json_encode(array(
        'code' => 500,
        'data' => array(
            'msg' => '文件大小不能超过' . $MAX_SIZE . 'KB'
        )
    ));
}
