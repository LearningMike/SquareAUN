<?php
	include_once 'connect.php';
	session_start();
	if (isset($_POST['Download'])){
		$videoname = $_POST['videoname'];
		$downloadsql1="SELECT * FROM `Video` WHERE `Video_name` = '$videoname' ;";
		$downloadrow=mysqli_fetch_assoc(mysqli_query($conn, $downloadsql1));
		$object = $downloadrow['Video_name'];
		$receiver = $downloadrow['Video_postedby'];
		$giver = $_SESSION['username'];
		$dtype = $downloadrow['Video_type'];
		$checksql = "SELECT `Download_object` FROM `Download` WHERE `Download_object` = '$object' AND `Download_giver` = '$giver' AND `Download_type` = '$dtype';";
		$chquery = mysqli_query($conn, $checksql);
		if (mysqli_num_rows($chquery) == 0){
			$viewmysql = "INSERT INTO `Download` (`Download_object`, `Download_receiver`, `Download_giver`, `Download_type`) VALUES ('$object', '$receiver', '$giver', '$dtype');";
			mysqli_query($conn, $viewmysql);
			$checksql2 = "SELECT `Download_object` FROM `Download` WHERE `Download_object` = '$object' AND `Download_type` = '$dtype';";
			$numofviews = mysqli_num_rows(mysqli_query($conn, $checksql2));
			$storeviews = "UPDATE `Video` SET `Video_downloads` = '$numofviews' WHERE `Video_name` = '$object' AND `Video_type` = '$dtype'; ";
			mysqli_query($conn, $storeviews);
		}
		$vid = $downloadrow['Video_path'];
		header("Location:../".$vid);
	}
?>