<?
$zeit='20020822092819';
	
	$datum = substr($zeit,6,2)."."; // Tag des Monat
	$datum .= substr($zeit,4,2)."."; // Monat
	$datum .= substr($zeit,0,4)."&nbsp;&nbsp;";
	$datum .= substr($zeit,8,2).":";
	$datum .= substr($zeit,10,2);
	echo "berechnete Zeit: ".$datum."<br>";

?>
