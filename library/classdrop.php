<?php
	session_start(); 
	require("system.php"); 
	require("classqueries.php");
	loginHandler(); 
	
	if (isset($_GET['check']))
	{
		foreach ($_GET['check'] as $key=>$value)
		{
			if (deleteCourses($value))
			{
				header("Location: ../dropclasses.php");
			}
		}
	}
?>