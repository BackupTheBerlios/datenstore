<?php
$db1= array('wert1','wert2','wert3','wert4');
$db2= array('aaa','bbb','ccc','ddd');
$db3= array(111,222,333,444);

$anzahl=count($db1);
for($i=0;$i<$anzahl;$i++){
	test($db1[$i],$db2[$i],$db3[$i]);
}

echo(test);

function test($wert1,$wert2,$wert3){
	echo "$wert1 $wert2 $wert3<br>";
}
?>