<?
echo "<h2 align='center' style='color:red'>Testseite<br>Projekt 'Datenstore'</h2>";
phpinfo();

echo "<hr><h2 align='center' style='color:red'>Die Umgebungsvariablen !</h2><br>";
foreach($_ENV as $name => $inhalt){
	echo "die Umgebungsvariable: $name hat den Inhalt: $inhalt<br>";
}
echo "<hr>";
echo "<hr><h2 align='center' style='color:red'>Test !</h2><br>";
foreach($GLOBALS[GLOBALS] as $name => $inhalt){
	echo "globale Variable: $name $inhalt <br>";
}
?>
