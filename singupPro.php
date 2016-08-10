<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>
	<?php
		// insert into user.user
		include 'dbConnected.php';
		$passwordsignup = $_POST['passwordsignup'];
		$namesignup = $_POST['namesignup'];
		$emailsignup = $_POST['emailsignup'];
		$numberPhone = $_POST['numberPhone'];
		$sql = "INSERT INTO user (mail, password, name, numberPhone, email_sent) VALUES ('$emailsignup','$passwordsignup','$namesignup','+62$numberPhone', 'N')";
		$result = $conn->query($sql);

		// insert into radius.radcheck
		$conn = mysqli_connect("localhost", "root", "L*hlXjs1", "radius");
		$sql = "INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`) VALUES (NULL, '$emailsignup', 'User-Password', '==', '$passwordsignup')";
		$result = $conn->query($sql);

		// set the localStorage 
		$email = "<script>document.write(localStorage.getItem('email'));</script>";
		$password = "<script type='text/javascript'>document.write(localStorage.getItem('password'));</script>";

		// check the email status
		$conn = mysqli_connect("localhost", "root", "L*hlXjs1", "user");
		$sql = "SELECT email_sent FROM user";
		$result = $conn->query($sql);

		if ($result == "Y" || $result == "y") {
			echo "<script>alert('Email sudah dikirimkan sebelumnya')</script>";
		}
	?>

	<script>
		window.location.href = "http://localhost/test-hotspot/index.html";
	</script>
</body>
</html>