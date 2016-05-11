<?php # Script 8.6 - view_users.php #2
include ('includes/session.php');
// This script retrieves all the records from the users table.

$page_title = 'View the Current Users';
include ('includes/header.php');

// Page header:
echo '<h1>Reviews</h1>';

require_once ('mysqli_connect.php'); // Connect to the db.
		
// Make the query:
$q = "SELECT * FROM reviews WHERE isApproved = False";
		
$r = @\mysqli_query($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
	
	// Print how reviews there are:
	echo "<p>There are currently $num reviews to approve.</p>\n";

	// Table header.
	echo '<table align="center" cellspacing="2" cellpadding="2" width="75%">
	<tr>
		<td align="left">
			<b>Title</b>
		</td>
		<td align="left">
			<b>Game</b>
		</td>
		<td align="left">
			<b></b>
		</td>
	</tr>
';
	
	// Fetch and print all the records:
	
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$isApproved = $row['isApproved'];
		$gameId = $row['game_id'];
		$get_game = "SELECT title FROM game WHERE game_id = '$gameId'";
		$run_game = @\mysqli_query($dbc, $get_game);
		$gameTitle = mysqli_fetch_array($run_game, MYSQLI_ASSOC);
		
			echo '<tr>
					<td align="left">' . $row['title'] . '</td>
					<td align="left">' . $gameTitle['title'] . '</td>
					<td align="left">
						<a href="approval.php?rev_id='.$row['review_id'].'">Approve?</a>
					</td>
				</tr>';
	}

	echo '</table>'; // Close the table.
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no reviews.</p>';

}

mysqli_close($dbc); // Close the database connection.

?>
