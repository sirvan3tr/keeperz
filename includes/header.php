<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $ptitle; ?></title>
	<link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">keeperz</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Logs</a></li>
      </ul>
      <button type="button" class="btn btn-default navbar-btn pull-right">Sign in</button>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
<?php
require './setup.php';

$person = null;
if(isset($_SESSION['id'])){
	// Fetch the person from the database
	$person = ORM::for_table('user')->find_one($_SESSION['id']);
}
/*
echo $person->id;

foreach(ORM::for_table('user')->find_result_set() as $record) {
    echo $record->name;
}*/
?>
