<?php
	include_once 'connect.php';
	session_start();
	if (isset($_POST['Download'])){
		$seriename = $_POST['seriename'];
		$downloadsql1="SELECT * FROM `Series` WHERE `Series_name` = '$seriename' ;";
		$downloadrow=mysqli_fetch_assoc(mysqli_query($conn, $downloadsql1));
		$object = $downloadrow['Series_name'];
		$receiver = $downloadrow['Series_postedby'];
		$giver = $_SESSION['username'];
		$sep = $downloadrow['Series_episode'];
		$sse = $downloadrow['Series_season'];
		$dtype = $sse.$sep;
		$checksql = "SELECT `Download_object` FROM `Download` WHERE `Download_object` = '$object' AND `Download_giver` = '$giver' AND `Download_type` = '$dtype';";
		$chquery = mysqli_query($conn, $checksql);
		if (mysqli_num_rows($chquery) == 0){
			$viewmysql = "INSERT INTO `Download` (`Download_object`, `Download_receiver`, `Download_giver`, `Download_type`) VALUES ('$object', '$receiver', '$giver', '$dtype');";
			mysqli_query($conn, $viewmysql);
			$checksql2 = "SELECT `Download_object` FROM `Download` WHERE `Download_object` = '$object' AND `Download_type` = '$dtype';";
			$numofviews = mysqli_num_rows(mysqli_query($conn, $checksql2));
			$storeviews = "UPDATE `Series` SET `Series_downloads` = '$numofviews' WHERE `Series_name` = '$object' AND `Series_season` = '$sse' AND `Series_episode` = '$sep'; ";
			mysqli_query($conn, $storeviews);
		}
		$vid = $downloadrow['Series_path'];
		header("Location:../".$vid);
	}
?>