<?
/********* Funktionsdatei fuer Modul 'navigation' *************/

/**
* Bildung eines Array aus einer Datenbankabfrage
*
* dazu wird das '$abfrage - Objekt' uebergeben
* und in ein array abgelegt
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
* Bildung Pfadname der Knoten
* aus Knotenpfad und Knoten - ID
*/
function knoten_pfad($abfrage1){
	$anzahl=count($abfrage1[knoten_pfad]);
	for($i=0;$i<count($abfrage1[knoten_pfad]);$i++){
		$abfrage1[knoten_pfad][$i]=KNOTEN_PFAD.$abfrage1[knoten_id][$i]."/".$abfrage1[knoten_pfad][$i];
	}
	return $abfrage1;
}

/**
* Bildung Pfadname des Blatt
* aus Knoten - ID und Knotenpfad aus 'key.inc'
*/
function blatt_pfad($knoten,$abfrage1){
	$anzahl=count($abfrage1[blatt_pfad]);
	for($i=0;$i<$anzahl;$i++){
		$abfrage1[blatt_pfad][$i]=KNOTEN_PFAD.$knoten."/".$abfrage1[blatt_pfad][$i];
	}
	
	return $abfrage1;
}
?>
