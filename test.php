<?php
require("library/system.php");
require("library/basicqueries.php");

$conn = openDB();

$result = getStudentMajor($conn,1);

if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
	{
        echo $row["strMajor1"];
    }
}

closeDB($conn);
?> 