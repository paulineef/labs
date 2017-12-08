<?php include('aHeader.php'); ?>
<body>
<img class="topimg" src="../img/admin.png"/>
	<div class="content">
		<div class="half">
			<h2>Upload an image</h2>
			<div>
                <form action="" method="POST" enctype="multipart/form-data" >
                    <input type="file" name="upload"/>
                    <input type="submit" value="Submit" class="submit" />
                </form>  
				<?php


				if (isset($_FILES['upload'])){
				    $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
				    $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
				    echo "Your file extension is: ".$extension. "<br/>";
				    $error = array ();

				      if(in_array($extension, $allowedextensions) === false){
				          $error[] = 'This is not an image, upload is allowed only for images.';        
				      }
				    
				      if($_FILES['upload']['size'] > 1000000){
				          $error[]='The file exceeded the upload limit';
				      }

				      if(empty($error)){
				          move_uploaded_file($_FILES['upload']['tmp_name'], "../uploadedfiles/{$_FILES['upload']['name']}");     
				      }
				}

				if (isset($error)){
				  if (empty($error)){
				    echo '<a href="../uploadedfiles/' . $_FILES['upload']['name'] . '" style="color: red;" >Check file<br/><br/>';     
				  } else {
				    foreach ($error as $err){
				      echo $err;
				    }
				  }
				}
				?>

				<ul class="imgList">

					<?php
						$dir = new DirectoryIterator("uploadedFiles");
						
						foreach ($dir as $img) {
							if (!$img->isDot()) { //checks if a entry is a "." or ".." and will in that case not include it.
							  echo "<li class='imglist'><img src='../uploadedFiles/" . $img->getFilename() . "'></li>";
							}
						}
					?>
  				</ul>

		</div>
	</div>
</body>

<?php include ('aFooter.php'); ?>