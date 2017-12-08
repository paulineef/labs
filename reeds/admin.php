<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "<a href='welcome.php'> Click to get to the admin page</a>";
}
?>
<?php include("config.php"); ?>

<?php if(isset($_POST) && !empty($_POST)) : ?>

<?php 
	$myusername =  stripslashes($_POST['myusername']);
	$mypassword =  stripslashes($_POST['mypassword']);
	
	@ $db = new mysqli(localhost, root, root, reads);

	if ($db->connect_error) {
		echo "could not connect: " . $db->connect_error;
		exit();
	}

	$stmt = $db->prepare("SELECT username, password FROM admin WHERE username = ?");
	$stmt->bind_param('s', $myusername);
	$stmt->execute();
	
    $stmt->bind_result($username, $password);

    while ($stmt->fetch()) {
        if (sha1($mypassword) == $password)
		{
			$_SESSION['username'] = $myusername;
				echo "<a href='welcome.php'> Click to get to the admin page</a>";
			exit();
		}else {
			echo "wrong";
		}
    }
?>

<?php endif;?>
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
       <form method="POST" action="admin/welcome.php">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login" class="submit">
        </form>
    <a href="index.php"><- Back</a>
    </div>
</div>
</body>