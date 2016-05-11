<?php
include ('includes/session.php');


$page_title = 'Review Game';
include ('includes/header.php');

require_once ('mysqli_connect.php'); // Connect to the db.

$get_id = $_GET["gm_id"];
$user_id = $_SESSION['user_id'];


if (isset($_POST['submitted'])){
	$errors = array();
	
	// get game_id
	$get_gameId = mysqli_real_escape_string($dbc, trim($_POST['gameTitleId']));
	
	//Check for review rating
	if (empty($_POST['rating'])) {
            $errors[] = 'Please rate the game';
    } else {
            $rating = mysqli_real_escape_string($dbc, trim($_POST['rating']));
    }
    
    //Check for review title
	if (empty($_POST['title'])) {
            $errors[] = 'You forgot to enter the title';
    } else {
            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
    }
    
    //Check for review description
	if (empty($_POST['description'])) {
            $errors[] = 'You forgot to enter description';
    } else {
	    	
            $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
            
    }
    
    //Check for review
	if (empty($_POST['game_review'])) {
            $errors[] = 'Please right a review';
    } else {
            $game_review = mysqli_real_escape_string($dbc, trim($_POST['game_review']));
    }
    

	
	if (empty($errors)) {
		//INSERTING GAME IN THE DATABASE
		$get_query = "INSERT INTO reviews (title, description, game_review, user_id, game_id, rating) VALUES ('$title', '$description', '$game_review', '$user_id', '$get_gameId', '$rating')";
		
		$run_query = @mysqli_query($dbc,$get_query);
		
		if($run_query){
			echo '<h3>Thank You! Your review has been submitted.</h3>';
		}
		else {
			echo '<h3>System error</h3>
			<p class="error"> Sorry for inconvinience.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $get_query . '</p>';
		}
		mysqli_close($dbc);
		exit();
	} else { // Report the errors.

            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) { // Print each error.
                    echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
    } 
}

$get_game_title = "SELECT * FROM game WHERE game_id = '$get_id'";
$run_game_title = @mysqli_query($dbc,$get_game_title);
$rowG = mysqli_fetch_array($run_game_title, MYSQLI_ASSOC);
$game_title = $rowG['title'];
$get_game_id = $rowG['game_id'];


mysqli_close($dbc);
?>

<div class="page-header">
	<h1>Add Review</h1>
</div>
<form class="form-horizontal" role="form" action="reviews.php" method="post">
	<div class="form-group form-group-lg">
		<div class="col-xs-4">
			<p><strong>Game: </strong><?php echo $game_title ?> </p>
			<p><input type="hidden" name="gameTitleId" value ="<?php echo $get_game_id ?>"/></p>
			
			<p><strong>Game Rating:</strong> 
			<div class="rate">
				<input type="radio" id="star5" name="rating" value="5" />
				<label for="star5" title="text"></label>
				<input type="radio" id="star4" name="rating" value="4" />
				<label for="star4" title="text"></label>
				<input type="radio" id="star3" name="rating" value="3" />
				<label for="star3" title="text"></label>
				<input type="radio" id="star2" name="rating" value="2" />
				<label for="star2" title="text"></label>
				<input type="radio" id="star1" name="rating" value="1" />
				<label for="star1" title="text"></label>
			</div> 
			</p>
			<br>
			<p class="choice"> Select number of stars </p>
						
			<br>
			
			<p><strong>Title:</strong> <input type="normal" class="form-control"  name="title" 
				placeholder="Enter reiview title here..." required autofocus name="title"
				value="<?php if (isset($_POST['title'])) echo $_POST['title'] ?>" /> 
			</p><br>
			<p><strong>Description:</strong> <input type="normal" class="form-control"  name="description"
				placeholder="Enter description here..." required autofocus name="description"
				value="<?php if (isset($_POST['description'])) echo $_POST['description'] ?>"/>
			</p><br>
						
			<p><strong>Review:</strong> <input type="normal" class="form-control"  name="game_review" r
				placeholder="Enter your review here..." required autofocus name="game_review"
				value="<?php if (isset($_POST['game_review'])) echo $_POST['game_review'] ?>" />
			</p><br>
			<input type="hidden" name="submitted" value="TRUE" />
			<p><button type="submit" name="submit" class="btn btn-sm btn-primary" />Post Review</button></p>
		</div>
	</div>
</form>
<script> 
    $(':radio').change(
		function(){
			$('.choice').text( ' You have selected ' + this.value + ' stars' );
			} 
		)
</script>

