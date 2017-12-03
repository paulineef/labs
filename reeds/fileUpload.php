<html>
    <head>
        <title>Security - Upload</title>
        <link rel="stylesheet" type="text/css" href="labs.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,900|Slabo+27px" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
      <body>
        <img class="topimg" src="img/upload.png"/>
            <div class="content">
              <div class="half">
                <img src="img/logo.svg" style="width: 50px;">
                <h2> UPLOAD FILES </h2>
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
          move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
      }
}

if (isset($error)){
  if (empty($error)){
    echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '" style="color: red;" >Check file<br/><br/>';     
  } else {
    foreach ($error as $err){
      echo $err;
    }
  }
}
?>
             <a href="gallery.php" style="color: orange; ">Back to gallery</a>                
         </div>
       </div>
      </div>
   </body>
</html>