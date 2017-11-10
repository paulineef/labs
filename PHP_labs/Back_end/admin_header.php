<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Behind the book</title>
		<link rel="stylesheet" type="text/css" href="main_admin.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php include("../config.php"); ?>
	</head>
	<header>  
		<img id="headerImg" src="../images/header_books.jpg">
		<h1>
			ADMIN
		</h1>
		<nav id="topnav">
			<ul>
				<li id="home">
					<!-- to find out if the current page is active or NULL (not active) we compare the current page (index.php) with the database information about the currentpage from the config page -->
					<a class="<?php echo ($current_page == 'addbook.php' || $current_page == '') ? 'active' : NULL ?>" href="addbook.php">Add book</a> 
				</li>
				<li>
					<a class="<?php echo ($current_page == 'library.php' || $current_page == '') ? 'active' : NULL ?>" href="library.php">Library</a>
				</li>
				<li>
					<a class="<?php echo ($current_page == 'admin_gallery.php' || $current_page == '') ? 'active' : NULL ?>" href="admin_gallery.php">Gallery</a>
				</li>
				<li>
					<a class="<?php echo ($current_page == 'logout.php' || $current_page == '') ? 'active' : NULL ?>" href="logout.php">Logout</a>
				</li>
			</ul>
		</nav>
	</header>
</html>