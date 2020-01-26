<!DOCTYPE html>
<?php
//include("config.php");
include("session.php");
?>

<html>
<head>
	<title> Game Cataloguer </title>
	<link rel="stylesheet" type="text/css" href="home.css">
<style type="text/css">
body{
  background-color: #2F2FA2;
}
.card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,1);
  transition: 0.3s;
  float: left;
  width: 12%;
  color: black;
  background-color: grey;
  padding: 0 10px;
  margin: 0 -5px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container {
  padding: 2px 16px;
}
img {
  border-radius: 5px 5px 0 0;
  height: 200px;
  width: 150px;
}
  </style>
</head>
<body bgcolor = lightgrey>
<div class="header">
  <a href="home.php" class="logo">GameCataloguer</a>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a href="games.php">Games</a>
    <a href="mylist.php">My List</a>
    <a href="recommend.php">Recommendations</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
<p>
	Below we have a list of games:
  <div class = gap>
  <?php
  $sql = "SELECT * FROM games";
  $result = mysqli_query($db,$sql);
  while($row = mysqli_fetch_array($result)){
  $gameid = $row['game_id'];
  $title = $row['game_name'];
  $genre = $row['genre'];
  $img = $row['image_path'];
  echo "<a href='game.php?id=$gameid'>";
  echo "<div class='card'>";
  echo "<img src='$img' alt='Avatar' style='width:100%>'";
  echo "<div class='container'>";
  echo "<h4><b>$title</b></h4>";
  echo "<p>Genre: $genre</p>"; 
  echo "</div>";
  echo "</div>";
  echo "</a>";
}
  ?>
</div>
</p>



</body>
</html>