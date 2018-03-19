<?php
	include_once 'connect.php';
	session_start();
	if (isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$avatarname = $_SESSION['username']."avatar";
		if (isset($_POST['submit'])) {
			$file = $_FILES['file'];

			$filename = $_FILES['file']['name'];
			$fileTmpname = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileerror = $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];

			if ($fileType == "image/png" || $fileType == "image/jpg" || $fileType == "image/jpeg" || $fileType == "image/gif" ) {
				$fileExt = explode('.', $filename);
				$fileActualExt = strtolower(end($fileExt));
			}
			$allowed = array('jpg', 'jpeg', 'png', 'gif');

			if (in_array($fileActualExt, $allowed)) {
				if ($fileerror === 0) {
					if ($fileSize < 20000000) {
						$avatarnamep=$avatarname.".".$fileActualExt;
						$filedestination ='avatars/'.$avatarnamep;
						if (move_uploaded_file($fileTmpname, $filedestination)){
							$uploadsql = "UPDATE `UserInfo` SET `UserInfo_avatar` = '$filedestination' WHERE `UserInfo_name`='$username';";
							if (mysqli_query($conn, $uploadsql)){
								header("Location: ../Square/upload.php");
							}
						} else {
							header("Location: ../Square/upload_avatar.php?upload=failed");
						}
					} else {
						header("Location: ../Square/upload_avatar.php?upload=toolarge");
					}
				} else {
					header("Location: ../Square/upload_avatar.php?upload=error");
				}
			} else {
				header("Location: ../Square/upload_avatar.php?upload=wrongtype");
			}
		}	
	}
?>