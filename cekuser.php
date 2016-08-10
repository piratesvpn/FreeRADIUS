<?php
$conn = mysqli_connect("localhost", "root", "L*hlXjs1");
$select_db = mysqli_select_db($conn, "user");

$email = (isset($_POST['emailsignup']) ? $_POST['emailsignup'] : null);
$query = mysqli_query($conn, "SELECT * FROM user WHERE mail='$email'");
$num_rows = mysqli_num_rows($query);

if ($email == null) {
	echo "Silahkan masukkan email Anda";
} else {
	if ($num_rows == 0) {
		echo "Email dapat digunakan";
	} else if ($num_rows == 1) {
		echo "Email sudah digunakan coba yang lain!";
	}
}
?>