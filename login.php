<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login | Square</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Michael Anthony Abia">
		<link rel="icon" href="favicon.ico" type="image/ico">
		<link rel="stylesheet" type="text/css" href="Style.css">
		<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
		<script type="text/javascript">
			function postcheck(){
				var notif = document.getElementById("notif");
				var name = document.getElementById("Name");
				var pcode = document.getElementById("Pcode");
				if (name.value==""){
					notif.innerHTML="empty fields will not be accepted";
				}else{
					if (name.value.match(/[_\W]/)||pcode.value.match(/[_\W]/)){
						notif.innerHTML="special characters are not allowed";
					}else if (name.value.length>14){
						notif.innerHTML="maximum value exceeded"
					}else {	
						notif.innerHTML="";
					}
				}
			}
			function modalcheck(){
				if(window.location == 'http://localhost/Square/login.php?login=emptyormax'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>There was no input or<br/> Input length must be 1-14 characters <br/>.";
				}else if (window.location == 'http://localhost/Square/login.php?login=invalid'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Username must not contain any special character<br/>.";
				}else if (window.location == 'http://localhost/Square/login.php?login=pwderror'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>The password must not contain any special character <br/>.";
				}else if (window.location == 'http://localhost/Square/login.php?login=noname'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Username does not exist<br/>.";
				}else if (window.location == 'http://localhost/Square/login.php?login=wrongpwd'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This password is incorrect<br/>Check your email for the correct Username and Password<br/>.";
				}else if (window.location == 'http://localhost/Square/login.php?login=wrongname'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Username is incorrect<br/>Check your email for the correct Username and Password<br/>.";
				}else{
					document.getElementById("error").style.display = "none";
				}
			}
			function modalclose(){
				document.getElementById("error").style.display = "none";
			}
		</script>
	<?php
		include_once 'connect.php';

		session_start();
		if (isset($_SESSION['username'])){
			header("Location: ../Square/home.php");
			exit();
		}
	?>
	</head>
	<body onload="modalcheck()">
		<div id="error" class="err">
			<div class="errr">
				<div class="errhead">
					<b>User Error!!!</b>
					<a onclick="modalclose()"><button class="xbutton">&times;</button></a>
				</div>
				<div id="errmessage"></div>
			</div>
		</div>
		<section class="b1">
			<h1>Square</h1>
			<p>
				<br/>
				<form id="loginbox" action="logincheck.php" method="post">
					<input type="textarea" id="Name" placeholder="Username" name="Name" autocomplete="off" maxlength="14" minlength="3" /><br/><br/>
					<input type="password" id="Pcode" placeholder="Password" name="Pcode" onfocus="postcheck()" autocomplete="off" maxlength="14" minlength="4" /><br/><br/>
					<div id="notif"></div><br/>
					<input id="button" type="submit" value="Login" name="Submit"/><br/><br/>
				</form>
				<br/>
				<p align="center">Don't have an account?<br/><br/>
					<a href="signup.php"><button id="button">Sign-Up</button></a>
				</p>
				<br/>
			</p>
		</section>
	</body>
</html>