<?php include ('header.php'); ?>
<body>
	<img class="topimg" src="img/index.png"/>
	<div class="content">
		<div class="half">
			<h3>Gallery</h3>

			<a id="fileUpload" href="SQLInjection.php"> Login to upload Images</a>

			<ul class="imgList">

				<?php
					$dir = new DirectoryIterator("uploadedFiles");
					
					foreach ($dir as $img) {
						if (!$img->isDot()) { //checks if a entry is a "." or ".." and will in that case not include it.
						  echo "<li class='imglist'><img src=\"uploadedFiles/" . $img->getFilename() . "\"></li>";
						}
					}
				?>
  			</ul>
			
			

		</div>
	</div>
</body>

<?php include ('footer.php'); ?>