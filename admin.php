<?php
include('config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Games</title>
	<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body bgcolor ="lightblue">
<div align=center>
<h1> Game Cataloguer Game Upload </h1>
<form name="reg" action="" method="post"">
	<label>Game Name:</label> <input type="text" name="name"><br>
	<label>Description:</label> <input type="text" name="description"><br>
	<label>Genre:</label> <input type="text" name="genre"> <br>
	<label>Image Path Name:</label> <input type="text" name="image"> <br>
	<label>BG Image Path Name:</label> <input type="text" name="bgimage"> <br>
	<input type="submit" name="submit"> <br>
</form>
</div>
<a href="index.php">Click here to go to login page. </a>
</body>
</html>

<?php
if(isset($_POST['submit'])){
$name = $_POST['name'];
$desc = $_POST['description'];
$genre = $_POST['genre'];
$imgpath = $_POST['image'];
$bgimgpath = $_POST['bgimage'];

$sql = "INSERT INTO games (game_name, game_description, genre, image_path, bg_image_path)
VALUES ('$name', '$desc', '$genre','$imgpath','$bgimgpath')";

$result = mysqli_query($db,$sql);
if ($result) {
    echo "Successfully added game.";
} 
}
?>