<?php # Script 3.4 - index.php
include ('includes/session.php');

$page_title = 'Welcome to GameHUB!';
include ('./includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  body {
    background-color: #f0f0f5;
  }

  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
</head>
<body>
		<div class="page-header">
		    <h1>Welcome to Game Hub</h1>
		</div>
		<div class="well">
		    <p>Game Hub App is a PHP web application intended for the video gamming industry.  It allows users to browse through a catalog of the best video games across all major platforms.  This application provides search and filtration functionalities, and current video game news and reviews.  It is an application that allow users to review and rate games within the catalog.  .</p>
		</div>
		<div class="well">
			    <div id="myCarousel" class="carousel slide" data-ride="carousel">
			    <!-- Indicators -->
				    <ol class="carousel-indicators">
				      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      <li data-target="#myCarousel" data-slide-to="1"></li>
				      <li data-target="#myCarousel" data-slide-to="2"></li>
				      <li data-target="#myCarousel" data-slide-to="3"></li>
				    </ol>

			    	<!-- Wrapper for slides -->
				    <div class="carousel-inner" role="listbox">
				      <div class="item active">
				        <img src="images/game_hub1.jpg" alt="Call of Duty" width="460" height="345">
				      </div>

				      <div class="item">
				        <img src="images/game_hub2.jpg" alt="Mario" width="460" height="345">
				      </div>
				    
				      <div class="item">
				        <img src="images/game_hub3.jpg" alt="Sonic Jump" width="460" height="345">
				      </div>

				      <div class="item">
				        <img src="images/game_hub4.jpg" alt="Prince of Persia" width="460" height="345">
				      </div>
				    </div>

			    	<!-- Left and right controls -->
				    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				      <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				      <span class="sr-only">Next</span>
				    </a>
			  	</div>
		</div>
</body>
</html>
<?php
include ('./includes/footer.html');
?>