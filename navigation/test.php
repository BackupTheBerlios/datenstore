<?
/******** Bildung eines mehrdimensionalen Array ***********/
$test[wert1][1]="wert1 - 1";
$test[wert1][3]="wert1 - 3";
$test[wert1][5]="wert1 - 5";
$test[wert1][7]="wert1 - 7";
$test[wert1][9]="wert1 - 9";

$test[wert2][1]="wert2 - 1";
$test[wert2][3]="wert2 - 3";
$test[wert2][5]="wert2 - 5";
$test[wert2][7]="wert2 - 7";
$test[wert2][9]="wert2 - 9";

$test[wert3][1]="wert3 - 1";
$test[wert3][3]="wert3 - 3";
$test[wert3][5]="wert3 - 5";
$test[wert3][7]="wert3 - 7";
$test[wert3][9]="wert3 - 9";

/******** Steuerungswerte ************/
$knoten=5;
$blatt=3;



/****************** Bestimmung Schnittstelle ***************/
$test1=array_slice($test,0,1);  // Zerlegung in Einzelarray
foreach($test1 as $name => $inhalt){
	$i=0;
	foreach($inhalt as $name1 => $inhalt1){
	$anzahl=count($inhalt);
		if($name1==$knoten){
			$j=$i;  // Bestimmung Schnittstelle
		}
		$i++;
	}
}


/************** Zerlegung Gesamtarray in Teilarrays **************************/
foreach($test as $name => $inhalt){
	if($knoten==false and $blatt==false){
		$oben=$test;
	}
	if($knoten==true and $blatt==false){
		$oben[$name]=array_slice($test[$name],0,$j);
		$mitte[$name]=array_slice($test[$name],$j,1);
		$unten[$name]=array_slice($test[$name],$j+1,$anzahl-1);
	}
	if($knoten==true and $blatt==true){
		$oben[$name]=array_slice($test[$name],0,$j+1);
		$unten[$name]=array_slice($test[$name],$j+1,$anzahl-1);
	}
}



/************* Kontrolle *****************/
kontrolle($oben);

function kontrolle($test){
	foreach($test as $name => $inhalt){
		foreach($inhalt as $name1 => $inhalt1){
			echo "Name: $name Name1: $name1 Inhalt: $inhalt1<br>";
		}
	}
}
?>
