<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse

include_once(PHP_PFAD.'function.inc');  // allgemeine Funktionen

$tmpl = new patTemplate();
$tmpl->setBasedir(T_START);
$tmpl->readTemplatesFromFile('haupt.ihtml');
// $tmpl->dump();
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass); // Verbindung zur Datenbank
$db->connect();

if($absenden){  // Eroeffnungsmenue des CMS
	$query1="select id,Benutzername,Passwort from user"; // Anfrage 1
	$abfrage1=$db->query($query1);
	// $abfrage1->dump();  // Kontrolle fuer Anfrage 1
	$zugang=passwort($abfrage1,$benutzer,$passwd);
}

if($zugang_id=='ja'){  // Navigation ueber Navigationsleiste
	$zugang[erlaubt]='ja';
	$zugang[id]=$user;
}


if($zugang[erlaubt]=='ja'){ // Wenn Zugangskontrolle erfolgreich - Erststart
	$query2="select * from user,adresse where user.id='$zugang[id]' and adresse.user_id='$zugang[id]'";
	$abfrage2=$db->query($query2);
	// $abfrage2->dump();
	$daten=array_bildung($abfrage2);
	$tmpl->addVars('haupt',$daten);
	$query5="select info,zeit from info where user_id='$zugang[id]' order by zeit DESC";
	$abfrage5=$db->query($query5);
	$kurznachrichten=array_bildung($abfrage5);
	$kurznachrichten=text_verbesserung($kurznachrichten,'info'); // Verbesserung Info - Feld
	// kontrolle($kurznachrichten);
	$tmpl->addVars('information',$kurznachrichten);
	$tmpl->addVar('haupt','ZUGANG',$zugang[erlaubt]);
}
else{
	$tmpl->addVar('haupt','ZUGANG','nein');
}

if($aendern){   // nach erfolgter Aenderung
	$query3=tabelle_user_aendern($HTTP_GET_VARS);// Veraenderung der persoenlichen Werte, Tabelle 'user'
	$abfrage3=$db->query($query3);
	
	$query4=tabelle_adresse_aendern($HTTP_GET_VARS); // Veraenderung der persoenlichen Werte, Tabelle 'adresse'
	$abfrage4=$db->query($query4);
	
	
	$query2="select * from user,adresse where user.id='$HTTP_GET_VARS[user_id]' and adresse.user_id='$HTTP_GET_VARS[user_id]'";
	$abfrage2=$db->query($query2);
	$daten=array_bildung($abfrage2);
	$query5="select info,zeit from info where user_id='$HTTP_GET_VARS[user_id]' order by zeit DESC";
	$abfrage5=$db->query($query5);
	$kurznachrichten=array_bildung($abfrage5);
	$kurznachrichten=text_verbesserung($kurznachrichten,'info'); // Verbesserung Info - Feld
	$tmpl->addVars('information',$kurznachrichten);
	$tmpl->addVars('haupt',$daten);
	$tmpl->addVar('haupt','ZUGANG','ja');
}


$db->close();
$tmpl->displayParsedTemplate();

?>
