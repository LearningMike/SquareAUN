<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Watch series | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Square video">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="watchstyle.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400, 600, 700, 800, 300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
		<script type="text/javascript">
			/* When the user clicks on the button, 
			toggle between hiding and showing the dropdown content */
			function myFunction() {
		  	 	document.getElementById("myDropdown").classList.toggle("show");
			}

			// Close the dropdown menu if the user clicks outside of it
			window.onclick = function(event) {
		 		if (!event.target.matches('.dropbtn')) {
					var dropdowns = document.getElementsByClassName("dropdown-content");
		    		var i;
		    		for (i = 0; i < dropdowns.length; i++) {
		    			var openDropdown = dropdowns[i];
		      			if (openDropdown.classList.contains('show')) {
		        			openDropdown.classList.remove('show');
		      			}
		    		}
		  		}
			}
		</script>
		<?php
			include_once 'connect.php';

			session_start();
			if (isset($_SESSION['username'])){

			}else{
				header("Location: ../Square/login.php");
				exit();
			}
		?>
	</head>
	<body>
		<?php include_once 'headtab.php'; ?><br/><br/>
		<?php
			if (isset($_GET['watch2'])){
				$seriepath = $_GET['serie'];
				$seriesql="SELECT * FROM `Series` WHERE `Series_path` = '$seriepath';";
				$serierow = mysqli_fetch_assoc(mysqli_query($conn, $seriesql));
				$uname = $serierow['Series_postedby'];
				$usql="SELECT * FROM `UserInfo` WHERE `UserInfo_name` = '$uname';";
				$urow = mysqli_fetch_assoc(mysqli_query($conn, $usql));
				$vid = $serierow['Series_path'];
			}
			// Get the size value
			$size = $serierow['Series_size'];
			if ($size < 1048576 ){
				$actualsize = $size/1024;
				$sizevalue = "KB";
			} else if ($size < 1073741824) {
				$actualsize = $size/1048576;
				$sizevalue = "MB";
			} else if ($size < 1099511627776) {
				$actualsize = $size/1073741824;
				$sizevalue = "GB";
			}
			$actualsize = round($actualsize, 2);
			$actualsizevalue = "$actualsize $sizevalue";

			$object = $serierow['Series_name'];
			$receiver = $serierow['Series_postedby'];
			$giver = $_SESSION['username'];
			$sep = $serierow['Series_episode'];
			$sse = $serierow['Series_season'];
			$stype = $sse.$sep;
			$checksql = "SELECT `View_object` FROM `View` WHERE `View_object` = '$object' AND `View_giver` = '$giver' AND `View_type` = '$stype';";
			$chquery = mysqli_query($conn, $checksql);
			if (mysqli_num_rows($chquery) < 1){
				$viewsql = "INSERT INTO `View` (`View_object`, `View_receiver`, `View_giver`, `View_type` ) VALUES ('$object', '$receiver', '$giver', '$stype');";
				mysqli_query($conn, $viewsql);
				$checksql2 = "SELECT `View_object` FROM `View` WHERE `View_object` = '$object' AND `View_type` = '$stype' ;";
				$numofviews = mysqli_num_rows(mysqli_query($conn, $checksql2));
				$storeviews = "UPDATE `Series` SET `Series_played` = '$numofviews' WHERE `Series_name` = '$object' AND `Series_episode` = '$sep' AND `Series_season` = '$sse'; ";
				mysqli_query($conn, $storeviews);
			}
		?>
		<div class="vidname"><?php echo $serierow['Series_name']; ?></div>
		<div class="watch">
			<video id="watch" controls="controls" width="760" height="420" preload="metadata" align="middle">
  				<source src="<?php echo $serierow['Series_path']; ?>" type="video/webm" />
  				<source src="<?php echo $serierow['Series_path']; ?>" type="video/mp4" />
  				<source src="<?php echo $serierow['Series_path']; ?>" type="video/mkv" />
  				<source src="<?php echo $serierow['Series_path']; ?>" type="video/x-matroska" />
  			</video>
  		</div>
  		<?php
  			echo "<div class='vidpoll'>".$serierow['Series_played']." Views &nbsp;&nbsp; ".$serierow['Series_downloads']." Downloads</div>";
  		?>
  		<div class="vdin" >
  			<?php
  				echo "<div class='poster'><div class='av'><img class='avt' src='".$urow['UserInfo_avatar']."'></div><div class='acn'>".$serierow['Series_postedby']."</div></div>";
  				echo "<div class='oth'>".$serierow['Series_season'].$serierow['Series_episode']."<br/>";
  				echo date('D, d M Y', $serierow['Series_postdate'])."<br/>";
  				echo $actualsizevalue."</div>";
  			?>
  		</div><br/>
  		<center>
  		<?php	
  			echo "<form method='post' action='series/downloadserie.php'><input type='textarea' name='seriename' value='".$serierow['Series_name']."' hidden='on'><input class='dnlb' type='submit' name='Download' value='Download'></form><br/><br/>";
  		?>
  		</center>
	</body>
</html>