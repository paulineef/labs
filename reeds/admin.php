<?php include("config.php"); ?>

<?php
	session_start();

	if (isset($_SESSION['admin'])) {
	    header("location: welcome.php");
	}

	if(isset($_POST) && !empty($_POST));
		$myusername =  stripslashes($_POST['aUsername']);
		$mypassword =  stripslashes($_POST['aPassword']);
		
		@ $db = new mysqli('localhost', 'root', 'root', 'reads');

		if ($db->connect_error) {
			echo "could not connect: " . $db->connect_error;
			exit();
		}

		$stmt = $db->prepare("SELECT aname, apass FROM reeds WHERE username = ?");
		$stmt->bind_param($apass, $aUsername);
		$stmt->execute();
		
	    $stmt->bind_result($aname, $apass);

	    while ($stmt->fetch()) {
	        if (sha1($aPassword) == $apass){
				$_SESSION['admin'] = $aUsername;
				header("location:addbook.php");
				exit();
			}
	    }
?>

<html>
<head>
  	<title>Admin Login</title>
  	<link rel="stylesheet" type="text/css" href="labs.css">
  	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,900|Slabo+27px" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div class="content">
	<div class="half">
		<img src="img/logo.svg" style="width: 50px;">
	<h2> ADMIN LOGIN </h2>
       <form method="POST" action="addbook.php">
            <input type="text" name="aUsername" placeholder="Username">
            <input type="password" name="aPassword" placeholder="Password">
            <input type="submit" value="Login" class="submit">
        </form>
    <a href="index.php"><- Back</a>
    </div>
</div>
</body>