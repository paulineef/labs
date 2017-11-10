<!DOCTYPE html>
<html>
<head>
	<title>Reads</title>
	<link rel="stylesheet" type="text/css" href="labs.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,900|Slabo+27px" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="utf-8">
	<script src="https://use.fontawesome.com/6f2a9fca0c.js"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<?php include ('config.php'); ?>
		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
				$( ".cross" ).hide();

				$( ".hamburger" ).click(function() {
				$( ".menu" ).slideToggle( "normal", function() {
				$( ".hamburger" ).hide();
				$( ".cross" ).show();
					});
				});

				$( ".cross" ).click(function() {
				$( ".menu" ).slideToggle( "normal", function() {
				$( ".cross" ).hide();
				$( ".hamburger" ).show();
					});
				});

			});
		</script>
</head>
<body>
	<header>
		<nav>
			<ul class="hmenu">
				<img src="img/logo.svg">
				<button class="hamburger">&#9776;</button>
 				<button class="cross">&#735;</button>
 			</ul>
			<ul class="menu">
				<li><a href="index.php"><img src="img/logo.svg"></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a href="browseBooks.php">Browse Books</a></li>
				<li><a href="myBooks.php">My Books</a></li>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</header>
</body>