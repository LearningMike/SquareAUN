<?php
if (isset($_POST['Submit'])) {

	include_once 'connect.php';

	// Remove SQL Injection
	$name = mysqli_real_escape_string($conn, $_POST['Name']);
	$email = mysqli_real_escape_string($conn, $_POST['Email']);
	$pcode = mysqli_real_escape_string($conn, $_POST['Pcode']);

	// Check if Empty or too Long
	if (empty($name) || empty($email) || empty($pcode) || strlen($name)>14 || strlen($pcode)>14) {
		header("Location: ../Square/signup.php?signup=emptyormax");
		exit();
	} else {
		// Check if input characters are valid.
		if (strpos($name,"?")!==false || strpos($name,"/")!==false || strpos($name,"<")!==false || strpos($name,">")!==false || strpos($name,",")!==false || strpos($name,".")!==false || strpos($name,":")!==false || strpos($name,";")!==false || strpos($name,"'")!==false || strpos($name,"@")!==false || strpos($name,"~")!==false || strpos($name,"#")!==false || strpos($name,"{")!==false || strpos($name,"}")!==false || strpos($name,"[")!==false || strpos($name,"]")!==false || strpos($name,"=")!==false || strpos($name,"+")!==false || strpos($name,"-")!==false || strpos($name,"(")!==false || strpos($name,")")!==false || strpos($name,"*")!==false || strpos($name,"&")!==false || strpos($name,"^")!==false || strpos($name,"%")!==false || strpos($name,"$")!==false || strpos($name,'"')!==false || strpos($name,"£")!==false || strpos($name,"!")!==false || strpos($name,"|")!==false || strpos($name,"¬")!==false || strpos($name,"`")!==false) {
			header("Location: ../Square/signup.php?signup=invalid");
			exit();
		} else {
			// Check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, "@aun.edu.ng")==false ) {
				header("Location: ../Square/signup.php?signup=emailerror");
				exit();
			} else {
				// Check if Username is available
				$checknamequery = "SELECT UserInfo_name FROM UserInfo WHERE UserInfo_name='$name';";
				$checkname=mysqli_query($conn, $checknamequery);
				if (mysqli_num_rows($checkname) > 0) {
					header("Location: ../Square/signup.php?signup=samename");
					exit();
				} else {
					// Check if password has injections
					if (strpos($pcode,"?")!==false || strpos($pcode,"/")!==false || strpos($pcode,"<")!==false || strpos($pcode,">")!==false || strpos($pcode,",")!==false || strpos($pcode,".")!==false || strpos($pcode,":")!==false || strpos($pcode,";")!==false || strpos($pcode,"'")!==false || strpos($pcode,"@")!==false || strpos($pcode,"~")!==false || strpos($pcode,"#")!==false || strpos($pcode,"{")!==false || strpos($pcode,"}")!==false || strpos($pcode,"[")!==false || strpos($pcode,"]")!==false || strpos($pcode,"=")!==false || strpos($pcode,"+")!==false || strpos($pcode,"-")!==false || strpos($pcode,"(")!==false || strpos($pcode,")")!==false || strpos($pcode,"*")!==false || strpos($pcode,"&")!==false || strpos($pcode,"^")!==false || strpos($pcode,"%")!==false || strpos($pcode,"$")!==false || strpos($pcode,'"')!==false || strpos($pcode,"£")!==false || strpos($pcode,"!")!==false || strpos($pcode,"|")!==false || strpos($pcode,"¬")!==false || strpos($pcode,"`")!==false) {
							header("Location: ../Square/signup.php?signup=pwderror");
							exit();
					} else {
						// Send Mail
						$mailto = '$email';
						$mailsubject = 'Square';
						$mailbody = 'Welcome to Square.'."<br/><br/>".'Username: '."$name"."<br/>".'Password: '."$pcode"."<br/><br/>".'If you did not sign-up to Square, please report immediately.';
						$mailheader = 'From: Square <anemail@aun.edu.ng>';
						mail($mailto, $mailsubject, $mailbody, $mailheader); 
						//Hash password
						$pcode = password_hash($pcode, PASSWORD_DEFAULT);
						// Sign In
						$signuser = "INSERT INTO `UserInfo` (`UserInfo_name`, `UserInfo_email`, `UserInfo_pcode`) VALUES ('$name', '$email', '$pcode');";
						mysqli_query($conn, $signuser);
						header("Location: ../Square/login.php");
						exit();
					}
				}
			}
		}
	}

} else {
	header("Location: ../Square/signup.php");
	exit();
}
?>