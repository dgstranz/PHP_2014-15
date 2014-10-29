<?php
$cols = 8;
$rows = 3;

echo '<table>';
echo '<tr><td></td>';
for ($c=1; $c <= $cols; $c++) echo '<td>' . $c . '</td>';
echo '</tr>';
for ($r=1; $r <= $rows; $r++) {
	echo '<tr><td>' . $r . '</td>';
	for ($c=1; $c <= $cols; $c++) echo '<td>' . $r . $c . '</td>';
	echo '</tr>';
}
echo '</table>';

?>