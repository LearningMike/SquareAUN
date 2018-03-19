	<?php
		$dbservername="localhost";
		$dbusername="root";
		$dbpassword="";
		$dbname="SquareDB";

		$conn=mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname) or die (mysqli_error());
	?>