<?
/*********** lokale Funktionsdatei Modul 'knoten_blatt' ****************/

/**
* lesen Verzeichnisbaum
* neue Variante
*/
function verzeichnis($kunde){
	$i=0;
	$pfad=opendir($kunde); // oeffnen Hauptverzeichnis 'kunde'
	while($eintrag=readdir($pfad)){
		if($eintrag!='.' and $eintrag!='..' and $eintrag!='CVS'){
			$verzeichnis[$i]=$eintrag;
			$i++;
		}
	}
	closedir($pfad);
	clearstatcache();
	return $verzeichnis;
}


/**
* Abgleich Verzeichnisse mit Einstellung fuer Knoten Pulldown
*/
function knoten_pulldown($verzeichnis,$antwort1){
	$anzahl1=count($antwort1);
	$anzahl2=count($verzeichnis);
	for($i=0;$i<$anzahl1;$i++){
		for($j=0;$j<$anzahl2;$j++){
			if($antwort1[$i]==$verzeichnis[$j]){
				$inhalt[$i] .= "<option value='$verzeichnis[$j]' SELECTED>".$verzeichnis[$j]."</option>";
			}
			else{
				$inhalt[$i] .= "<option value='$verzeichnis[$j]'>".$verzeichnis[$j]."</option>";
			}
		}
	}
	return $inhalt;
}

/**
* Abgleich welche Haupt - Seite wurde ausgewaehlt
*/
function seite_pulldown($seite){
	$eintrag[0]="index.html";  // moegliche Varianten der Seiten
	$eintrag[1]="index.php";

	$anzahl=count($seite);
	for($i=0;$i<$anzahl;$i++){
		for($j=0;$j<2;$j++){
			if($seite[$i]==$eintrag[$j]){
				$inhalt[$i] .="<option SELECTED value='$eintrag[$j]'>".$eintrag[$j]."</option>";
			}
			else{
				$inhalt[$i] .="<option value='$eintrag[$j]'>".$eintrag[$j]."</option>";
			}
		}
	}
	return $inhalt;
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

/**
* loeschen der Blaetter die
* zu einem Knoten gehoeren
*/
function blatt_loeschen($db,$blatt_array){
	$anzahl=count($blatt_array);
	for($i=0;$i<$anzahl;$i++){
		$query="delete from blatt1 where id=$blatt_array[$i]";
		$db->query($query);
	}
	return;
}

/**
* loeschen der Eintragungen
*	welche zu dem Knoten gehoeren
* in der Brueckentabelle 'knoten1_blatt1'
*/
function knoten1_blatt1_loeschen($db,$id){
	$query="delete from knoten1_blatt1 where knoten_id=$id";
	$db->query($query);
	return;
}

/**
* welche Blaetter gehoeren zum Knoten
* Ermittlung der Eigenschaften der Blaetter
*/
function welche_blaetter($db,$blatt_array){
	$anzahl=count($blatt_array);
	for($i=0;$i<$anzahl;$i++){
		$query="select * from blatt1 where id='$blatt_array[$i]'";
		$zeile=$db->query($query);
		while($wert=$zeile->fetch_array(patDBC_TYPEASSOC)){
			foreach($wert as $name => $inhalt){
				$ausgabe[$name][$i]=$inhalt;
			}
		}
	}
	return $ausgabe;
}
?>
