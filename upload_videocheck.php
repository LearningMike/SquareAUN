<?php
	include_once 'connect.php';
	session_start();
	if (isset($_SESSION['username'])){
		if (isset($_POST['submit'])) {
			// Remove SQL Injection
			$videoname = mysqli_real_escape_string($conn, $_POST['name']);
			$postedby = $_SESSION['username'];

			// Check if Empty or too Long
			if (empty($videoname) || strlen($videoname)<2 || strlen($videoname)>52) {
				header("Location: ../Square/upload_video.php?upload=emptyorminormax");
				exit();
			} else {
				if (strpos($videoname,"?")!==false || strpos($videoname,"/")!==false || strpos($videoname,"<")!==false || strpos($videoname,">")!==false || strpos($videoname,",")!==false || strpos($videoname,".")!==false || strpos($videoname,":")!==false || strpos($videoname,";")!==false || strpos($videoname,"'")!==false || strpos($videoname,"@")!==false || strpos($videoname,"~")!==false || strpos($videoname,"{")!==false || strpos($videoname,"}")!==false || strpos($videoname,"[")!==false || strpos($videoname,"]")!==false || strpos($videoname,"=")!==false || strpos($videoname,"+")!==false || strpos($videoname,"(")!==false || strpos($videoname,")")!==false || strpos($videoname,"*")!==false || strpos($videoname,"&")!==false || strpos($videoname,"^")!==false || strpos($videoname,"%")!==false || strpos($videoname,"$")!==false || strpos($videoname,'"')!==false || strpos($videoname,"£")!==false || strpos($videoname,"!")!==false || strpos($videoname,"|")!==false || strpos($videoname,"¬")!==false || strpos($videoname,"`")!==false) {
					header("Location: ../Square/upload_video.php?upload=invalidname");
					exit();
				} else {
					$checknamequery = "SELECT `Video_name` FROM `Video` WHERE `Video_name`='$videoname';";
					$checkname=mysqli_query($conn, $checknamequery);
					if (mysqli_num_rows($checkname) > 0) {
						header("Location: ../Square/upload_video.php?upload=samevideoname");
						exit();
					} else {
						$videotype = $_POST['type'];
						//file
						$file = $_FILES['file'];
						$filename = $_FILES['file']['name'];
						$fileTmpname = $_FILES['file']['tmp_name'];
						$fileSize = $_FILES['file']['size'];
						$fileerror = $_FILES['file']['error'];
						$fileType = $_FILES['file']['type'];

						if ($fileType == "video/mp4" || $fileType == "video/mkv" || $fileType == "video/mpeg4" || $fileType == "video/x-matroska" ) {
							$fileExt = explode('.', $filename);
							$fileActualExt = strtolower(end($fileExt));
						}
						$allowed = array('mp4', 'mkv', 'mpeg4', 'x-matroska');

						if (in_array($fileActualExt, $allowed)) {
							if ($fileerror === 0) {
								if ($fileSize < 2000000000) {
									$time = time();
									$videopath=$videoname.".".$fileActualExt;
									$filedestination ='videos/'.$videopath;
									if (move_uploaded_file($fileTmpname, $filedestination)){
										$uploadsql = "INSERT INTO `Video` (`Video_name`, `Video_size`, `Video_path`, `Video_type`, `Video_postdate`, `Video_postedby`) VALUES ('$videoname', '$fileSize', '$filedestination', '$videotype', '$time', '$postedby');";
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
										header("Location: ../Square/upload_video.php?upload=failed");
									}
								} else {
									header("Location: ../Square/upload_video.php?upload=toolarge");
								}
							} else {
								header("Location: ../Square/upload_video.php?upload=error");
							}
						} else {
							header("Location: ../Square/upload_video.php?upload=wrongtype");
						}
					}	
				}
			}
		}
	}
?>