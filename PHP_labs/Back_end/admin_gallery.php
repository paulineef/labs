<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("admin.php");
}
?>
<?php include("admin_header.php"); ?>
<!doctype html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Behind the book</title>
		<link rel="stylesheet" type="text/css" href="main_admin.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>	
	<body>
		<div id="columnContainer">
			<div id="leftColumn">
				<h2>
					PICTURE GALLERY
				</h2>
				<ul id="imgList">
					<?php
					/*Added a loop that iterates through the img folder, and adds each element into the img list*/
					$dir = new DirectoryIterator("../uploadedFiles");
					foreach ($dir as $img) {
						if (!$img->isDot()) {//checks if a entry is a "." or ".." and will in that case not include it.
						  echo "<li><img src=\"../uploadedFiles/" . $img->getFilename() . "\"></li>";
						}
					}
					?>
  				</ul>
  				<style>
					#imgList {
						padding-bottom: 100px;
					}
					#imgList li {
						max-width: 50%;
						list-style: none;
					}
					#imgList img {
						max-width: 100%;
					}
				</style>
			</div>
			<aside id="rightColumn">
				<h2> UPLOAD IMAGES</h2>
				<?php include("admin_fileUpload.php") ?>
			</aside>	
		</div>		
		<?php include("../footer.php"); ?>
	</body>
</html>