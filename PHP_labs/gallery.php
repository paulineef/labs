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
					PICTURE GALLERY
				</h2>
				<ul id="imgList">
					<?php
					/*Added a loop that iterates through the img folder, and adds each element into the img list*/
					$dir = new DirectoryIterator("uploadedFiles");
					foreach ($dir as $img) {
						if (!$img->isDot()) {//checks if a entry is a "." or ".." and will in that case not include it.
						  echo "<li><img src=\"uploadedFiles/" . $img->getFilename() . "\"></li>";
						}
					}
					?>
  				</ul>
  				<style>
					#imgList li {
						max-width: 50%;
						list-style: none;
					}
					#imgList img {
						max-width: 100%;
					}
					#fileUpload {
						text-decoration: none;
						background-color: #e6975e;
						margin-left: 80px;
						padding: 5px;
						font-family: "roboto";
						color: #fff;
					}
					#fileUpload:hover {
						background-color: #925f4e;
					}
				</style>
			</div>
			<aside id="rightColumn">
					<h2>
						UPLOAD IMAGES
					</h2>
				<a id="fileUpload" href="SQLInjection.php"> Click here</a>	
			</aside>	
		</div>		
		<?php include("footer.php"); ?>
	</body>
</html>