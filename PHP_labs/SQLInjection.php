<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#this function is for older PHP versions that use Magic Quotes.
#
//    function escapestring($input) {
//    if (get_magic_quotes_gpc()) {
//    $input = stripslashes($input);
//    }
//
//    @ $db = new mysqli('localhost', 'root', '', 'testinguser');
//
//
//    return mysqli_real_escape_string($db, $input);
//
//    }

//connect to the relevant database
@ $db = new mysqli('localhost', 'root', '', 'Reeds');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

    #the mysqli_real_espace_string function helps us solve the SQL Injection
    #it adds forward-slashes in front of chars that we can't store in the username/pass
    #in order to excecute a SQL Injection you need to use a ' (apostrophe)
    #Basically we want to output something like \' in front, so it is ignored by code and processed as text

	//when the submit button is clicked by the user
if (isset($_POST['username'], $_POST['password'])) {
	
	//add htmlentities and string escaping to the search function for the title
	//$uname = htmlentities($_POST['username']); should only be used when there is an output too, in functions such as comments  
	//$upass = htmlentities($_POST['password']);
	 
	//creates slaches wherever a fjonk is written. You need the database connection before you connect to the username field.
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
	
    
    $upass = md5($_POST['password']);
	
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
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
    </head>
    <body>
       <h2> LOGIN</h2>
        <?php
        
        //if the totalcount is set 
        if (isset($totalcount)) {
			//if totalcount is zero, it means that the user doesn't exist in the database
            if ($totalcount == 0) {
                echo '<h2>You got it wrong. Can\'t break in here!</h2>';
            } else {
				//if totalcount is one (not zero), it means that the user does exist in the database
                echo '<h2>Welcome! Correct password.</h2>';
				echo "<a id='link' href='fileUpload.php'> Click here to upload your favourite pictures. </a>";
            }
        }
        ?>
        <form method="POST" action="">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="submit" value="Go">
        </form>

    </body>
    <style>
		#link {
			color: #000;
			font-family: "roboto";
			margin-left: 50px;
		}
	</style>
</html>
