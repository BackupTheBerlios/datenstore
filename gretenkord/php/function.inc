<?
/*********** Funktionsdatei **************/
function kontrolle($array){  // allgemeine Kontrolle eines Array
echo "Arraykontrolle !<br>";
echo "Anzahl der Datens&auml;tze: ".count($array)."<br>";
	foreach($array as $name => $inhalt){
		echo "Name: $name Inhalt: &nbsp;&nbsp; $inhalt <br>";
	}
}

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



function passwort($abfrage,$benutzer,$passwd){ // Kontrolle des Passwortes
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

function tabelle_user_aendern($wert){  // Aufarbeitung pers. Angaben fuer Tabelle 'user'
	$query = "update user set ";
	$query .= "user.Name='$wert[name]', ";
	$query .= "user.Vorname='$wert[vorname]', ";
	$query .= "user.Passwort='$wert[passwort]', ";
	$query .= "user.Benutzername='$wert[benutzername]' ";

	$query .= "where user.id=$wert[user_id]";
	return $query;
}

function tabelle_adresse_aendern($wert){  // Aufarbeitung pers. Angaben fuer Tabelle 'adresse'
	$query = "update adresse set ";
	$query .= "adresse.PLZ='$wert[plz]', ";
	$query .= "adresse.Ort='$wert[ort]', ";
	$query .= "adresse.Strasse='$wert[strasse]', ";
	$query .= "adresse.Nr='$wert[nr]', ";
	$query .= "adresse.Telefon='$wert[telefon]', ";
	$query .= "adresse.Handy='$wert[handy]', ";
	$query .= "adresse.EMail='$wert[email]', ";
	$query .= "adresse.Fax='$wert[fax]' ";
	
	$query .= "where adresse.user_id=$wert[user_id]";
	return $query;
}

function text_verbesserung($text_array,$feld){  // Verbesserung eines Textarrays, entstanden aus 'array_bildung'
$i=0;
	if(sizeof($text_array) > 0){
		foreach($text_array as $name => $inhalt){
			foreach($inhalt as $name1 => $inhalt1){
				$text[$name][$i]=$inhalt1;
				if($name==$feld){
					$text[$name][$i]=htmlentities($inhalt1);
					$text[$name][$i]=ereg_replace("\n","<br>",$text[$name][$i]);
				}
				if($name=='zeit'){
					$text[$name][$i]=zeit_verbesserung($text[$name][$i]);
				}
				$i++;
			}
			$i=0;
		}
		return $text;
	}
	else{
		return;
	}
}

function zeit_verbesserung($zeit){  // Umwandlung des Timestampes in Normalzeit
	$datum = substr($zeit,6,2)."."; // Tag des Monat
	$datum .= substr($zeit,4,2)."."; // Monat
	$datum .= substr($zeit,0,4)."&nbsp;&nbsp;";  // Jahr
	$datum .= substr($zeit,8,2).":";  // Stunde
	$datum .= substr($zeit,10,2);  // Minute
	return $datum;
}
?>
