<?
/**
* Passwortueberpruefung an hand der datenbankabfrage
* 
* Wenn das Passwort und Benutzer richtig, so wird das Array '$zugang' zurueckgegeben
*/
function start_passwort($abfrage,$benutzer,$passwd){ // Kontrolle des Passwortes
	while($wert=$abfrage->fetch_array(patDBC_TYPEASSOC)){
		if($wert[Benutzername]==$benutzer and $wert[Passwort]==$passwd){
			$zugang[erlaubt]='ja'; // Zugang zu Block 2
			$zugang[id]=$wert[id]; // Speicherung Benutzer-ID
			return $zugang;
		}
	}
	return;
}
?>
