<?
/********** lokale Functiondatei , Modul 'start' *************/

/**
* Passwortueberpruefung an hand der datenbankabfrage
* 
* Wenn das Passwort und Benutzer richtig, so wird das Array '$zugang' zurueckgegeben
* wenn Passwort und Benutzer falsch, dann kein 'return'
*/
function start_passwort($abfrage,$benutzer,$passwd){ // Kontrolle des Passwortes
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

/**
* Aufarbeitung pers. Angaben fuer Tabelle 'adresse' wenn 'aendern' gedrueckt
*
* Veraenderung der persoenlichen Angaben des Nutzer
*/
function tabelle_adresse_aendern($HTTP_POST_VARS,$wert){
	$query = "update adresse set ";
	$query .= "adresse.PLZ='$HTTP_POST_VARS[plz]', ";
	$query .= "adresse.Ort='$HTTP_POST_VARS[ort]', ";
	$query .= "adresse.Strasse='$HTTP_POST_VARS[strasse]', ";
	$query .= "adresse.Nr='$HTTP_POST_VARS[nr]', ";
	$query .= "adresse.Telefon='$HTTP_POST_VARS[telefon]', ";
	$query .= "adresse.Handy='$HTTP_POST_VARS[handy]', ";
	$query .= "adresse.EMail='$HTTP_POST_VARS[email]', ";
	$query .= "adresse.Fax='$HTTP_POST_VARS[fax]' ";
	$query .= "where adresse.user_id=$wert";
	return $query;
}

/**
* Veraenderung der Tabelle 'user' wenn 'aendern' gedrueckt
*
* Veraenderung der persoenlichen Angaben des Nutzer
*/
function tabelle_user_aendern($HTTP_POST_VARS,$wert){  // Aufarbeitung pers. Angaben fuer Tabelle 'user'
	$query = "update user set ";
	$query .= "user.Name='$HTTP_POST_VARS[name]', ";
	$query .= "user.Vorname='$HTTP_POST_VARS[vorname]', ";
	$query .= "user.Passwort='$HTTP_POST_VARS[passwort]', ";
	$query .= "user.Benutzername='$HTTP_POST_VARS[benutzername]' ";
	$query .= "where user.id=$wert";
	return $query;
}

/**
* loeschen von Benutzerinformationen
*
*/
function info_loeschen($loeschen,$db){
	foreach($loeschen as $zahl){
		$query1="delete from info where info.id=$zahl";
		$abfrage1=$db->query($query1);
	}
	return;
}

/**
* diese Funktion bestimmt den Absender an Hand der User ID
*
*
*/
function absender_bestimmen($absender,$db){
	echo "in Absender bestimmen !";
	return;
}
?>
