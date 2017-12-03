<?php
    include ("config.php");


    $bookID = trim($_GET['bookID']);
    echo '<INPUT type="hidden" name="bookID" value=' . $bookID . '>';

    $bookID = trim($_GET['bookID']);
    $bookID = addslashes($bookID);

    @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo "You are reserving book with the ID: "           .$bookID;

    $stmt = $db->prepare("UPDATE books SET reserved=1 WHERE bookID = ?");
    $stmt->bind_param('i', $bookID);
    $stmt->execute();
    printf("<br><br>Book Reserved!");

    printf("<br><br><a href=browse.php.php>Search and Book more Books </a>");
    printf("<br><a href=mybooks.php>Return to Reserved Books </a>");
    printf("<br><a href=index.php>Return to the home page </a>");
    exit;
?>
    

