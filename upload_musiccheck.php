<?php
	include_once 'connect.php';
	session_start();
	if (isset($_SESSION['username'])){
		if (isset($_POST['submit'])) {
			// Remove SQL Injection
			$songname = mysqli_real_escape_string($conn, $_POST['name']);
			$artist = $_POST['artist'];
			$album = $_POST['album'];
			$postedby = $_SESSION['username'];

			// Check if Empty or too Long
			if (empty($songname) || strlen($songname)<2 || strlen($songname)>52) {
				header("Location: ../Square/upload_music.php?upload=emptyorminormax");
				exit();
			} else {
				if (strpos($songname,"?")!==false || strpos($songname,"/")!==false || strpos($songname,"<")!==false || strpos($songname,">")!==false || strpos($songname,",")!==false || strpos($songname,".")!==false || strpos($songname,":")!==false || strpos($songname,";")!==false || strpos($songname,"'")!==false || strpos($songname,"@")!==false || strpos($songname,"~")!==false || strpos($songname,"#")!==false || strpos($songname,"{")!==false || strpos($songname,"}")!==false || strpos($songname,"[")!==false || strpos($songname,"]")!==false || strpos($songname,"=")!==false || strpos($songname,"+")!==false || strpos($songname,"(")!==false || strpos($songname,")")!==false || strpos($songname,"*")!==false || strpos($songname,"&")!==false || strpos($songname,"^")!==false || strpos($songname,"%")!==false || strpos($songname,"$")!==false || strpos($songname,'"')!==false || strpos($songname,"£")!==false || strpos($songname,"!")!==false || strpos($songname,"|")!==false || strpos($songname,"¬")!==false || strpos($songname,"`")!==false) {
					header("Location: ../Square/upload_music.php?upload=invalidname");
					exit();
				} else {
					$checknamequery = "SELECT `Music_name` FROM `Music` WHERE `Music_name`='$songname' AND `Music_album`='$album';";
					$checkname=mysqli_query($conn, $checknamequery);
					if (mysqli_num_rows($checkname) > 0) {
						header("Location: ../Square/upload_music.php?upload=sameaudioname");
						exit();
					} else {
						//file
						$file = $_FILES['file'];
						$filename = $_FILES['file']['name'];
						$fileTmpname = $_FILES['file']['tmp_name'];
						$fileSize = $_FILES['file']['size'];
						$fileerror = $_FILES['file']['error'];
						$fileType = $_FILES['file']['type'];

						if ($fileType == "audio/mp3" || $fileType == "audio/mpeg3" || $fileType == "audio/aac" || $fileType == "video/x-matroska" ) {
							$fileExt = explode('.', $filename);
							$fileActualExt = strtolower(end($fileExt));
						}
						$allowed = array('mp3', 'aac', 'mpeg3');

						if (in_array($fileActualExt, $allowed)) {
							if ($fileerror === 0) {
								if ($fileSize < 2000000000) {
									$time = time();
									$songpath= $songname." by ".$artist.".".$fileActualExt;
									$filedestination ='music/'.$songpath;
									if (move_uploaded_file($fileTmpname, $filedestination)){
										$uploadsql = "INSERT INTO `Music` (`Music_name`, `Music_album`, `Music_size`, `Music_path`, `Music_artist`, `Music_postdate`, `Music_postedby`) VALUES ('$songname', '$album', '$fileSize', '$filedestination', '$artist', '$time', '$postedby');";
										$usname = $_SESSION['username'];
										$postsql1 = "SELECT `UserInfo_posts` FROM `UserInfo` WHERE `UserInfo_name` = '$usname';";
										$postnum = mysqli_fetch_assoc(mysqli_query($conn, $postsql1));
										$postsnum = $postnum['UserInfo_posts']+1;
										$postsql2 = "UPDATE `UserInfo` SET `UserInfo_posts` = '$postsnum' WHERE `UserInfo_name` = '$usname'; ";
										if (mysqli_query($conn, $uploadsql)){
											mysqli_query($conn, $postsql2);
											header("Location: ../Square/upload.php");
										}
									} else {
										header("Location: ../Square/upload_music.php?upload=failed");
									}
								} else {
									header("Location: ../Square/upload_music.php?upload=toolarge");
								}
							} else {
								header("Location: ../Square/upload_music.php?upload=error");
							}
						} else {
							header("Location: ../Square/upload_music.php?upload=wrongtype");
						}
					}	
				}
			}
		}
	}
?>