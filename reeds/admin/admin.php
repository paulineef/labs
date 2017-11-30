<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location:addbook.php");
}
?>
<?php include("../config.php"); ?>

<?php if(isset($_POST) && !empty($_POST)) : ?>

<?php 
	$myusername =  stripslashes($_POST['aUsername']);
	$mypassword =  stripslashes($_POST['aPassword']);
	
	@ $db = new mysqli('localhost', 'root', 'root', 'reads');

	if ($db->connect_error) {
		echo "could not connect: " . $db->connect_error;
		exit();
	}

	$stmt = $db->prepare("SELECT aname, apass FROM reeds WHERE username = ?");
	$stmt->bind_param('s', $aUsername);
	$stmt->execute();
	
    $stmt->bind_result($aname, $apass);

    while ($stmt->fetch()) {
        if (sha1($aPassword) == $apass)
		{
			$_SESSION['admin'] = $aUsername;
			header("location:addbook.php");
			exit();
		}
    }
?>

<?php endif;?>

<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="labs.css">
</head>
<body>
<div class="content">
	<div class="half">
	<h2> ADMIN LOGIN</h2>
       <form method="POST" action="addbook.php">
            <input type="text" name="aUsername">
            <input type="password" name="aPassword">
            <input type="submit" value="Login" class="submit">
        </form>
    </div>
</div>
</body>