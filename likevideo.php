<?php
//not like video php again
	include_once 'connect.php';
	if (isset($_POST['Like'])){
		$getlikesql="SELECT `Video_postedby` FROM `Video` WHERE `Video_name` = '$obj';";
		$getlikerow=mysqli_fetch_assoc(mysqli_query($conn, $getlikesql));


		$object = $videorow['Video_name'];
		$receiver = $videorow['Video_postedby'];
		$giver = $_SESSION['username'];
		$checksql = "SELECT `View_object` FROM `View` WHERE `View_object` = '$object' AND `View_giver` = '$givers' ;";
		$chquery = mysqli_query($conn, $checksql);
		if (mysqli_num_rows($chquery) == 0{
			$likesql = "INSERT INTO `View` (`View_object`, `View_receiver`, `Like_giver`) VALUES ('$object', '$receiver', '$giver');";
			mysqli_query($conn, $likesql);
		}
	}
?>