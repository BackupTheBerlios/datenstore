<?
/*********** lokale Funktionsdatei Modul 'knoten_blatt' ****************/

/**
* Lesen eines Verzeichnisbaumes
*/
function verzeichnis($kunde){
	$i=0;
	$pfad=opendir($kunde);
	$eintrag=readdir($pfad);
	while($eintrag){
		$test=filetype($eintrag);
		$test1=substr($eintrag,-4);
		if($test=='dir' and $test1!='html' and $eintrag!='.' and $eintrag!='..'){
			$verzeichnis[$i]=$eintrag;
			$i++;
		}
		$eintrag=readdir($pfad);

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
* Umwandlung der Verzeichnisse fuer hinzufuegen_knoten
*/
function verzeichnis_simple($verzeichnisse){
	$anzahl=count($verzeichnisse);
	for($i=0;$i<$anzahl;$i++){
		$inhalt .="<option value='$verzeichnisse[$i]'>".$verzeichnisse[$i]."</option>";
	}
	return $inhalt;
}
?>
