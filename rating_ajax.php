<?php

include "config.php";

$userid = 4; // User id
$postid = $_POST['gameid'];
$rating = $_POST['rating'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM post_rating WHERE game_id=".$gameid." and user_id=".$userid;

$result = mysqli_query($db,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if($count == 0){
 $insertquery = "INSERT INTO post_rating(user_id,game_id,rating) values(".$userid.",".$gameid.",".$rating.")";
 mysqli_query($db,$insertquery);
}else {
 $updatequery = "UPDATE post_rating SET rating=" . $rating . " where user_id=" . $userid . " and game_id=" . $postid;
 mysqli_query($db,$updatequery);
}

// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE game_id=".$gameid;
$result = mysqli_query($db,$query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);