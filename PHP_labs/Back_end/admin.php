<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:addbook.php");
}
?>
<?php include("../config.php"); ?>

<?php if(isset($_POST) && !empty($_POST)) : ?>

<?php 
	$myusername =  stripslashes($_POST['myusername']);
	$mypassword =  stripslashes($_POST['mypassword']);
	
	@ $db = new mysqli($dbserverA, $dbuserA, $dbpassA, $dbnameA);

	if ($db->connect_error) {
		echo "could not connect: " . $db->connect_error;
		exit();
	}

	$stmt = $db->prepare("SELECT username, password FROM Bibblorskor WHERE username = ?");
	$stmt->bind_param('s', $myusername);
	$stmt->execute();
	
    $stmt->bind_result($username, $password);

    while ($stmt->fetch()) {
        if (sha1($mypassword) == $password)
		{
			$_SESSION['username'] = $myusername;
			header("location:addbook.php");
			exit();
		}
    }
?>

<?php endif;?>

<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="main_admin.css">
</head>
<body>
<h2> LOGIN</h2>
<div class="container">
       <form method="POST" action="addbook.php">
            <input type="text" name="myusername">
            <input type="password" name="mypassword">
            <input type="submit" value="Go">
        </form>
</div>
<style>
	.container {
		margin-left: 100px;
	}
</style>