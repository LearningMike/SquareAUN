<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Upload Series | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Michael Anthony Abia">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="Style3.css">
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
			function triggerloader(){
				if(window.location == 'http://localhost/Square/upload_series.php'){
					document.getElementById("loader").style.display = "block";
				}
			}
			function modalcheck(){
				document.getElementById("loader").style.display = "none";
				if(window.location == 'http://localhost/Square/upload_series.php?upload=failed'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Series failed to Upload<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_series.php?upload=toolarge'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Series size is too large<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_series.php?upload=error'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>There was an error uploading<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_series.php?upload=wrongtype'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Series video type is not supported<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_series.php?upload=emptyorminormax'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>The Series title must be between 2-50 characters<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_series.php?upload=invalidname'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>The Series title should not contain any special characters<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_series.php?upload=sameseriesname'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Series Episode is already available<br/>.";
				}else{
					document.getElementById("error").style.display = "none";
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
	<body onload="modalcheck()">
		<?php include_once 'headtab.php'; ?>
		<div id="error" class="err">
			<div class="errr">
				<div class="errhead">
					<b style="background-color: #00FF00;">Upload Error!!!</b>
					<a href="upload_series.php"><button class="xbutton">&times;</button></a>
				</div>
				<div id="errmessage"></div>
			</div>
		</div>
		<br/><br/><br/><br/>
		<h2 style="color: #000000; font-size: 22px; text-align: center;">Series</h2>
		<h6 style="color: #000000; font-size: 18px; text-align: center;"><em>Upload TV Series, Tutorials, Anime....</em></h6>
		<br/><br/>
		<form id="form" action="upload_seriescheck.php" method="POST" enctype="multipart/form-data">
			<input id="name" type="textarea" name="name" placeholder="Series Title" maxlength="50" autocomplete="off" style="width: 186px;"><br/><br/>
			<select id= "season" name="season">
				<option value="S01" selected>Season 01</option>
				<option value="S02">Season 02</option>
				<option value="S03">Season 03</option>
				<option value="S04">Season 04</option>
				<option value="S05">Season 05</option>
				<option value="S06">Season 06</option>
				<option value="S07">Season 07</option>
				<option value="S08">Season 08</option>
				<option value="S09">Season 09</option>
				<option value="S10">Season 10</option>
				<option value="S11">Season 11</option>
				<option value="S12">Season 12</option>
				<option value="S13">Season 13</option>
				<option value="S14">Season 14</option>
				<option value="S15">Season 15</option>
			</select>
			<select id= "episode" name="episode">
				<option value="E01" selected>Episode 01</option>
				<option value="E02">Episode 02</option>
				<option value="E03">Episode 03</option>
				<option value="E04">Episode 04</option>
				<option value="E05">Episode 05</option>
				<option value="E06">Episode 06</option>
				<option value="E07">Episode 07</option>
				<option value="E08">Episode 08</option>
				<option value="E09">Episode 09</option>
				<option value="E10">Episode 10</option>
				<option value="E11">Episode 11</option>
				<option value="E12">Episode 12</option>
				<option value="E13">Episode 13</option>
				<option value="E14">Episode 14</option>
				<option value="E15">Episode 15</option>
				<option value="E16">Episode 16</option>
				<option value="E17">Episode 17</option>
				<option value="E18">Episode 18</option>
				<option value="E19">Episode 19</option>
				<option value="E20">Episode 20</option>
				<option value="E21">Episode 21</option>
				<option value="E22">Episode 22</option>
				<option value="E23">Episode 23</option>
				<option value="E24">Episode 24</option>
				<option value="E25">Episode 25</option>
			</select><br/><br/>
			<input id="file" type="file" name="file" autocomplete="off"><br/><br/><br/>
			<input id="button" type="submit" name="submit" value="Upload" onclick="triggerloader()">
		</form>
		<br/><br/>
		<div id="loader">
			<span class="pmest">Please wait...</span><br/>
			<div id="spinner1" class="spinner1"></div>
			<div id="spinner2" class="spinner2"></div>
			<span class="pmesb">Do not leave this page !!!</span>
		</div>
	</body>
</html>