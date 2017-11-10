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
				BROWSE BOOKS
			</h2>
			<form action="browse_books.php" method="GET">
                <table cellpadding="6">
                    <tbody>
                        <tr>
                            <td>Title</td>
                            <td><INPUT type="text" name="searchtitle" id="form_title" placeholder="Write title here"></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                            <td><INPUT type="text" name="searchauthor" id="form_author" placeholder="Write author here"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><INPUT type="submit" name="submit" id="submit_button" value="SUBMIT"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php
			$books = array();
			$books[] = array("title" => "What Happened", "author" => "Hillary Rodham Clinton");
			$books[] = array("title" => "It: A Novel", "author" => "Stephen King");
			$books[] = array("title" => "Beartown: A Novel", "author" => "Fredrik Backman");
			$books[] = array("title" => "Exit West: A Novel", "author" => "Mohsin Hamid");	
				
            if (isset($_GET) && !empty($_GET)) {
			//check if the submit button has been pressed	
				                
                $searchtitle = trim($_GET['searchtitle']);
                $searchauthor = trim($_GET['searchauthor']);
				//first trim the search (remove white space)

                $searchtitle = addslashes($searchtitle);
                $searchauthor = addslashes($searchauthor);   //adds slashes if there's an apostrophe or quotation mark           
                
                $id = array_search($searchtitle, array_column($books, 'title'));
				$id2 = array_search($searchauthor, array_column($books, 'author'));
				//here we create a variable $id and basically say that we want the data from the array matching the search criteria

                echo '<table cellpadding="6">';
                echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';
				//echo $id;
				
                
                if ($id !== FALSE) {
					//now we check if we have the ID or not in our array. If the search was a hit, it will assign something to our DB, if not, then it will not work.
                    $book = $books[$id];
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
                    echo "</tr>";
                }
				elseif ($id2 !== FALSE) {
					//now we check if we have the ID or not in our array. If the search was a hit, it will assign something to our DB, if not, then it will not work.
                    $book = $books[$id2];
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a href="reserve.php?reservation=' .  urlencode($title) . '"> Reserve </a></td>';
                    echo "</tr>";
                }
                echo "</table>";
            } 
            
            //the IF statement above is used to check if the GET metod is set, if it has displayed the results of the search. If it not has been set, the whole list will be displated instead 
				
            else 
            //this ELSE statement basically just how the book-list    
                {                
                echo '<table cellpadding="6">';
                echo '<tr><b><td>Title</td> <td>Author</td> <td>Reserve</td> </b> </tr>';
                foreach ($books as $book) {
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a href="reserve.php?reservation=' . urlencode($title) . '"> Reserve </a></td>';
                    echo "</tr>";
                }
                echo "</table>";
            }
            ?>
            
			<!--
			
			//this array stores all the books avaliable in the web library
				
			echo '<table cellpadding = "6">';
			echo '<tr><b><td class="browse_title">Title</td> <td class="browse_title">Author</td> <td></td> </b> </tr>';
			
			//loop through the books array and echo the result	
			foreach ($books as $book) {
                    $title = $book['title'];
                    $author = $book['author'];
                    echo "<tr>";
                    echo "<td> $title </td><td> $author </td>";
                    echo '<td><a id="reserv_button" href="reserve.php?reservation=' . urlencode($title) . '"> RESERVE </a></td>';
                    echo "</tr>";
                }
                echo "</table>";	
			-->
			</div>
			<aside id="rightColumn">
				<div id="asideBox">
					<h3>
						Bestsellers
					</h3>
					<ul>
						<li>
							<a href="#">Title 1</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 2</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 3</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 4</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 5</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
					</ul>
				</div>
				<div id="asideBox2">
					<h3>
						New releases
					</h3>
					<ul>
						<li>
							<a href="#">Title 1</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 2</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 3</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 4</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
						<li>
							<a href="#">Title 5</a>
							<p>
								Firstname Lastlastname
							</p>
						</li>
					</ul>
				</div>
			</aside>	
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>