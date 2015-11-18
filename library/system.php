<?php
	
	//Prevents hacks by cross-site scripting.
	//Use anywhere you obtain information from the user. Textboxes, etc. 
	function fixInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function loginHandler()
	{
		if (!isset($_SESSION['crlogin']))
		{
			$_SESSION['crlogin'] = false;
		}
		
		if ($_SESSION['crlogin'] == false)
		{
			header("Location:/login.php");
		}
	}
	
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