<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.
include ('includes/session.php');

$page_title = 'Edit a Game';
include ('includes/header.php');

echo '<h3>Edit a Game</h3>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
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

	$errors = array();
	
	// Check for game title:
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter the game title.';
	} else {
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}
	
	// Check for game description:
	if (empty($_POST['description'])) {
		$errors[] = 'You forgot to enter description.';
	} else {
		$description = mysqli_real_escape_string($dbc, trim($_POST['description']));
	}
	
	// Check for game genre:
	if (empty($_POST['genre'])) {
		$errors[] = 'You forgot to enter genre.';
	} else {
		$genre = mysqli_real_escape_string($dbc, trim($_POST['genre']));
	}

	//Check for game platform
	if (empty($_POST['platform'])) {
            $errors[] = 'You forgot to enter platform';
    } else {
            $platform = mysqli_real_escape_string($dbc, trim($_POST['platform']));
    }
    
    //Check for game price
	if (empty($_POST['price'])) {
            $errors[] = 'You forgot to enter price';
    } else {
            $price = mysqli_real_escape_string($dbc, trim($_POST['price']));
    }
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT game_id FROM game WHERE title='$title' AND game_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE game SET title='$title', description='$description', genre='$genre', platform='$platform', price='$price' WHERE game_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Print a message:
				echo '<p><div class="well"><h3>The game has been edited.</h3></div></p>';	
							
			} else { // If it did not run OK.
				echo '<p class="error">The game could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already added.
			echo '<p class="error">The game title already exists.</p>';
		}
		
	} else { // Report the errors.
	
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
		
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT game_id, title, description, genre, platform, price FROM game WHERE game_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form class= "catalogForm" action="edit_game.php" method="post">
	<p>Game Title: <input type="text" class="form-control" placeholder="Game Title" required autofocus name="title" maxlength="40" value="'.$row[1].'" /></p>
    <p>Game Description: <input type="text" class="form-control" placeholder="Description" required name="description" maxlength="500" value="'.$row[2].'" /></p>
    <p>Genre: </p>
    <select id="genre" class="form-control" required name="genre">
        <option value="">Select Genre</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Racing">Racing</option>
    </select>
    
    <p>Platform: </p>
    <select id="platform" class="form-control" required name="platform">
        <option value="">Select Platform</option>
        <option value="PS3">Nintendo</option>
        <option value="PS4">Wi</option>
        <option value="XBox">XBox</option>
        <option value="PS3">PS3</option>
		<option value="PS4">PS4</option>
    </select>
        
    <p>Price: <input type="number" step="10" class="form-control" placeholder="Price" required name="price" maxlength="10" min="50" max="500" value="'.$row[7].'" /></p>
    <p><button type="submit" name="submit" class="btn btn-primary" />Submit</button></p>
    <input type="hidden" name="submitted" value="TRUE" />
    <input type="hidden" name="id" value="' . $id . '" />
    

</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
include ('includes/footer.html');
?>
