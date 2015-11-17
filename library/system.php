<?php

	function openDB()
	{
		$servername = "localhost";
		$username = "root";
		$password = "camprecon";
		$dbname = "camprecon";
		
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if (!$conn)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		
		return $conn;
	}
	
	function closeDB($conn)
	{
		mysqli_close($conn);
	}
	
	function queryDB($sql)
	{
		$conn = openDB();
		$result = mysqli_query($conn, $sql);
		closeDB($conn);
		return $result;
	}

?>