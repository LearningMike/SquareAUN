<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sign-Up | Square</title>
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
				var agree = document.getElementById("agree");
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
				agree.checked = false;
			}
			function mailcheck(){
				var email = document.getElementById("Email");
				var agree = document.getElementById("agree");
				if (email.value.match("@aun.edu.ng")){
				}else{notif.innerHTML="email must end with @aun.edu.ng";}
				agree.checked = false;
			}
			function modalcheck(){
				if(window.location == 'http://localhost/Square/signup.php?signup=emptyormax'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>There was no input or<br/> Input length must be 1-14 characters <br/>.";
				}else if (window.location == 'http://localhost/Square/signup.php?signup=invalid'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Username must not contain any special character<br/>.";
				}else if (window.location == 'http://localhost/Square/signup.php?signup=emailerror'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Only AUN emails are allowed on this website<br/>.";
				}else if (window.location == 'http://localhost/Square/signup.php?signup=samename'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>This Username already exists<br/>.";
				}else if (window.location == 'http://localhost/Square/signup.php?signup=pwderror'){
					document.getElementById("error").style.display = "block";
					document.getElementById("errmessage").innerHTML="<br/>Password must not contain any special character<br/>.";
				}else{
					document.getElementById("error").style.display = "none";
				}
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
					<b style="background-color: #00FF00;">User Error!!!</b>
					<a href="signup.php"><button class="xbutton">&times;</button></a>
				</div>
				<div id="errmessage"></div>
			</div>
		</div>
		<section class="b1">
			<h1>Square</h1>
			<p>
				<br/>
				<form id="loginbox" action="signupcheck.php" method="post">
					<input type="textarea" id="Name" placeholder="Username" name="Name" autocomplete="off" maxlength="14" /><br/><br/>
					<input type="email" id="Email" placeholder="Email" name="Email" onfocus="postcheck()" autocomplete="off" maxlength="34" /><br/><br/>
					<input type="password" id="Pcode" placeholder="Password" name="Pcode" onfocus="mailcheck()" onblur="postcheck()" autocomplete="off" maxlength="14" /><br/><br/>
					I agree to the <a href="">terms and conditions</a> &nbsp;<input type="checkbox" id ="agree" name="Agree" value="Agree"><br/>
					<span id="notif"></span><br/>
					<input id="button" type="submit" value="Sign-Up" name="Submit"/><br/><br/>
				</form>
			</p>
		</section>
	</body>
</html>