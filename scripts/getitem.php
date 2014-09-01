<?php
    require '../setup.php';
    $itemid = $_POST['itemid'];

    $item = ORM::for_table('item')->where('id', $itemid)->find_one();
    $anitem = array("folderid"=>$item->folder_id,
                    "name"=>$item->name,
                    "username"=>$item->username,
                    "pass"=>$item->password,
                    "passrepeat"=>$item->password_repeat,
                    "url"=>$item->url,
                    "desc"=>$item->notes);
    echo json_encode($anitem);
?>
