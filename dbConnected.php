<?php
	$conn = mysqli_connect("localhost", "root", "L*hlXjs1", "user");
	if (!$conn){
		die("Connection Failed: ".mysqli_connect_error());
	}
