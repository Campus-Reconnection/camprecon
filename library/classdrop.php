<?php
	session_start(); 
	require("system.php"); 
	require("classqueries.php");
	loginHandler(); 
	
	if (isset($_GET['check']))
	{
		foreach ($_GET['check'] as $key=>$value)
		{
			$conn = openDB();
			$result = deleteCourses($value);
			closeDB($conn);

			if ($result != false)
			{
				header("Location: ../dropclasses.php");
			}
		}
	}
?>