<?php
  header("Access-Control-Allow-Origin: *");
  header('Cache-Control: no-cache, must-revalidate');
  require '../setup.php';

    $newitem = ORM::for_table('item')->create();

    $newitem->name = $_REQUEST['title'];
    $newitem->username = $_REQUEST['username'];
    $newitem->password = $_REQUEST['password'];
    $newitem->password_repeat = $_REQUEST['passrepeat'];
    $newitem->url = $_REQUEST['url'];
    $newitem->notes = $_REQUEST['description'];
    $newitem->weight = 0;
    $newitem->folder_id = $_REQUEST['folderId'];
    $newitem->user_id = 1;
    $newitem->icon_id = 1;

    $newitem->save();
?>
