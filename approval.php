<?php
include ('includes/session.php');


$page_title = 'Approve/Reject';
include ('includes/header.php');

require_once ('mysqli_connect.php'); // Connect to the db.

$get_id = $_GET["rev_id"];

$get_review = "SELECT * FROM reviews WHERE review_id = '$get_id'";
$run_review = @\mysqli_query($dbc, $get_review);
$row_review = mysqli_fetch_array($run_review, MYSQLI_ASSOC);

$rev_title = $row_review['title'];
$rev_description = $row_review['description'];
$rev_review = $row_review['game_review'];
$rev_rating = $row_review['rating'];
$rev_is_approve = $row_review['isApproved'];
$review_id = $row_review['review_id'];

if (isset($_POST['Approve'])){
	$get_reviewId = mysqli_real_escape_string($dbc, trim($_POST['gameReviewId']));
    $get_query = "UPDATE reviews SET isApproved = 1 WHERE review_id = $get_reviewId";
    $run_query = @mysqli_query($dbc,$get_query);
	if($run_query){
		echo '<h3>Thank You! Review has been approved!.</h3>';
	}
	
	mysqli_close($dbc);
	exit();
} 
if (isset($_POST['Reject'])){ // Report the errors.
	$get_reviewId = mysqli_real_escape_string($dbc, trim($_POST['gameReviewId']));
	echo $get_reviewId;
    $get_query = "DELETE FROM reviews WHERE review_id = $get_reviewId";      
    $run_query = @mysqli_query($dbc,$get_query);
	if($run_query){
		echo '<h3>Review has been rejected!.</h3>';
	}
	
	mysqli_close($dbc);
	exit();
}

mysqli_close($dbc);
?>

<div class="page-header">
	<h1>Approve or Reject Review</h1>
</div>
<form class="form-horizontal" role="form" action="approval.php" method="post">
	<div class="form-group form-group-lg">
		<div class="col-xs-4">
			<p><input type="hidden" name="gameReviewId" value ="<?php echo $review_id ?>"/></p>
			<p><strong>Game Rating: </strong> <?php echo $rev_rating ?> Stars.
			<div class="rate">
			<?php
				for ($i = 5; $i >= 1; $i--){
					if ($rev_rating == $i){
echo'					<input type="radio" name="rate" value="'.$i.'" checked="checked" /> 
						<label for="star'.$i.'" title="text"></label>';
					}
					else {
echo '					<input type="radio" name="rate" value="'.$i.'"/>
						<label for="star'.$i.'" title="text"></label>';
					}		
				}
			?>
			</div><br>
			</p>
			<br><br>
			
			<p><strong>Title: </strong><?php echo $rev_title; ?></p><br>
			<p><strong>Description: </strong><?php echo $rev_description; ?></p><br>
			<p><strong>Game Review: </strong><?php echo $rev_review; ?></p><br>
			
			<input type="hidden" name="submitted" value="TRUE" />
			<p>
				<button type="submit" name="Approve" class="btn btn-sm btn-primary" />Approve</button>
				<button type="submit" name="Reject" class="btn btn-sm btn-primary" />Reject</button>
			</p>
		</div>
	</div>
</form>