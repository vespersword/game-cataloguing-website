<?php
include("session.php");
$user = $_SESSION['login_user'];
if(isset($_GET['id'])){
        $remove_id = (string)$_GET['id']; 
        $sql = "SELECT * FROM lists where username = '$user'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        $list = $row['list'];
        $games = explode(" ",$list);
        if (($key = array_search($remove_id, $games)) !== false) {
    unset($games[$key]);
}
        $list = implode(" ",$games);
        $sql = "UPDATE lists SET list='$list' WHERE username='$user'";
        $result = mysqli_query($db,$sql);
        echo "Removed successfully!";
     }
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
  color: black;
  padding: 2px 16px;
}
img {
  border-radius: 5px 5px 0 0;
  height: 200px;
  width: 150px;
}
</style>
</head>
<body>
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
  Below we have your list of games: <br>
	<?php
  $user = $_SESSION['login_user'];
  $sql1 = "SELECT list from lists where username = '$user'";
  $result1 = mysqli_query($db,$sql1);
  $row1 = mysqli_fetch_array($result1);
  $list = $row1['list'];
  if($list == ''){
  echo "Looks like you have no games on your list yet.";
}
else{
  $games = explode(" ",$list);
  foreach($games as $game){
  $game = (int)$game;
  $sql = "SELECT * FROM games where game_id='$game'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result) or die(mysqli_error($db));
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
  echo "<a href='mylist.php?id=$gameid'> Remove from List </a>";  
  echo "</div>";
  echo "</div>";
  echo "</a>";
}

}
  ?>
</p>

</body>
</html>