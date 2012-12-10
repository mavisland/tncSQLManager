<?php

/**
 * tncSQLManager
 * Simple MySQL Query Manager for PHP
 * This class can compose and execute MySQL queries from parameters.
 * It can take parameters that define tables, field names, field values,
 * and conditions to compose INSERT, UPDATE and DELETE queries on a
 * given MySQL database.
 *
 * @author Tanju Yildiz <yildiz.tanju@gmail.com>
 * @file example.php
 * @version 0.7
 * @date 03:41 10.12.2012
 */

include('tncsqlmanager.php');

$test  = new tncSQLManager();
$result = $test->query('SELECT * FROM city ORDER BY ID DESC');

echo '
<table align="center" width="800px" cellpadding="3" cellspacing="1">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>CountryCode</th>
		<th>District</th>
		<th>Population</th>
	</tr>';
while($row = $test->fetchArray($result) or die(mysql_error())) {
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