<!DOCTYPE html>
<!--Reads-->
<head>
	<link rel="stylesheet" type="text/css" href="reads.css">
	<link href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,700|Oswald:300,400,500,700" rel="stylesheet">
	<title>Reads - For all books</title>
</head>
<body>
	<div class="container">
		<nav>
			<img src="img/logo.svg"/>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="browseBooks.php">Browse Books</a></li>
				<li><a href="myBooks.php">My Books</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div>
	<header>
		<img src="img/hp5.jpg">
		<div class="ht"><h1>Contact</h1>
		<h4>Love to hear from you</h4></div>
	</header>
	<div class="content">
		<div class="a"></div>
		<form class="contact" method="post" action="contact.php">
        
		    <input name="name" placeholder="Name">
		            <br/>
		    <input name="email" type="email" placeholder="E-mail">
		            <br/>
		    <textarea name="message" placeholder="Message"></textarea>
		            <br/>
		    <input class="submit" name="submit" type="submit" value="Send">
		        
		</form>
		<div class="a"></div>
	</div>
	<footer><div>Copyright © Pauline Fagerberg 2017</div></footer>
</body>