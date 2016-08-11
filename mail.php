<!DOCTYPE html>
<html>
<head>
	<title>Indikator Pemakaian</title>
	<script type='text/javascript' src='jquery-2.2.4.min.js'></script>
</head>
<body>
	<?php
	require "PHPMailer/PHPMailerAutoload.php";
	$mail = new PHPMailer;
	$email = $_REQUEST["xeuXG7cR6N98R502sFUB"];

	// retrieve username and password 
	$conn = mysqli_connect("localhost", "root", "tidakada", "user");
	$sql = "SELECT mail, password, email_sent FROM user WHERE mail = '$email'";
	$result = mysqli_query($conn, $sql);

	// set variable of email and password
	$status = '';
	$email_sent = '';
	$password_sent = '';
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$email_sent = $row["mail"];
			$password_sent = $row["password"];
			$status = $row["email_sent"];
		}
	}

	// checking the email status 
	if ($status == "N" || $status == "n") {
		// update the email_sent row value
		$sql = "UPDATE user SET email_sent = 'Y' WHERE mail = '$email_sent'";
		$result = mysqli_query($conn, $sql);

		$mail->isSMTP();                                      			// Set mailer to use SMTP
		$mail->Host = "smtp.gmail.com";  								// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               			// Enable SMTP authentication
		$mail->Username = "hotmannp2@gmail.com";						// SMTP username
		$mail->Password = "editor13";                           		// SMTP password
		$mail->SMTPSecure = "ssl";                           			// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                   			// TCP port to connect to
		$mail->setFrom("Mailer");
		$mail->addAddress($email);     									// Add a recipient
		$mail->isHTML(true);											// Set email format to HTML

		$mail->Subject = "Konfirmasi Pendaftaran User Hotspot Jogja Kota";
		$mail->Body    = "<div style='font-size :12pt; font-family: monospace; text-align: center; line-height: 30px; padding: 15px; background: rgba(200,200,200,.5);'><div style='padding: 30px; text-transform: uppercase; color: #fff; background: #aaa; margin-bottom: 15px; text-align: center; font-size: 26pt;'>Free Hotspot Yogyakarta</div><div style='text-align: center; padding: 15px; background: #fff;'>Terima kasih telah mendaftar di Hotspot Jogja Kota. Anda sudah dapat menggunakan internet gratis di lingkungan kota Yogyakarta. Password yang anda gunakan tertera pada kotak teks dibawah</div><h1 style='font-weight: 100; box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); font-family: monospace; text-align: center; background: #fff; padding: 15px;'>$password_sent</h1></div>";

		if(!$mail->send()) {
			echo "Message could not be sent.";
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	?>

	<script type="text/javascript">
		$(document).ready(function() {
			localStorage.removeItem("email");
			localStorage.removeItem("password");
			window.close();
		});
	</script>
</body>
</html>