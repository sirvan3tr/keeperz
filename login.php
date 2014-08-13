<?php

require 'setup.php';

// Create a new Google API client
$client = new apiClient();
//$client->setApplicationName("Tutorialzine");

// Configure it
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setDeveloperKey($api_key);
$client->setRedirectUri($redirect_url);
$client->setApprovalPrompt(false);
$oauth2 = new apiOauth2Service($client);


// The code parameter signifies that this is
// a redirect from google, bearing a temporary code
if (isset($_GET['code'])) {
	
	// This method will obtain the actuall access token from Google,
	// so we can request user info
	$client->authenticate();
	
	// Get the user data
	$info = $oauth2->userinfo->get();
	
	// Find this person in the database
	$person = ORM::for_table('user')->where('email', $info['email'])->find_one();
	
	if(!$person){
		// No such person was found. Register!
		
		$person = ORM::for_table('user')->create();
		
		// Set the properties that are to be inserted in the db
		$person->email = $info['email'];
		$person->name = $info['name'];
		
		
		if(isset($info['picture'])){
			// If the user has set a public google account photo
			$person->photo = $info['picture'];
		}
		else{
			// otherwise use the default
			$person->photo = 'assets/img/default_avatar.jpg';
		}
		
		// insert the record to the database
		$person->save();
	}
	
	// Save the user id to the session
	$_SESSION['id'] = $person->id();
	
	// Redirect to the base demo URL
	header("Location: $redirect_url");
	exit;
}

// Handle logout
if (isset($_GET['logout'])) {
	unset($_SESSION['id']);
}

$person = null;
if(isset($_SESSION['id'])){
	// Fetch the person from the database
	$person = ORM::for_table('user')->find_one($_SESSION['id']);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Google Powered Login Form | Tutorialzine Demo</title>
        
        <!-- The stylesheets -->
        <link rel="stylesheet" href="assets/css/styles.css" />
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <style type="text/css">
body {
	color: #000!important;
}
	a.googleLoginButton {
		background: url("../img/google_login_btn.png") no-repeat !important;
		width:313px;
		height: 45px;
	}
    </style>
    <body>


<div class="login-container">
	<div id="login-body">
		<img src="../img/paradise_matrix.jpg"><br />
		<a href="index.php" />Go back to home...</a>
		<?php if($person):?>
			<div id="avatar" style="background-image:url(<?php echo $person->photo?>?sz=58)"></div>
			<p class="greeting">Welcome, <b><?php echo htmlspecialchars($person->name)?></b></p>
	    	<p class="register_info">You registered <b><?php echo new RelativeTime($person->registered)?></b></p>
	    	<a href="?logout" class="logoutButton">Logout</a>
		<?php else:?>
	    	<a href="<?php echo $client->createAuthUrl()?>" class="googleLoginButton">Sign in with Google</a>
	    <?php endif;?>

	</div>
</div>
		
        
    </body>
</html>