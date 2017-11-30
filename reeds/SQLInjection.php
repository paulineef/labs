<?php

//connect to the relevant database
@ $db = new mysqli('localhost', 'root', 'root', 'reads');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to homepage </a>");
    exit();
}

//when the submit button is clicked by the user
if (isset($_POST['username'], $_POST['password'])) {
	
	//add htmlentities and string escaping to the search function for the title
	//$uname = htmlentities($_POST['username']); should only be used when there is an output too, in functions such as comments  
	//$upass = htmlentities($_POST['password']);
	 
    $uname = mysqli_real_escape_string($db, $_POST['username']); //is used with inputs, such as log in fields
	$upass = mysqli_real_escape_string($db, $_POST['password']);
	
    #without function, so here you can try to implement the SQL injection
    #various types to do it, either add ' -- to the end of a username, which will comment out
    #or simply use 
    #' OR '1'='1' #
    #$uname = $_POST['username'];
    
    #here we hash the password, and we want to have it hashed in the database as well
    #optimally when you create a user (through code) you simply send a hash
    #hasing can be done using different methods, MD5, SHA1 etc.
    
    $upass = SHA1($_POST['password']);
	
    #just to see what we are selecting, and we can use it to test in phpmyadmin/heidisql
    	
    //select the username that are the same as the inputted one
    $query = ("SELECT * FROM users WHERE username = '{$uname}' "." AND password = '{$upass}'");
       
    //prepare the query and store it when it is executed. 
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result(); 
    
    #here we create a new variable 'totalcount' just to check if there's at least
    #one user with the right combination. If there is, we later on print out "access granted"
	
	//if the totalcount is one, there is one user in the database that are the same as the input
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
                
                //if the totalcount is set 
                if (isset($totalcount)) {
        			//if totalcount is zero, it means that the user doesn't exist in the database
                    if ($totalcount == 0) {
                        echo '<h4 style="color: red;">You got it wrong. Try again.</h4>';
                    } else {
        				//if totalcount is one (not zero), it means that the user does exist in the database
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
