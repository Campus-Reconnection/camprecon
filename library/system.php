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
			exit();
		}
	}
	
	// Gets a mysqli connection instance for use in prepared statements
	function getMysqli()
	{
		return new mysqli("localhost", "root", "camprecon", "camprecon");
	}
	
	// Fetches all rows for a SELECT query using prepared statements
	// Returns fals on failure
	function dbGetAll()
	{
		$arg_list = func_get_args();
		$mysqli = getMysqli();
		$sql = array_shift($arg_list);
		$query = $mysqli->prepare($sql);
		if (!empty($arg_list)) {
			$Args = array();
			foreach($arg_list as $k => &$arg) {
				$Args[$k] = &$arg;
			} 
			call_user_func_array(array($query, "bind_param"), $Args);
		}
		$out = false;
		if ($query->execute())
			$out = $query->get_result()->fetch_all(MYSQLI_BOTH);
		$query->close();
		$mysqli->close();
		return $out;
	}
	
	// Fetches only the first row for a SELECT query using prepared statements
	// Returns false on failure
	function dbGetFirst()
	{
		$arg_list = func_get_args();
		$mysqli = getMysqli();
		$sql = array_shift($arg_list);
		$query = $mysqli->prepare($sql);
		$Args = array();
        foreach($arg_list as $k => &$arg){
            $Args[$k] = &$arg;
        } 
		call_user_func_array(array($query, "bind_param"), $Args);
		$out = false;
		if ($query->execute()) $out = $query->get_result()->fetch_array(MYSQLI_BOTH);
		$query->close();
		$mysqli->close();
		return $out;
	}
	
	// Returns true if any records match the search criteria of a SELECT statement
	// Returns false if there is no match
	function dbGetExists()
	{
		$arg_list = func_get_args();
		$mysqli = getMysqli();
		$sql = array_shift($arg_list);
		$query = $mysqli->prepare($sql);
		$Args = array();
        foreach($arg_list as $k => &$arg){
            $Args[$k] = &$arg;
        } 
		call_user_func_array(array($query, "bind_param"), $Args);
		$out = true;
		if ($query->execute() && !($query->get_result()->fetch_array())) $out = false;
		$query->close();
		$mysqli->close();
		return $out;
	}
	
	// Pushes a single INSERT query to the database using prepared statements
	// Returns true on success
	// Returns false on failure
	function dbPush()
	{
		$arg_list = func_get_args();
		$mysqli = getMysqli();
		$sql = array_shift($arg_list);
		$query = $mysqli->prepare($sql);
		$Args = array();
        foreach($arg_list as $k => &$arg){
            $Args[$k] = &$arg;
        } 
		call_user_func_array(array($query, "bind_param"), $Args);
		$out;
		if ($query->execute()) $out = true;
		//else $out = sprintf("errno: %d, error: %s", $query->errno, $query->error);
		else $out = false;
		$query->close();
		$mysqli->close();
		return $out;
	}

?>