<?php
header ('Content-Type: text/html; charset=UTF-8');
session_start();

echo '
	<form action="index2.php" method="post">
		<table>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>Captcha:</td>
				<td><img src="captcha.php"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="captcha" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>';
?>