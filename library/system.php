<?php

	function openDB() {
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
	
	function closeDB($conn) {
		mysqli_close($conn);
	}
	
	function queryDB($sql) {
		$conn = openDB();
		$result = mysqli_query($conn, $sql);
		closeDB($conn);
		return $result;
	}
	
	function array_to_xml($object_info, $xml_object_info) {
		foreach($object_info as $key => $value) {
			$lcKey = strtolower($key);
			if(is_array($value)) {
				if(!is_numeric($lcKey)){
					$subnode = $xml_object_info->addChild("$lcKey");
					array_to_xml($value, $subnode);
				}
				else{
					$subnode = $xml_object_info->addChild("item");
					array_to_xml($value, $subnode);
				}
			}
			else {
				$xml_object_info->addChild("$lcKey",htmlspecialchars("$value"));
			}
		}
	}

?>