<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$send = mail("csci213busterschrader@gmail.com","My subject",$msg);

if ($send == false)
{
	echo "Not sent.";
}
else
{
	echo "Sent";
}
?>