<?php
    require '../setup.php';
    $itemid = $_POST['itemid'];
    $item = ORM::for_table('item')->where('id', $itemid)->find_one()->delete();
?>
