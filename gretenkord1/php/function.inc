<?
/*********** zentrale Funktionsdatei **************/

/**
* Ueberpruefung eines gebildeten nummerischen Array's auf Inhalt 1 - dimensional
*
*/
function kontrolle_array_numm($array){  // allgemeine Kontrolle eines Array
echo "Arraykontrolle 1 - dimensional - nummerisch !<hr>";
echo "Anzahl der Datens&auml;tze: ".count($array)."<hr>";
	foreach($array as $inhalt){
		echo "Inhalt: &nbsp;&nbsp; $inhalt <br>";
	}
}

/**
* Ueberpruefung eines gebildeten Array's auf Inhalt 1 - dimensional
*
*/
function kontrolle_array_1($array){  // allgemeine Kontrolle eines Array
echo "Arraykontrolle 1 - dimensional !<hr>";
echo "Anzahl der Datens&auml;tze: ".count($array)."<hr>";
	foreach($array as $name => $inhalt){
		echo "Name: $name Inhalt: &nbsp;&nbsp; $inhalt <br>";
	}
}

/**
* Ueberpruefung eines gebildeten Array's auf Inhalt 2 - dimensional
*
*/
function kontrolle_array_2($array){  // allgemeine Kontrolle eines Array
echo "Arraykontrolle 2 - dimensional !<hr>";
echo "Anzahl der Teilarrays: ".count($array)."<hr>";
	foreach($array as $name => $inhalt){
		foreach($inhalt as $name1 => $inhalt1){
			echo "$name $name1 $inhalt1<br>";
		}
		echo "<hr>";
	}
}


/**
* Bildung eines Array aus einer Datenbankabfrage
*
* dazu wird das '$abfrage - Objekt' uebergeben
* und in ein array abgelegt
*/
function array_bildung($abfrage){ // Bildung eines Array 2-dimensional aus einer Datenbankabfrage
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
* Bildung eines 1-dimensionalen nummerischen Array
* aus einer Datenbankabfrage
*/
function array_bildung_simpel($abfrage){
	$i=0;
	while($wert=$abfrage->fetch_array(patDBC_TYPENUM)){
		foreach($wert as $inhalt){
			$ausgabe[$i]=$inhalt;
			$i++;
		}
	}
	return $ausgabe;
}


/**
* Verbesserung eines Textblockes
* 
* Die Zeilenumbrueche eines Textblockes werden in '<br>' umgewandelt
* Die Zeit wird in das mitteleuropaeische Format gewandelt
* Das Feld in dem sich der Text befindet muss als Parameter 2 angegeben werden
* Der Name des Datumfeldes muss 'zeit sein'
*/
function text_verbesserung($text_array,$feld){
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

/**
* Umwandlung von Html - Sonderzeichen
*
* in Spezialzeichen Html
* Verhindert die Eingabe von SQL - Mehrfachweisungen
*/
	function sicherheit($eingabe){
		$eingabe=ereg_replace("<","",$eingabe);
		$eingabe=ereg_replace(";","",$eingabe);
		return $eingabe;
	}

/**
* lesen Verzeichnisbaum
* neue Variante
*/
function verzeichnis($kunde){
	$i=0;
	$pfad=opendir($kunde); // oeffnen Hauptverzeichnis 'kunde'
	while($eintrag=readdir($pfad)){
		if($eintrag!='.' and $eintrag!='..' and $eintrag!='CVS' and $eintrag!='php' and $eintrag!='layout' and $eintrag!='bilder'){
			$verzeichnis[$i]=$eintrag;
			$i++;
		}
	}
	closedir($pfad);
	clearstatcache();
	return $verzeichnis;
}

/**
* Umwandlung der Verzeichnisse fuer hinzufuegen Knoten und Blaetter
*/
function verzeichnis_simple($verzeichnisse){
	$anzahl=count($verzeichnisse);
	for($i=0;$i<$anzahl;$i++){
		$inhalt .="<option value='$verzeichnisse[$i]'>".$verzeichnisse[$i]."</option>";
	}
	return $inhalt;
}
?>
