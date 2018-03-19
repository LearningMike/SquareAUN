<section id="headtab" align="center">
	<span id="lname">
		<a href="home.php"><button id="homelink">Square</button></a>
	</span>
	<span id="uname">
		<a href="myprofile.php"><button id="profile"><?php echo $_SESSION['username']; ?></button></a>
	</span>
	<span id="others">
		<a href="" id="hdt"><img src="notifpic.png" height="32" width="32"></a>
		<a href="" id="hdt"><img src="chatpic.png" height="32" width="32"></a>
		<div class="dropdown">
  			<button class="dropbtn" onclick="myFunction()" >≡
  			</button>
  			<div id="myDropdown" class="dropdown-content">
    			<a href="upload.php" >Upload</a>
    			<a href="#">People</a>
    			<a href="#">Settings</a>
    			<a href="logout.php" ><button id="logout">Logout</button></a>
  			</div>
		</span>
	</span>
</section>