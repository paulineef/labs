<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Behind the book</title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php include("config.php"); ?>
	</head>
	<header>  
		<img id="headerImg" src="images/header_books.jpg">
		<h6> Admin?</h6>
		<br> 
		<a id="adminA" href="Back_end/admin.php">Login here</a>
		<style>
			h6 {
				position: absolute;
				top: 0px;
				right: 150px;
				font-size: 12pt;
				font-family: "roboto";
				color: #fff;
			}
			#adminA {
				position: absolute;
				top: 28px;
				right: 40px;
				background-color: #e6975e;
				text-decoration: none;
				color: #fff;
				padding: 5px;
				font-family: "roboto";
				margin: 5px;
			}
			#adminA:hover {
				background-color:  #925f4e;
			}
		</style>
		<h1>
			BEHIND THE BOOK
		</h1>
		<nav id="topnav">
			<ul>
				<li id="home">
					<!-- to find out if the current page is active or NULL (not active) we compare the current page (index.php) with the database information about the currentpage from the config page -->
					<a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php">Home</a> 
				</li>
				<li>
					<a class="<?php echo ($current_page == 'about_us.php' || $current_page == '') ? 'active' : NULL ?>" href="about_us.php">About Us</a>
				</li>
				<li>
					<a class="<?php echo ($current_page == 'listBooks.php' || $current_page == '') ? 'active' : NULL ?>" href="listBooks.php">Browse Books</a>
				</li>
				<li>
					<a class="<?php echo ($current_page == 'reservedBooks.php' || $current_page == '') ? 'active' : NULL ?>" href="reservedBooks.php">My Books</a>
				</li>
				<li>
					<a class="<?php echo ($current_page == 'gallery.php' || $current_page == '') ? 'active' : NULL ?>" href="gallery.php">Gallery</a>
				</li>
				<li>
					<a class="<?php echo ($current_page == 'contact_us.php' || $current_page == '') ? 'active' : NULL ?>" href="contact_us.php">Contact Us</a>
				</li>
			</ul>
		</nav>
	</header>