<!doctype html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Behind the book</title>
		<link rel="stylesheet" type="text/css" href="CSS/main.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>	
	<body>
		<?php include("header.php"); ?>
		<div id="columnContainer">
			<div id="leftColumn">
				<h2>
					CONTACT US
				</h2>
				<p>
					If you have any questions don't hesitate to send a message through this form.
				</p>
				<form id="contact_form">
					Name: <br>
					<input type="text" name="name" id="contact_name" placeholder="Firstname Lastname">
					<br>
					Email: <br>
					<input type="text" name="email" id="contact_email" placeholder="name@name.se">
					<br>
					Message: <br>
					<input type="text" name="message" id="contact_message" size="50" style="height:50px;" placeholder="Write your message here." >
					<br>
					<input type="submit" name="send" id="send_button" value="SEND">
				</form>
				<style>
					#contact_form input {
						float: none;
					}
					#contact_form {
						font-family: "roboto";
						font-size: 12pt;
					}
					#send_button {
						font-family: "roboto";
						background-color: #e6975e;
						border-style: none;
						padding: 6px;
						font-size: 8pt;
						margin-left: 290px;
					}
					#send_button:hover {
						background-color: #925f4e;
					}
				</style>
			</div>
			<aside id="rightColumn">
				<div id="asideBox">
					<h3>
						Bestsellers
					</h3>
					<ul>
						<li>
							<a href="#">Title 1</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 2</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 3</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 4</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 5</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
					</ul>
				</div>
				<div id="asideBox2">
					<h3>
						New releases
					</h3>
					<ul>
						<li>
							<a href="#">Title 1</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 2</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 3</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 4</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 5</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
					</ul>
				</div>
			</aside>	
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>