<?
/*************** Functiondatei des Modul Leiste *****************/

/**
* Passwortueberpruefung an Hand der Datenbankabfrage
* 
* Wenn das Passwort und Benutzer richtig, so wird das Array '$zugang' zurueckgegeben
* wenn Passwort und Benutzer falsch, dann kein 'return'
*/
function leiste_passwort($abfrage,$benutzer,$passwd){ // Kontrolle des Passwortes
$i=0;
	while($wert=$abfrage->fetch_array(patDBC_TYPEASSOC)){
		foreach($wert as $name => $inhalt){
			$ausgabe[$name][$i]=$inhalt;
		}
	$i++;
	}
	$k=count($ausgabe);
	for($j=0;$j<$k;$j++){
		if($ausgabe[Benutzername][$j]==$benutzer and $ausgabe[Passwort][$j]==$passwd){
			$zugang[erlaubt]='ja'; // Zugang zu Block 2
			$zugang[id]=$ausgabe[id][$j]; // Speicherung Benutzer-ID
			return $zugang;
			break;
		}
	}
}
?>
