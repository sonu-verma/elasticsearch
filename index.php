
<?php
	
	require_once 'app/init.php';

	if(isset($_GET['q'])){
		$q = $_GET['q'];
		$query = $client->Search([
			'index' => 'articles',
			'type' => 'article',
			'body' => [
				"query" => [
					"bool" => [
						"should" => [
							"match" => ["title" => $q ],
							"match" => ["body" => $q ],
							"match" => ["keywords" => $q ]
						]
					]
				] 
			]
		]);

		//print_r($query);die();
		if($query['hits']['total'] >= 1){
			$result = $query['hits']['hits'];
		}
	}

?>

<!doctype html>
<html>
	<head>
			<title></title>
	</head>
	<body>
		<form action="index.php" method="get" autocomplete="off">
			<label>
				Search for something
				<input type="text" name="q">
			</label>
			<input type="submit" value="earch">
			<ul>
			<?php
				if(count($result) > 0){

					foreach($result as $data){
							?>

							<li><h1><?php echo $data['_source']['title']; ?></h1></li>
							<li><p><?php echo $data['_source']['body']; ?></p></li>
							<li><?php echo implode(',', $data['_source']['keywords']); ?></li>

							<?php
					}

				}

			?>
			</ul>
		</form>
	</body>
</html>