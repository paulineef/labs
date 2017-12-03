<?php
    @ $db = new mysqli('localhost', 'root', 'root', 'reads');

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to homepage </a>");
        exit();
    }

    if (isset($_POST['username'], $_POST['password'])) {
    	 
        $uname = mysqli_real_escape_string($db, $_POST['username']); 
    	$upass = mysqli_real_escape_string($db, $_POST['password']);
        
        $upass = SHA1($_POST['password']);
    	
        $query = ("SELECT * FROM users WHERE username = '{$uname}' "." AND password = '{$upass}'");

        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result(); 
        
        $totalcount = $stmt->num_rows();  
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="labs.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,900|Slabo+27px" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="content">
            <div class="half">
                <img src="img/logo.svg" style="width: 50px;">
                <h2>LOGIN</h2>
                    <?php
                    
                        if (isset($totalcount)) {
                            if ($totalcount == 0) {
                                echo '<h4 style="color: red;">You got it wrong. Try again.</h4>';
                            } else {
                                echo '<h4>Welcome! Correct password.</h4>';
                				echo "<a href='fileUpload.php' style='color: orange;''> Click here to upload your favourite pictures. </a>";
                            }
                        }

                    ?>
                <form method="POST" action="">
                    <input type="text" name="username" placeholder="username">
                    <input type="password" name="password" placeholder="password">
                    <input type="submit" value="Login" class="submit">
                </form>
            </div>
        </div>
    </body>
</html>
