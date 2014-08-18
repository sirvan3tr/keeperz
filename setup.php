<?php
// Includes

require_once 'includes/google-api-php-client/apiClient.php';
require_once 'includes/google-api-php-client/contrib/apiOauth2Service.php';
require_once 'includes/idiorm.php';
require_once 'includes/relativeTime.php';

// Session. Pass your own name if you wish.

session_name('keeperz_user_login');
session_start();

// Database configuration with the IDIORM library

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'keeperz';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);

// Changing the connection to unicode
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Google API. Obtain these settings from https://code.google.com/apis/console/

$redirect_url = 'http://localhost/keeperz/login.php'; // The url of your web site
$client_id = '660638127035-21hgr05m6v9orcs4diafgkrqtu7k509t.apps.googleusercontent.com';
$client_secret = 'fC599duexFcT4P4RVia1Di_A';
$api_key = 'AIzaSyAU4TdhxhmgxAg3OX3kHtpG6z5JAwRyrRY';
