<?php
	include_once 'connect.php';
	session_start();
	if (isset($_SESSION['username'])){
		if (isset($_POST['submit'])) {
			// Remove SQL Injection
			$seriesname = mysqli_real_escape_string($conn, $_POST['name']);
			$season = $_POST['season'];
			$episode = $_POST['episode'];
			$postedby = $_SESSION['username'];

			// Check if Empty or too Long
			if (empty($seriesname) || strlen($seriesname)<2 || strlen($seriesname)>52) {
				header("Location: ../Square/upload_series.php?upload=emptyorminormax");
				exit();
			} else {
				if (strpos($seriesname,"?")!==false || strpos($seriesname,"/")!==false || strpos($seriesname,"<")!==false || strpos($seriesname,">")!==false || strpos($seriesname,",")!==false || strpos($seriesname,".")!==false || strpos($seriesname,":")!==false || strpos($seriesname,";")!==false || strpos($seriesname,"'")!==false || strpos($seriesname,"@")!==false || strpos($seriesname,"~")!==false || strpos($seriesname,"#")!==false || strpos($seriesname,"{")!==false || strpos($seriesname,"}")!==false || strpos($seriesname,"[")!==false || strpos($seriesname,"]")!==false || strpos($seriesname,"=")!==false || strpos($seriesname,"+")!==false || strpos($seriesname,"(")!==false || strpos($seriesname,")")!==false || strpos($seriesname,"*")!==false || strpos($seriesname,"&")!==false || strpos($seriesname,"^")!==false || strpos($seriesname,"%")!==false || strpos($seriesname,"$")!==false || strpos($seriesname,'"')!==false || strpos($seriesname,"£")!==false || strpos($seriesname,"!")!==false || strpos($seriesname,"|")!==false || strpos($seriesname,"¬")!==false || strpos($seriesname,"`")!==false) {
					header("Location: ../Square/upload_series.php?upload=invalidname");
					exit();
				} else {
					$checknamequery = "SELECT `Series_name` FROM `Series` WHERE `Series_name`='$seriesname' AND `Series_episode`='$episode';";
					$checkname=mysqli_query($conn, $checknamequery);
					if (mysqli_num_rows($checkname) > 0) {
						header("Location: ../Square/upload_series.php?upload=sameseriesname");
						exit();
					} else {
						//file
						$file = $_FILES['file'];
						$filename = $_FILES['file']['name'];
						$fileTmpname = $_FILES['file']['tmp_name'];
						$fileSize = $_FILES['file']['size'];
						$fileerror = $_FILES['file']['error'];
						$fileType = $_FILES['file']['type'];

						if ($fileType == "video/mp4" || $fileType == "video/mpeg4" || $fileType == "video/mkv" || $fileType == "video/x-matroska" ) {
							$fileExt = explode('.', $filename);
							$fileActualExt = strtolower(end($fileExt));
						}
						$allowed = array('mp4', 'mkv', 'mpeg4');

						if (in_array($fileActualExt, $allowed)) {
							if ($fileerror === 0) {
								if ($fileSize < 2000000000) {
									$time = time();
									$seriespath= $seriesname." ".$season.$episode.".".$fileActualExt;
									$filedestination ='series/'.$seriespath;
									if (move_uploaded_file($fileTmpname, $filedestination)){
										$uploadsql = "INSERT INTO `Series` (`Series_name`, `Series_size`, `Series_path`, `Series_season`, `Series_episode`, `Series_postdate`, `Series_postedby`) VALUES ('$seriesname', '$fileSize', '$filedestination', '$season', '$episode', '$time', '$postedby');";
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
										header("Location: ../Square/upload_series.php?upload=failed");
									}
								} else {
									header("Location: ../Square/upload_series.php?upload=toolarge");
								}
							} else {
								header("Location: ../Square/upload_series.php?upload=error");
							}
						} else {
							header("Location: ../Square/upload_series.php?upload=wrongtype");
						}
					}	
				}
			}
		}
	}
?>