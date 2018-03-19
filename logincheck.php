<?php

if (isset($_POST['Submit'])) {

	include_once 'connect.php';


	// Remove SQL Injection
	$name = mysqli_real_escape_string($conn, $_POST['Name']);
	$pcode = mysqli_real_escape_string($conn, $_POST['Pcode']);

	// Check if Empty or too Long
	if (empty($name) || empty($pcode) || $name>14 || $pcode>14 ) {
		header("Location: ../Square/login.php?login=emptyormax");
		exit();
	} else {
		// Check if input characters are valid.
		if (strpos($name,"?")!==false || strpos($name,"/")!==false || strpos($name,"<")!==false || strpos($name,">")!==false || strpos($name,",")!==false || strpos($name,".")!==false || strpos($name,":")!==false || strpos($name,";")!==false || strpos($name,"'")!==false || strpos($name,"@")!==false || strpos($name,"~")!==false || strpos($name,"#")!==false || strpos($name,"{")!==false || strpos($name,"}")!==false || strpos($name,"[")!==false || strpos($name,"]")!==false || strpos($name,"=")!==false || strpos($name,"+")!==false || strpos($name,"-")!==false || strpos($name,"(")!==false || strpos($name,")")!==false || strpos($name,"*")!==false || strpos($name,"&")!==false || strpos($name,"^")!==false || strpos($name,"%")!==false || strpos($name,"$")!==false || strpos($name,'"')!==false || strpos($name,"£")!==false || strpos($name,"!")!==false || strpos($name,"|")!==false || strpos($name,"¬")!==false || strpos($name,"`")!==false) {
			header("Location: ../Square/login.php?login=invalid");
			exit();
		}else {
			// Check if Username is available
			$checknamequery = "SELECT UserInfo_name FROM UserInfo WHERE UserInfo_name='$name';";
			$checkname=mysqli_query($conn, $checknamequery);
			if (mysqli_num_rows($checkname) == 0) {
				header("Location: ../Square/login.php?login=noname");
				exit();
			}else {
				// Check if password has injections
				if (strpos($pcode,"?")!==false || strpos($pcode,"/")!==false || strpos($pcode,"<")!==false || strpos($pcode,">")!==false || strpos($pcode,",")!==false || strpos($pcode,".")!==false || strpos($pcode,":")!==false || strpos($pcode,";")!==false || strpos($pcode,"'")!==false || strpos($pcode,"@")!==false || strpos($pcode,"~")!==false || strpos($pcode,"#")!==false || strpos($pcode,"{")!==false || strpos($pcode,"}")!==false || strpos($pcode,"[")!==false || strpos($pcode,"]")!==false || strpos($pcode,"=")!==false || strpos($pcode,"+")!==false || strpos($pcode,"-")!==false || strpos($pcode,"(")!==false || strpos($pcode,")")!==false || strpos($pcode,"*")!==false || strpos($pcode,"&")!==false || strpos($pcode,"^")!==false || strpos($pcode,"%")!==false || strpos($pcode,"$")!==false || strpos($pcode,'"')!==false || strpos($pcode,"£")!==false || strpos($pcode,"!")!==false || strpos($pcode,"|")!==false || strpos($pcode,"¬")!==false || strpos($pcode,"`")!==false) {
					header("Location: ../Square/login.php?login=pwderror");
					exit();
				}else {
					// Check if password is correct
					$checkpwdquery = "SELECT * FROM UserInfo WHERE UserInfo_name='$name';";
					$checkpwd=mysqli_query($conn, $checkpwdquery);
					if (mysqli_num_rows($checkpwd) == 0){
						header("Location: ../Square/login.php?login=wrongname");
						exit();
					}else {
						if ($row = mysqli_fetch_assoc($checkpwd)){
							$time = time();
							$actualtime = date('D, d M Y @ H:i:s', $time);
							// De-hash password
							$hpcodecheck=password_verify($pcode, $row['UserInfo_pcode']);
							if ($hpcodecheck==true){
								// Log In
								session_start();
								$_SESSION['username']=$name;
								$_SESSION['password']=$pcode;
								$_SESSION['logtime']=$actualtime;
								$logsql = "UPDATE `UserInfo` SET `UserInfo_lastlog` = '$actualtime' WHERE `UserInfo_name`='$name';";
								if (mysqli_query($conn, $logsql)){
									header("Location: ../Square/home.php");
									exit();
								}		
							}else{
								header("Location: ../Square/login.php?login=wrongpwd");
								exit();
							}
						}
					}
				}
			}
		}
	}
}else {
	header("Location: ../Square/login.php");
	exit();
}
?>