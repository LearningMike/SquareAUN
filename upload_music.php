<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Upload Music | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Michael Abia, Jesse Tyohom">
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
				if(window.location == 'http://localhost/Square/upload_music.php?upload=failed'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Audio failed to Upload<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_music.php?upload=toolarge'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Audio size is too large<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_music.php?upload=error'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>There was an error uploading<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_music.php?upload=wrongtype'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Audio type is not supported<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_music.php?upload=emptyorminormax'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>The Audio title must be between 2-50 characters<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_music.php?upload=invalidname'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>The Audio title should not contain any special characters<br/>.";
				}else if (window.location == 'http://localhost/Square/upload_music.php?upload=sameaudioname'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Audio name is already available<br/>.";
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
					<a href="upload_music.php"><button class="xbutton">&times;</button></a>
				</div>
				<div id="errmessage"></div>
			</div>
		</div>
		<br/><br/><br/><br/>
		<h2 style="color: #000000; font-size: 22px; text-align: center;">Music</h2>
		<h6 style="color: #000000; font-size: 18px; text-align: center;"><em>Upload Music, Audio and any sound files....</em></h6>
		<br/><br/>
		<form id="form" action="upload_musiccheck.php" method="POST" enctype="multipart/form-data">
			<input id="name" type="textarea" name="name" placeholder="Song Title" maxlength="50" autocomplete="off" style="width: 186px;"><br/><br/>
			<input id= "artist" type="textarea" name="artist" placeholder="Artist" maxlength="30" autocomplete="off" >
			<input id= "album" type="textarea" name="album" placeholder="Album" maxlength="30" autocomplete="off" ><br/><br/>
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