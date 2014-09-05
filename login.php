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

<html>
    <head>
        <meta charset="utf-8" />
        <title>Keeperz Login</title>

        <!-- The stylesheets -->
        <link rel="stylesheet" href="assets/css/styles.css" />
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" />

        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <style type="text/css">
    body {
    	background-color: #000;
    }
	.login-header {
		position: absolute;
		top: 0;
		background: #000;
		border: 1px solid #A32860;
		font-family: courier new;
		color: #fff;
		padding: 0 30px;
		left: 40%;
	}
	.login-container {
		width: 350px;
		margin: 0 auto;
	}
	#login-body {
		position: absolute;
		top: 130px;
		background: #FFF;
		font-family: courier new;
		color: #333;
		padding: 20px;
		width: 372px;
		text-align: center;
		border-radius: 10px;
	}
	a.googleLoginButton {
		background: url("static/img/google_login_btn.png") no-repeat !important;
		width:313px;
		height: 45px;
		display: block;
		margin: 0 auto;
	}
	#canvasId {

	}
    </style>
    <body>

<canvas id="canvasId" style="border:1px solid black"></canvas>
<script type="text/javascript">
    var cW = window.innerWidth;
    var cH = window.innerHeight;
    window.onload = windowReady(40);
    /**
    windowReady
    */
    function windowReady(ascii_start) {
        // Load the context of the canvas
        var context = document.getElementById('canvasId').getContext("2d");
        var charArray = [];
        for (var i = 0; i < 130; i++) {
            var temp = [];
            var yspeed = Math.random() * 10;
            var xspacing = Math.random() * 15 + 15;
            var fontSize = Math.random() * 20 + 5;
            var charlengh = 10+Math.floor(Math.random()*20);
            for (var j = 0; j < charlengh; j++) {
                temp.push(new create_chars(i * 15 + xspacing, j * 20+20, yspeed, j, fontSize));
            }
            charArray.push(temp);
        }
        function create_chars(xloc, yloc, yspeed, j, fontSize) {
            this.x = xloc;
            this.y = -yloc;
            this.dy = yspeed;
            this.fontSize = fontSize;
            if (j == 0)
                this.color = "#606060";
            else
                this.color = "#333";
            this.text = String.fromCharCode(ascii_start + Math.floor(Math.random()*65));
        }
        function Draw() {
		  	context.canvas.width  = window.innerWidth;
		  	context.canvas.height = window.innerHeight;
            context.globalCompositeOperation = "source-over";
            context.fillStyle = "rgba(0,0,0,0.9)";
            context.fillRect(0, 0, cW, cH);
            context.globalCompositeOperation = "lighter";
            for (var k = 0; k < charArray.length; k++) {
                for (var m = 0; m < charArray[k].length; m++) {
                    var charObject = charArray[k][m];
                    context.fillStyle = charObject.color;
                    context.font = "bold "+charObject.fontSize+"px Arial";
                    context.fillText(charObject.text, charObject.x, charObject.y);
                    context.fill();
                    charObject.y += charObject.dy;
                    if (charObject.y > cH) { charObject.y = 0; }
                }
            }
        }
        setInterval(Draw, 20);

    }
</script>
<div class="login-container">
	<div id="login-body">
		<a href="index.php" />Go back to home...</a>
		<?php if($person):?>
			<div id="avatar" style="background-image:url(<?php echo $person->photo?>?sz=58)"></div>
			<p class="greeting">Welcome, <b><?php echo htmlspecialchars($person->name)?></b></p>
	    	<p class="register_info">You registered <b><?php echo new RelativeTime($person->registered)?></b></p>
	    	<a href="?logout" class="logoutButton">Logout</a>
		<?php else:?>
	    	<a href="<?php echo $client->createAuthUrl()?>" class="googleLoginButton"></a>
	    <?php endif;?>

	</div>
</div>


    </body>
</html>
