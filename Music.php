<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Music | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Michael Abia, Jesse Tyohom">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="Style4.css">
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
				// Do Nothing ;
			}else{
				header("Location: ../Square/login.php");
				exit();
			}
		?>
	</head>
	<body>
		<?php include_once 'headtab.php' ?>
		<br/><br/>
		<?php
		if (isset($_GET['search']) && !empty($_GET['search'])){
			$_SESSION['search'] = $_GET['search'];
		} else{
			$_SESSION['search'] = "";
		}
		?>
		<form id="searchbar" action="Music.php" method="get">
			<input id="go" type="search" name="search" placeholder=" Search" value="<?php if (isset($_SESSION['search'])){echo $_SESSION['search'];} ?>" maxlength="50">
			<input id="searchbtn" type="submit" name="submit" value="Go">
		</form>
		<?php
			if (isset($_GET['search'])){
				//search for submitted content
				$search = mysqli_real_escape_string($conn, $_GET['search']);
				$musicsql="SELECT * FROM `Music` WHERE `Music_name` LIKE '%$search%' OR `Music_album` LIKE '%$search%' OR `Music_artist` LIKE '%$search%' OR `Music_postedby` LIKE '%$search%' ORDER BY `Music_id` DESC LIMIT 15;";
				$musicresult= mysqli_query($conn, $musicsql);
				$musicqueryresults = mysqli_num_rows($musicresult);
				if ($musicqueryresults > 0) {
					while ($musicrow = mysqli_fetch_assoc($musicresult)) {

						// Get time difference
						$time = time();
						$actualtime= date('D, d M Y @ H:i:s', $time);
						$oldtime= date('D, d M Y @ H:i:s', $musicrow['Music_postdate']);
						$timedif = $time-$musicrow['Music_postdate'];
						if ($timedif<60) {
							if ($timedif==1){
								$timeunit = "second";
								$timedifs = $timedif;
							}else {
								$timeunit = "seconds";
								$timedifs = $timedif;
							}
						}else if ($timedif<(60*60)){
							if ($timedif<(1.5*60)){
								$timedifs = $timedif/60;
								$timeunit = "minute";
							}else {
								$timedifs = $timedif/60;
								$timeunit = "minutes";
							}
						}else if ($timedif<(60*60*24)){
							if ($timedif<(2*60*60)){
								$timedifs = $timedif/(60*60);
								$timeunit = "hour";
							}else {
								$timedifs = $timedif/(60*60);
								$timeunit = "hours";
							}
						}else if ($timedif<(60*60*24*7)){
							if ($timedif<(2*60*60*24)){
								$timedifs = $timedif/(60*60*24);
								$timeunit = "day";
							}else {
								$timedifs = $timedif/(60*60*24);
								$timeunit = "days";
							}
						}else if ($timedif<(60*60*24*7*4)){
							if ($timedif<(2*60*60*24*7)){
								$timedifs = $timedif/(60*60*24*7);
								$timeunit = "week";
							}else {
								$timedifs = $timedif/(60*60*24*7);
								$timeunit = "weeks";
							}
						}else if ($timedif<(60*60*24*7*4*12)){
							if ($timedif<(2*60*60*24*7*4)){
								$timedifs = $timedif/(60*60*24*7*4);
								$timeunit = "month";
							}else {
								$timedifs = $timedif/(60*60*24*7*4);
								$timeunit = "months";
							}
						}else if ($timedif<(60*60*24*7*4*12*10)){
							if ($timedif<(2*60*60*24*7*4*12)){
								$timedifs = $timedif/(60*60*24*7*4*12);
								$timeunit = "year";
							}else {
								$timedifs = $timedif/(60*60*24*7*4*12);
								$timeunit = "years";
							}
						}else {
							$timedifs="more than a";
							$timeunit="decade";
						}
						$timedifs = floor($timedifs);
						$finaltime = "$timedifs $timeunit ago"; 

						// Get the size value
						$size = $musicrow['Music_size'];
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

						echo "<form id='resultbox' method='GET' action='musicplayer.php'> <input name='music' type='textarea' value='".$musicrow['Music_path']."' hidden='on' /><input class='vdn' name='musicplayer' type='submit' value='".$musicrow['Music_name']."'/><br/>".$musicrow['Music_artist']."<br/>Posted by <span class='rpostee'>".$musicrow['Music_postedby']."</span><br/> ".$musicrow['Music_played']." views &nbsp; ".$musicrow['Music_downloads']." downloads <br/><span class='resultsize'>".$actualsizevalue." </span><span class='resulttime'>".$finaltime."</span>"."</form>";
					}
				} else {
					echo "<br/>"."  "." No results Found";
				}
			} else{
				$i=1;
				$musicsql="SELECT * FROM `Music` ORDER BY `Music_id` DESC LIMIT 15;";
				$musicresult= mysqli_query($conn, $musicsql);
				$musicqueryresults = mysqli_num_rows($musicresult);

				if ($musicqueryresults > 0) {
					while ($musicrow = mysqli_fetch_assoc($musicresult)) {

						// Get time difference
						$time = time();
						$timedif = $time-$musicrow['Music_postdate'];
						if ($timedif<60) {
							if ($timedif==1){
								$timeunit = "second";
								$timedifs = $timedif;
							}else {
								$timeunit = "seconds";
								$timedifs = $timedif;
							}
						}else if ($timedif<(60*60)){
							if ($timedif<(1.5*60)){
								$timedifs = $timedif/60;
								$timeunit = "minute";
							}else {
								$timedifs = $timedif/60;
								$timeunit = "minutes";
							}
						}else if ($timedif<(60*60*24)){
							if ($timedif<(2*60*60)){
								$timedifs = $timedif/(60*60);
								$timeunit = "hour";
							}else {
								$timedifs = $timedif/(60*60);
								$timeunit = "hours";
							}
						}else if ($timedif<(60*60*24*7)){
							if ($timedif<(2*60*60*24)){
								$timedifs = $timedif/(60*60*24);
								$timeunit = "day";
							}else {
								$timedifs = $timedif/(60*60*24);
								$timeunit = "days";
							}
						}else if ($timedif<(60*60*24*7*4)){
							if ($timedif<(2*60*60*24*7)){
								$timedifs = $timedif/(60*60*24*7);
								$timeunit = "week";
							}else {
								$timedifs = $timedif/(60*60*24*7);
								$timeunit = "weeks";
							}
						}else if ($timedif<(60*60*24*7*4*12)){
							if ($timedif<(2*60*60*24*7*4)){
								$timedifs = $timedif/(60*60*24*7*4);
								$timeunit = "month";
							}else {
								$timedifs = $timedif/(60*60*24*7*4);
								$timeunit = "months";
							}
						}else if ($timedif<(60*60*24*7*4*12*10)){
							if ($timedif<(2*60*60*24*7*4*12)){
								$timedifs = $timedif/(60*60*24*7*4*12);
								$timeunit = "year";
							}else {
								$timedifs = $timedif/(60*60*24*7*4*12);
								$timeunit = "years";
							}
						}else {
							$timedifs="more than a";
							$timeunit="decade";
						}
						$timedifs = floor($timedifs);
						$finaltime = "$timedifs $timeunit ago"; 

						// Get the size value
						$size = $musicrow['Music_size'];
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

						echo "<form id='resultbox' method='GET' action='musicplayer.php'> <input name='serie' type='textarea' value='".$musicrow['Music_path']."' hidden='on' /><input class='vdn' name='musicplayer' type='submit' value='".$musicrow['Music_name']."'/><br/>".$musicrow['Music_artist']."<br/>Posted by <span class='rpostee'>".$musicrow['Music_postedby']."</span><br/> ".$musicrow['Music_played']." views &nbsp; ".$musicrow['Music_downloads']." downloads <br/><span class='resultsize'>".$actualsizevalue." </span><span class='resulttime'>".$finaltime."</span>"."</form>";
					}
				}
			}
		?>
	</body>
</html>