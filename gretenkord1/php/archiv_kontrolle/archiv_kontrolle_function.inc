<?
/*********** Functionsdatei Modul Archiv - Kontrolle ***************************/

/**
* Umwandlung der Zeit
*
*/
function zeit_anpassung($zeit){
	foreach($zeit as $name => $inhalt){
		$zeit[$name]=substr($zeit[$name],6,2).".".substr($zeit[$name],4,2).".".substr($zeit[$name],0,4);
	}
	return $zeit;
}

/**
* Funktion zur Sichtbarmachung des Status
*/
function status_anpassung($status){
	foreach($status as $name => $inhalt){
		if($inhalt==0){
			$status[$name]="unkontrolliert";
		}
		else{
			$status[$name]="kontrolliert";
		}
	}
	return $status;
}
?>
