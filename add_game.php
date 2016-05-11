<?php 
include ('includes/session.php');

$page_title = 'Add Games';
include ('includes/header.php');

require_once ('mysqli_connect.php'); // Connect to the db.
// Check if the form has been submitted

$user_id = $_SESSION['user_id'];


if (isset($_POST['submitted'])){
	$errors = array();
	
	//Check for game title
	if (empty($_POST['title'])) {
            $errors[] = 'You forgot to enter the game title';
    } else {
            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
    }
    
    //Check for game description
	if (empty($_POST['description'])) {
            $errors[] = 'You forgot to enter description';
    } else {
            $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
    }
    
    //Check for game genre
	if (empty($_POST['genre'])) {
            $errors[] = 'You forgot to enter genre';
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
    
	/*if (empty($_POST['average_rating'])) {
		$rating = mysqli_real_escape_string($dbc, trim($_POST['average_rating']));
	}*/ // TO-DO

	if (empty($errors)) {
		//INSERTING GAME IN THE DATABASE
		$get_query = "INSERT INTO game (title, description, user_id, genre, platform, price) VALUES ('$title', '$description', '$user_id', '$genre', '$platform' ,'$price')";
		$run_query = @mysqli_query($dbc,$get_query);
		if($run_query){
			echo '<h3> Game is added to the database</h3>';
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

?>
<!--HTML form-->
<div class="page-header">
    <h1>Add New Game</h1>
</div>
<form class="catalogForm" role="form" action="add_game.php" method="post">
   <p>Game Title: <input type="text" class="form-control" placeholder="Game Title" required autofocus name="title" maxlength="40" value="<?php
        if (isset($_POST['title']))
        echo $_POST['title'];
        ?>" /></p>
    <p>Game Description: <input type="text" class="form-control" placeholder="Description" required name="description" maxlength="500" value="<?php
        if (isset($_POST['description']))
        echo $_POST['description'];
        ?>" /></p>
    <!--<p>Rating (1-10): <input type="number" class="form-control" placeholder="Rating" required name="average_rating" maxlength="2" min="1" max="5" value="<?php
        /*if (isset($_POST['average_rating']))
        echo $_POST['average_rating'];*/
        ?>"  /> </p>-->
        
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
        
    <p>Price: <input type="number" step="0.01" class="form-control" placeholder="Price" required name="price" maxlength="10" min="50" max="500" value="<?php
        if (isset($_POST['price']))
        echo $_POST['price'];
        ?>" /></p>
    <p><button type="submit" name="submit" class="btn btn-primary" />Add</button></p>
    <input type="hidden" name="submitted" value="TRUE" />
    
    
</form>

<?php
//include ('includes/footer.html');
?>
