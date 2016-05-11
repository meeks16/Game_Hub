<?php # Script 8.5 - register.php #2
include ('includes/session.php');

$page_title = 'Game Details';
include ('includes/header.php');

require_once ('mysqli_connect.php'); // Connect to the db.

$get_id = $_GET["gm_id"];
$get_platform_id = $_GET["pt_id"];
echo '<p>'.$get_platform_id.'</p>';

$get = "SELECT title, description, genre_id, platform_id FROM games WHERE game_id = '$get_id' ";
$run = @\mysqli_query($dbc, $get);

$get_plat = "SELECT platform_title FROM platform WHERE platform_id = '$get_platform_id' ";
$run_plat = @\mysqli_query($dbc, $get_plat);


// To display game details
	//echo'<p>'. $get_id .'</p>'
	while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) {
		
		echo'<p>'.$row['title'].','.$row['description'].' </p>';
	}

// To display game platform title
    //echo "Hello";
	//echo'<p>'.$get_plat.'</p>';
	/*while($row_plat = mysqli_fetch_array($run_plat, MYSQLI_ASSOC)) {
		echo '<p>'.$row_plat['platform_title'].'</p>';
	}*/

mysqli_close($dbc);
?>



<?php
include ('includes/footer.html');
?>