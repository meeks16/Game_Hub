<?php 
include ('includes/session.php');

$page_title = 'Delete a Game';
include ('includes/header.php');
echo '<h3>Delete a Game</h3>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From game_Catalog.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.html'); 
	exit();
}

require_once ('mysqli_connect.php'); // Connect to the db.

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM game WHERE game_id=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Print a message:
			echo '<p><div class="well"><h3>The game has been deleted.</h3></div></p>';	
		
		} else { // If the query did not run OK.
			echo '<p class="error"><h4>The game could not be deleted due to a system error.</h4></p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { // No confirmation of deletion.
		echo '<p><div class="well"><h3>The game has NOT been deleted.</h3></div></p>';	
	}

} else { // Show the form.

	// Retrieve the user's information:
	$q = "SELECT title, description, game_id, genre, platform, price, rating FROM game WHERE game_id = $id";
	$r = @mysqli_query ($dbc, $q);
	
	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Create the form:
		echo '<form action="delete_game.php" method="post">
	<h3>Name: ' . $row[0] . '</h3>
	<p>Are you sure you want to delete this game?<br />
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No</p>
	<p><input type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} else { // Not a valid user ID.
		echo '<p class="error"><h4>This page has been accessed in error.</h4></p>';
	}

} // End of the main submission conditional.

mysqli_close($dbc);
		
?>
<?php
include ('includes/footer.html');
?>