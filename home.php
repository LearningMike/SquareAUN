<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Files | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="Style2.css">
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
				// Do Nothing
			}else{
				header("Location: ../Square/login.php");
				exit();
			}
		?>
	</head>
	<body>
		<?php include_once 'headtab.php'; ?><br/>
		<section class="homecontent">
			<br/><br/><br/>
			<table border="0" cellspacing="8">
				<tr>
					<td id="black">
						<a style="color: #00FF00; opacity: 1;" href="Videos.php">
							<b style="font-size: 20px;">Videos</b><br/><br/>
							<?php
								$videosql="SELECT `Video_name` FROM `Video` ORDER BY `Video_id` DESC LIMIT 3;";
								$videoresult= mysqli_query($conn, $videosql);
								$videoqueryresults = mysqli_num_rows($videoresult);
								if ($videoqueryresults > 0) {
									while ($videorow = mysqli_fetch_assoc($videoresult)) {
										echo "+ ".$videorow['Video_name']."<br/>";
									}
								}
							?>
						</a>
					</td>
					<td id="green">
						<a style="color: #000000; opacity: 1;" href="Series.php">
							<b style="font-size: 20px;">Series</b><br/><br/>
							<?php
								$seriessql="SELECT `Series_name`, `Series_season`, `Series_episode` FROM `Series` ORDER BY `Series_id` DESC LIMIT 3 ;";
								$seriesresult= mysqli_query($conn, $seriessql);
								$seriesqueryresults = mysqli_num_rows($seriesresult);
								if ($seriesqueryresults > 0) {
									while ($seriesrow = mysqli_fetch_assoc($seriesresult)) {
										echo "+ ".$seriesrow['Series_name']." ".$seriesrow['Series_season'].$seriesrow['Series_episode']."<br/>";
									}
								}
							?>
						</a>
					</td>
				</tr>
				<tr>
					<td id="green">
						<a style="color: #000000; opacity: 1;" href="gggg.php">
							<b style="font-size: 20px;">Pictures</b><br/><br/>
							+ Batman Dark World<br/>
							+ Naruto Ultimate Storm<br/>
							+ Rihanna 2018<br/>
						</a>
					</td>
					<td id="black">
						<a style="color: #00FF00; opacity: 1;" href="Music.php">
							<b style="font-size: 20px;">Music</b><br/><br/>
							<?php
								$songsql="SELECT `Music_name`, `Music_artist` FROM `Music` ORDER BY `Music_id` DESC LIMIT 3 ;";
								$songresult= mysqli_query($conn, $songsql);
								$songqueryresults = mysqli_num_rows($songresult);
								if ($songqueryresults > 0) {
									while ($songrow = mysqli_fetch_assoc($songresult)) {
										echo "+ ".$songrow['Music_name']." - ".$songrow['Music_artist']."<br/>";
									}
								}
							?>
						</a>
					</td>
				</tr>
				<tr>
					<td id="black">
						<a style="color: #00FF00; opacity: 1;" href="gggg.php">
							<b style="font-size: 20px;">Documents</b><br/><br/>
							+ History of Africa, Shillington<br/>
							+ PHP, MySQL and JavaScript.<br/>
							+ Before you sleep by Ifeoma<br/>
						</a>
					</td>
					<td id="green">
						<a style="color: #000000; opacity: 1;" href="gggg.php">
							<b style="font-size: 20px;">Applications</b><br/><br/>
							+ Plagiarism Checker X<br/>
							+ Internet Download Manager(IDM) Crack<br/>
							+ Sublime Text 4<br/>
						</a>
					</td>
				</tr>
			</table>
		</section>
	</body>
</html>