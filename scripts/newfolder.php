<?php
  header("Access-Control-Allow-Origin: *");
  header('Cache-Control: no-cache, must-revalidate');
  require '../setup.php';

    $newfolder = ORM::for_table('folder')->create();

    $newfolder->name = $_REQUEST['foldername'];
    $newfolder->user_id = $_REQUEST['userid'];
    $newfolder->client_id = $_REQUEST['clientid'];
    $newfolder->icon_id = 1;

    $newfolder->save();
?>
