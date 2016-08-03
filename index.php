<?php
//Fetch Posts from SQLite Database...

//Establish DB Connection:
try{
	$dbconn = new PDO('sqlite:database.sqlite');
}catch(PDOException $e){
	echo '<h1>Error on connecting DB</h1><br />';

}

//After that, read the posts and display them:
$sth = $dbconn->prepare('SELECT title, date, content FROM posts');
$sth->execute();

?>
<html>
<head>
	<title>Eunix Simple Bulletin</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/blog.css" rel="stylesheet">

</head>

<body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index.php">Home</a>
          <a class="blog-nav-item" href="post.php">Write New Post</a>
          <a class="blog-nav-item" href="manage.php">Post Management</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
    </div>

	<div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Eunix Simple Bulletin</h1>
        <p class="lead blog-description">The special place for friends to leave some reflections.</p>
      </div>

      <div class="row">
        <div class="col-sm-8 blog-main">
        <?php
        //Display the executed and fetched result:
		$result = $sth->fetchAll();
		for($i = 0; $i<count($result); $i++){
			echo "<div class=\"blog-post\">\n";
			echo "<h2 class=\"blog-post-title\">";
			echo $result[$i][title];
			echo "</h2>\n";
      echo "<p class=\"blog-post-meta\">Date Number:";
      echo $result[$i][date];
      echo "</p>\n";
			echo $result[$i][content];
			echo "</div><!-- /.blog-post -->\n\n";
		}
		?>
		</div>
      </div>

    </div>
</body>
</html>
