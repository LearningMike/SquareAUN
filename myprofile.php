<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Profile | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Square video">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="style5.css">
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
			$uname = $_SESSION['username'];
			$usql = "SELECT * FROM `UserInfo` WHERE `UserInfo_name` = '$uname';";
			$urow = mysqli_fetch_assoc(mysqli_query($conn, $usql));
		?>
		<div class="pro">
			<div class="poster">
				<div class="av">
					<img class="avt" src="<?php echo $urow['UserInfo_avatar']; ?>">
				</div>
				<div class="acn">
					<?php echo $_SESSION['username']; ?>
					<div class="aci">
						<?php 
							echo $urow['UserInfo_email'];
							echo "<br/>";
							echo "19 followers <br/>";
							echo $urow['UserInfo_posts']." posts"
						?>
					</div>
				</div>
			</div>
			<div>
				
			</div>
		</div>
	</body>
</html>