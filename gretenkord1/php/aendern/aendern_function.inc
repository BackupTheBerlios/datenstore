<?
/*********** lokale Funktionssammlung fuer Modul 'Benutzer aendern' *************/

/**
* Bildung eines Array aus einer Datenbankabfrage
*
*
*/
function array_bildung($abfrage){ // Bildung eines Array aus einer Datenbankabfrage
$i=0;
	while($wert=$abfrage->fetch_array(patDBC_TYPEASSOC)){
		foreach($wert as $name => $inhalt){
			$ausgabe[$name][$i]=$inhalt;
		}
	$i++;
	}
	return $ausgabe;
}

/**
* Das Array der gewaehlten Rechte des Users wird zum Query - String umgewandelt
*
* wenn der User keine Rechte hat, dann Abbruch
*/
function rechte_anlegen($db,$aendern_hidden,$wert){
	if(count($wert)==0){ // wenn keine Rechte vergeben
		return;
	}
	foreach($wert as $name => $inhalt){
		$query1="insert into rechte_user (user_id, rechte_id) values ('$aendern_hidden', '$name')";
		$abfrage1=$db->query($query1);
	}
	return;
}

/**
* Veraenderung einer Textspalte in einem mehrdimensionalen Array
*
* Umwandlung von Sonderzeichen in Html
* der 1. Parameter gibt die zu bearbeitende Textspalte an
* der 2. Parameter ist das Abfrage - Array
*/
function veraenderung_array_text($spalte,$antwort){
	$anzahl=count($antwort[$spalte]);
	for($i=0;$i<$anzahl;$i++){
		$antwort[$spalte][$i]=htmlentities($antwort[$spalte][$i]);
	}
	return $antwort;
}

/**
* Umwandlung eines MySQL Timestamp - Feldes
*
* Ausgabe in der typisch mitteleuropaeischen Form
*/
function zeit_verbesserung($zeit){  // Umwandlung des Timestampes in Normalzeit
	$datum = substr($zeit,6,2)."."; // Tag des Monat
	$datum .= substr($zeit,4,2)."."; // Monat
	$datum .= substr($zeit,0,4)."&nbsp;&nbsp;";  // Jahr
	$datum .= substr($zeit,8,2).":";  // Stunde
	$datum .= substr($zeit,10,2);  // Minute
	return $datum;
}
?>
