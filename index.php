<?php

session_start();



//echo $_SESSION['user_name'] . $_SESSION['user_pass'];

echo "<html>
<head>
</head>
<body>";



echo	"<div id='main'>
	<form action='replicast.php' method='POST' enctype='multipart/form-data'>
	<fieldset><legend><b>Replicast:</b></legend>
	<table>
			<tr><td>Upload File:</td><td>  <input type='file' name='photo' /></td></tr>

	</table>
<input type='submit' value='Submit' /><br />

</fieldset>
</form>



<form action='split.php' method='POST' enctype='multipart/form-data'>
<fieldset><legend><b>Split:</b></legend>
<table>
		<tr><td>Upload File:</td><td>  <input type='file' name='photo' /></td></tr>

</table>
<input type='submit' value='Submit' /><br />

</fieldset>
</form>


</center>
</form>
<a href=logout.php>Logout</a>
</body>
</html>";

?>
