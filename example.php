<?php

include('tncsqlmanager.php');
$test = new tncSQLManager();
$test->query("SET NAMES UTF8");
$result = $test->query("SELECT * FROM city LIMIT 0,10");

echo '
<table align="center" width="800px" cellpadding="3" cellspacing="1">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>CountryCode</th>
		<th>District</th>
		<th>Population</th>
	</tr>';
while($row = $test->fetchArray($result)) {
	echo '
	<tr>
		<td>'.$row["ID"].'</td>
		<td>'.$row["Name"].'</td>
		<td>'.$row["CountryCode"].'</td>
		<td>'.$row["District"].'</td>
		<td>'.$row["Population"].'</td>
	</tr>';
}
echo '
</table>';

?>