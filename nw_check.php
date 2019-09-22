<!DOCTYPE html>
<?php
    $con = mysql_connect("localhost","airdata","AESl0uis!");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
?>

<html>
<body>
	<form method = "POST" action = "nw_check_exec.php">
		<input type = "submit" name = "nw_update" value = "NW_Update"/>
	</form>
</body>
</html>
