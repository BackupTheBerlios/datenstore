<?
/*********** lokale Funktionsdatei Modul 'knoten_blatt' ****************/

/**
* Funktion zur Bestimmung der Verzeichnisse in 'web-site'
*/
function verzeichnisse_bestimmen(){
	echo "Kontrolle !<hr>";
	$obj=dir('c:/php/gretenkord/web-site/start/');
	while($verzeichnis=$obj->read){
		echo "Verzeichnis: $verzeichnis<br>";
	}
}
?>
