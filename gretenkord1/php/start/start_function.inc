<?
/********** lokale Functiondatei , Modul 'start' *************/

/**
* Passwortueberpruefung an hand der datenbankabfrage
* 
* Wenn das Passwort und Benutzer richtig, so wird das Array '$zugang' zurueckgegeben
*/
function start_passwort($abfrage,$benutzer,$passwd){ // Kontrolle des Passwortes
	while($wert=$abfrage->fetch_array(patDBC_TYPEASSOC)){
		if($wert[Benutzername]==$benutzer and $wert[Passwort]==$passwd and $wert[aktiv]=='aktiv'){
			$zugang[erlaubt]='ja'; // Zugang zu Block 2
			$zugang[id]=$wert[id]; // Speicherung Benutzer-ID
			return $zugang;
		}
	}
	return;
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
* und traegt diesen User als Klartext ein
*
*/
function absender_bestimmen($absender,$db){
$query1="select * from user";
	$antwort1=$db->query($query1);
	$antwort1=array_bildung($antwort1);
	
	$i=0;
	foreach($absender[Absender] as $name => $inhalt){
	if($inhalt==0){
		$absender[Absender][$i]="Information an Alle !";
	}
	
		$k=0;
		foreach($antwort1[id] as $name1 => $inhalt1){
			if($inhalt==$inhalt1){
				$absender[Absender][$i]=$antwort1[Name][$k]."&nbsp;&nbsp;".$antwort1[Vorname][$k]."&nbsp;&nbsp;- ".$antwort1[Bemerkung][$k]." -";
			}
		$k++;
		}
	$i++;
	}
	return $absender;
}
?>
