<?php
  require './setup.php';
  // Authenticate the user.
  $person = null;
  if(isset($_SESSION['id'])){
    $person = ORM::for_table('user')->find_one($_SESSION['id']);
  } else {
    header("Location: ./login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $ptitle; ?></title>
	<link rel="stylesheet" type="text/css" href="static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
  <img style="width: 100%" src="static/img/banner.jpg" />
  <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">keeperz</a>
      </div>


      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Logs</a></li>
        </ul>
      </div>
  </nav>
</div>

<div class="container">
