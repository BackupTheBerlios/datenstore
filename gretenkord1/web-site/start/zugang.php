<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'check.inc');  // Kontrollklasse Formular
include_once(PHP_PFAD.'function.inc');  // zentrale Funktionsdatei

/*************** lokale Includedateien **********************/
include_once(PHP_START.'start_function.inc');


/************************* Steuerungsblock ***********************/
$tmpl = new patTemplate();
$tmpl->setBasedir(T_START);
$tmpl->readTemplatesFromFile('haupt.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$zugang = $db->connect();


/********** Eroeffnungsmenue ***************/
if(($absenden and $zugang)){ // wenn Formular Passwort und Datenbankconnect

	foreach($HTTP_GET_VARS as $name => $inhalt){  // Sicherheitskontrolle Eingabe
		$inhalt=sicherheit($inhalt);  // Verhinderung Sabotage
		$HTTP_GET_VARS[$name]=$inhalt;
	}
	
	$query1="select * from user";
	$abfrage1=$db->query($query1);
	$zugang=start_passwort($abfrage1,$HTTP_GET_VARS[benutzer],$HTTP_GET_VARS[passwd]);
}

/************ Darstellung der persoenlichen Daten *********************/
if($zugang[erlaubt]=='ja' or $aendern or $leiste){ // Wenn Zugangskontrolle erfolgreich oder Info aendern oder Zugriff von Leiste
	if($aendern){  // Veraenderung der persoenlichen Angaben
		$query1=tabelle_adresse_aendern($HTTP_POST_VARS,$person_zugang);
		$abfrage1=$db->query($query1);
		$query1=tabelle_user_aendern($HTTP_POST_VARS,$person_zugang);
		$abfrage1=$db->query($query1);
	}
	
	if(!isset($zugang[id])){
		$person=$person_zugang;
	}
	else{
		$person=$zugang[id];
	}
	
	if($leiste){
		$person=$leiste;
	}
	
	$query1="select * from user,adresse where user.id=adresse.user_id and user.id='$person'";
	
	$abfrage1=$db->query($query1);
	$daten=array_bildung($abfrage1);
	$tmpl->setAttribute('person','visibility','visibility');
	$tmpl->setAttribute('verbessern','visibility','visibility');
	
	if(!isset($zugang[id])){
		$tmpl->addVar('verbessern','USER_ID',$person_zugang);
	}
	else{
		$tmpl->addVar('verbessern','USER_ID',$zugang[id]);
	}
	
	if($leiste){  // wenn Steuerung ueber 'leiste'
		$tmpl->addVar('verbessern','USER_ID',$leiste);
	}
	
	$tmpl->addVars('person',$daten); // uebergabe der Daten an Block 'person'

/************* loeschen von Informationen ***************/
if($loeschen){
	info_loeschen($loeschen,$db);
}

/*********** Darstellung der Informationen ********************/
	$query1="select id,info,zeit,Absender from info where user_id='$person' or user_id=0 order by zeit DESC";
	
	$abfrage1=$db->query($query1);
	if($abfrage1->num_rows() > 0){
		$tmpl->setAttribute('info','visibility','visibility');
		$kurznachrichten=array_bildung($abfrage1);
		$kurznachrichten=text_verbesserung($kurznachrichten,'info');
		$kurznachrichten = absender_bestimmen($kurznachrichten,$db);
		$tmpl->addVars('info',$kurznachrichten);
	}
	else{
		$tmpl->setAttribute('keine_info','visibility','visibility');
	}
}
else{
	$tmpl->setAttribute('passwort','visibility','visibility');
}

$db->close();
$tmpl->displayParsedTemplate();
gz_output();
?>
