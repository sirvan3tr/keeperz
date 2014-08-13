<?php
  header("Access-Control-Allow-Origin: *");
  header('Cache-Control: no-cache, must-revalidate');
  $title = $_REQUEST['title'];
  $userid = $_REQUEST['user_id'];
  require '../setup.php';

  	$newdb = ORM::for_table('client')->create();

	$newdb->name = $title;
	$newdb->weight = 0;
	$newdb->pub_date = date(DATE_RFC2822);
  $newdb->user_id = $userid;
	$newdb->icon_id = 1;

	$newdb->save();

  echo $title;
?>