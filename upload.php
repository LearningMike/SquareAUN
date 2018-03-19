<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Upload | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Michael Anthony Abia">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="Style2.css">
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
		<br/><br/><br/><br/><br/>
		<p align="center">
			<a href="upload_avatar.php"><button id="button">Avatar</button></a><br/><br/>
			<a href="upload_video.php"><button id="button">Video</button></a><br/><br/>
			<a href="upload_series.php"><button id="button">Series</button></a><br/><br/>
			<a href=""><button id="button">Music</button></a><br/><br/>
			<a href=""><button id="button">Picture</button></a><br/><br/>
			<a href=""><button id="button">Document</button></a><br/><br/>
			<a href=""><button id="button">Application</button></a><br/>
		</p>
	</body>
</html>