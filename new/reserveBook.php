
<?php
include ("config.php");


$bookID = trim($_GET['bookID']); //remove blank spaces
echo '<INPUT type="hidden" name="bookID" value=' . $bookID . '>';

$bookID = trim($_GET['bookID']);      // From the hidden field
$bookID = addslashes($bookID);

//open the database 
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

	//if it could not connect to the database
    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo "You are reserving book with the ID: "           .$bookID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE books SET reserved=1 WHERE bookID = ?"); //change the chosen book to reserved in both db and the page
    $stmt->bind_param('i', $bookID);
    $stmt->execute();
    printf("<br><br>Book Reserved!");

    printf("<br><br><a href=browse.php.php>Search and Book more Books </a>");
    printf("<br><a href=mybooks.php>Return to Reserved Books </a>");
    printf("<br><a href=index.php>Return to the home page </a>");
    exit;
?>
    

