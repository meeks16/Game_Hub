
<?php 
include ('includes/session.php');

$page_title = 'Games Catalog';
include ('includes/header.php');

require_once ('mysqli_connect.php'); // Connect to the db.

$type = $_SESSION['user_type_id'];

			     	if(isset($_POST['submit'])){     
    						$link = "<script>window.open('add_game.php','new', 'toolbars=0,width=600,height=400,left=200,top=200,scrollbars=1,resizable=1')</script>";
    						echo $link;
    				}
	
echo'<div class="container-fluid text-center">  
	  	<div class="row content">';
echo'			<div class="col-sm-2 sidenav">
				    	<br><br><br><br><br>
				    	<div class = "dropdown">
					    	<form class = "catalogForm" role = "form" action="game_catalog.php" method="post">
								<h4>Filter by..</h4>
								<select id="genre" class="form-control" style="width:auto;" required name="genre">
							 		<option value="">Select Genre&nbsp;&nbsp;&nbsp;&nbsp;</option>
							        <option value="Action">Action</option>
							        <option value="Adventure">Adventure</option>
							        <option value="Racing">Racing</option>
							    </select>
							    <br>
							    <select id="platform" class="form-control" style="width:auto;" required name="platform">
							        <option value="">Select Platform</option>
							        <option value="Nintendo">Nintendo</option>
							        <option value="Wi">Wi</option>
							        <option value="XBOX">XBOX</option>
							        <option value="PS3">PS3</option>
							        <option value="PS4">PS4</option>
							    </select>
							    <br>
							    <select id="platform" class="form-control" style="width:auto;" required name="price">
							        <option value="">Select Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
							        <option value="50">$ 50 </option>
							        <option value="60">$ 60</option>
							        <option value="100">$ 100</option>
							        <option value="110">$ 110</option>
							        <option value="250">$ 250</option>
							        <option value="400">$ 400</option>
							    </select>
						  		<br>
							    <p><button type="submit" name="filter" class="btn btn-primary pull-center" />&nbsp;Filter&nbsp;</button></p>
							</form> 	

						</div>
				</div>'; 

$get = "SELECT title, description, game_id, genre, platform, price, rating FROM game";
	if(isset($_POST['filter'])){
		$genre = mysqli_real_escape_string($dbc, trim($_POST['genre']));
		$platform = mysqli_real_escape_string($dbc, trim($_POST['platform']));
		$price = mysqli_real_escape_string($dbc, trim($_POST['price']));
		$get .= " WHERE genre = '$genre' AND platform = '$platform' AND price = '$price'";
	}
$run = @\mysqli_query($dbc, $get);
$num_rows = mysqli_num_rows($run); 


echo'			<div class="col-sm-10 text-left"> 
					<h1>Games</h1>';
			     	// ADD game button
			     	if($type == 3){
			     		echo '<form class="catalogForm" role="form" action="game_catalog.php" method="post">';
    					echo '<input type="submit" class="btn btn-primary pull-right" name="submit" value="Add Game">';
    					echo '</form><br><br>'; 		     	
    				} 
    				$row_num = 0;
    				if($run){
			     	echo'
			     	<div class="list-group">
			     		<div class = "panel-group" id ="accordion">';

			      		// Fetch and print all the records:
							while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) {
								$row_num = $row_num + 1;
								echo '<div class = "panel panel-default">
										<div class = "panel-heading">
											<h4 class = "panel-title"> ';
echo'											<a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse'.$row_num.'">
													'.$row['title'].'</a>';
												
												if($type == 3){	 
echo'												<a class="pull-right" style = "padding:6px;"href="delete_game.php?id='.$row['game_id'].'">
														Delete </a> &nbsp;&nbsp; 
													<a class="pull-right" style = "padding:6px;" href="edit_game.php?id='.$row['game_id'].'">
														&nbsp;&nbsp;Edit</a>';
												}
echo'										</h4>
										</div>
										<div id = "collapse'.$row_num.'" class = "panel-collapse collapse">
											<div calss = "panel-body" style ="padding:10px">
												<p><b>Description: </b> '.$row['description'].'<br><br>
													<b>Genre: </b> '.$row['genre'].'<br>
													<b>Platform: </b> '.$row['platform'].'<br>
													<b>Rating: </b> '.$row['rating'].'<br>
													<b>Price: </b> $ '.$row['price'].'<br>
												</p>
												<b>Reviews: <a class="btn btn-primary pull-right" href="reviews.php?gm_id='.$row['game_id'].'">
													add review
												</a></b><hr>';
												$get_gameId = $row['game_id'];
												$get_reviews = "SELECT * FROM reviews WHERE game_id = '$get_gameId'";
												$run_reviews = @\mysqli_query($dbc, $get_reviews);
												$rev_num_rows = mysqli_num_rows($run_reviews);	
												while ($row_rev = mysqli_fetch_array($run_reviews, MYSQLI_ASSOC)) {
echo'												<p>
														&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Title: </i></b>'.$row_rev['title'].' <br>
														&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Rated: </i></b>'.$row_rev['rating'].' Stars<br>
														&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Description: </i></b>'.$row_rev['description'].' <br>
														&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Review: </i></b>'.$row_rev['game_review'].'
													</p>';
													$isApproved = $row_rev['isApproved'];
													if ($type == 3 && $isApproved == False) {
echo'													<p><a class="pull-right" href="approval.php?rev_id='.$row_rev['review_id'].'">
															Approve?
														</a></p><br>';
													}
echo'												<hr>';
												}										
echo'										</div>
										</div>
									</div>';
							}

echo'					</div>
					</div>';
				}
				else{
					echo '<p> No results found.</p>';
				}
echo			'</div>';


echo'		</div>
					<hr>
	</div> ';  

mysqli_close($dbc);
?>


<?php
include ('includes/footer.html');
?>
