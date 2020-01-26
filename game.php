<?php
include('config.php');
session_start(); 
$user = $_SESSION['login_user'];
$_SESSION['game_id']=$_GET['id'];
$id = $_SESSION['game_id'];
$sql = "SELECT * FROM games where game_id = '$id'";
$result = mysqli_query($db,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
$row = mysqli_fetch_array($result);
$gameid = $row['game_id'];
$title = $row['game_name'];
$desc = $row['game_description'];
$genre = $row['genre'];
$img = $row['image_path'];
$bimg = $row['bg_image_path'];
?>

<html>
<head>
<title> Game Cataloguer </title>
<link rel="stylesheet" type="text/css" href="home.css">
<link rel="stylesheet" type="text/css" href="game.css">
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

<main class="container">
  <div class="left-column">
    <img src="<?php echo $bimg ?>" alt="">
  </div>

  <div class="right-column">
    <div class="game-description">
      <h1><?php echo $title ?></h1>
      <p><?php echo $desc ?>
      	
      </p>
    </div>

    </div>
    <div>
      <!--<a href="game.php?" class="addList">Add to my list</a> -->
      <form method='post' action="game.php?id=<?php echo $id ?>">
      <input type="submit" value="Add to my list" name="submit"> 
      <?php
      if(isset($_POST['submit'])){
        $a = (string)$gameid;
        $sql = "SELECT * FROM lists where username = '$user'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        $list = $row['list'];
        $games = explode(' ',$list);
        if(in_array($a, $games)){echo "Already in list.";}
          else{
        if(empty($list)){
          $list = $a;
        }
        else{
          $list= $list.' ';
          $list= $list.$a;
        }
        $sql = "UPDATE lists SET list='$list' WHERE username='$user'";
        $result = mysqli_query($db,$sql);
      	echo "Added successfully!";
      }
    }
      ?>
      </form>
  </div>
  </div>

<div class='bottom'>
<div class="content">

 <?php
 $userid = $user;
 $query = "SELECT * FROM games where game_id = '$id'";
 $result = mysqli_query($db,$query);
 while($row = mysqli_fetch_array($result) or die(mysqli_error($db))){
  $gameid = $row['game_id'];
  $title = $row['game_name'];
  $desc = $row['game_description'];
  //$link = $row['link'];

  // User rating
  $query = "SELECT * FROM game_rating WHERE game_id='$gameid' and user_id='$userid'";
  $userresult = mysqli_query($db,$query) or die(mysqli_error());
  $fetchRating = mysqli_fetch_array($userresult);
  $rating = $fetchRating['rating'];

  // get average
  $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM game_rating WHERE game_id='$gameid'";
  $avgresult = mysqli_query($db,$query) or die(mysqli_error($db));
  $fetchAverage = mysqli_fetch_array($avgresult);
  $averageRating = $fetchAverage['averageRating'];

  if($averageRating <= 0){
   $averageRating = "No rating yet.";
  }
  if($rating <= 0){
    $yourRating = "No rating yet.";
  }
  else{
    $yourRating = $rating;
  }

 ?>
  
   <div class="game-action">
   <!-- Rating -->
   <form action='' method='post'>
   <select name='rating' class='rating' id='rating_<?php echo $gameid; ?>' data-id='rating_<?php echo $gameid; ?>'>
    <option value="1" >1</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
   </select>
   <input type="submit" name="submit2">
 </form><br>
   Your Rating: <?php echo $yourRating ?>
   Average Rating : <span id='avgrating_<?php echo $gameid; ?>'><?php echo $averageRating; ?></span>
</div>
<?php
if(isset($_POST['submit2'])){
  $user = $_SESSION['login_user'];
  $rating = $_POST['rating'];
  $query = "SELECT COUNT(*) AS cntpost FROM game_rating WHERE game_id='$id' and user_id='$user'";
  $result = mysqli_query($db,$query);
  $fetchdata = mysqli_fetch_array($result);
  $count = $fetchdata['cntpost'];
  if($count == 0){
 $insertquery = "INSERT INTO game_rating(user_id,game_id,rating) values('$user','$id','$rating')";
  mysqli_query($db,$insertquery);

}
else {
 $updatequery = "UPDATE game_rating SET rating='$rating' where user_id='$user' and game_id='$id'";
 mysqli_query($db,$updatequery);
}
  
}

?>
   
   </div>
  </div>
 <?php
 }
 ?>
</div>


</main>



</body>
</html>
