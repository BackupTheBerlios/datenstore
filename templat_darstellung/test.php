<?
$test="<aaaaa bbbb><ccccc dddddd><eeeeee ffffffffffff>";
$test1=explode(">",$test);
$inhalt="";
echo "Anzahl der Elemente: ".count($test1)."<hr>";

for($i=0;$i<count($test1);$i++){
	$inhalt .= "Durchlauf: ".$i;
	$inhalt .= $test1[$i].">";
}
echo $inhalt;
?>
