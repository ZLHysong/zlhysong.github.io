<?php
	$editor_data = $_POST[ 'editor1' ];
	$servername = "mysql.zacheryhysong.com";
	$username = "zacheryhysongcom";
	$password = "JnYkuxhr";
	$dbname = "bookpublisherdb";
	
	$sql = "REPLACE INTO test (id, content) VALUES (1, '" . $editor_data . "');";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	echo "SQL: " . $sql . "<br><br>";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br><br>" . $conn->error;
	}

	$conn->close();

?>