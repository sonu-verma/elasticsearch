<?php

	require_once 'app/init.php';

	/*$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "elasticsearch";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password,$database);


	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql = 'SELECT * FROM article';
         $result = mysqli_query($conn, $sql);

         	
         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               echo "title: " . $row["title"]. "<br>";
               echo "body: " . $row["body"]. "<br>";
               echo "keyword: " . $row["keywords"]. "<br>";
            }
         } else {
            echo "0 results";
         }
	

	mysqli_close($conn);
*/


	if(isset($_POST['title']) && isset($_POST['body']) && isset($_POST['keywords'])){

		$title  = $_POST['title'];
		$body  = $_POST['body'];
		$keywords  = explode(',', $_POST['keywords']);

		$indexed = $client->index([
			'index' => 'articles',
			'type' => 'article',
			'body' => [
				'title' => $title,
				'body' => $body,
				'keywords' => $keywords
			]
		]);


	}
?>


<!doctype html>
<html>
	<head>
		<title>Add indexes</title>
	</head>
	<body>
		
		<div class="">
			<form action="setJson.php" method="POST">
			<table>
				<tr>
					<th>Title : </th>
					<td><input type="text" name="title"></td>
				</tr>	
				<tr>
					<th>Body : </th>
					<td><textarea name="body"></textarea></td>
				</tr>	
				<tr>
					<th>Title : </th>
					<td><input type="text" name="keywords"></td>
				</tr>	
				<tr>
					<td><input type="submit" value="Submit"></td>
				</tr>	
			</table>
		</form>
		</div>
	</body>
</html>