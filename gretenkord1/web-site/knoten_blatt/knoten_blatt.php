<?
/*********** Modulsteuerung 'knoten_blatt' ****************************/

/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc'); // zentrale Funktionsklasse

/********* lokale Includedateien ****************/
include_once(PHP_KNOTEN_BLATT.'/knoten_blatt_function.inc');  // lokale Funktionssammlung

$tmpl = new patTemplate();
$tmpl->setBasedir(T_KNOTEN_BLATT);
$tmpl->readTemplatesFromFile('knoten_blatt.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass); // Verbindung zur Datenbank
$db->connect();

/********************* loeschen von Knoten ***************/
if($HTTP_POST_VARS[loeschen_knoten]){
	$query1="select blatt_id from knoten1_blatt1 where knoten_id=$HTTP_POST_VARS[knoten_id]";
	$antwort1=$db->query($query1);
	$blatt_array=array_bildung_simpel($antwort1);  // Bestimmung der zu loeschenden Blaetter
	blatt_loeschen($db,$blatt_array);  // loeschen der Blaetter die zum Knoten gehoeren
	knoten1_blatt1_loeschen($db,$HTTP_POST_VARS[knoten_id]);  // loeschen Eintraege in Brueckentabelle
	$query1="delete from knoten1 where knoten_id=$HTTP_POST_VARS[knoten_id]";
	$antwort1=$db->query($query1);
	unset($HTTP_POST_VARS[loeschen_knoten]);
}

/**************** hinzufuegen von Knoten **************/
if($HTTP_POST_VARS[hinzufuegen_knoten]){
	$HTTP_POST_VARS[knoten_info]=htmlentities($HTTP_POST_VARS[knoten_info]);
	$query1 ="insert into knoten1 (knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info) ";
	$query1 .="values ('$HTTP_POST_VARS[knoten_name]', ";
	$query1 .="'$HTTP_POST_VARS[knoten_pfad]', ";
	$query1 .="'$HTTP_POST_VARS[knoten_verzeichnis]', ";
	$query1 .="'$HTTP_POST_VARS[knoten_info]')";
	$antwort1=$db->query($query1);
	unset($HTTP_POST_VARS[hinzufuegen_knoten]);
}


/************************** Veraenderung der Knoteneinstellungen ******************/
if($HTTP_POST_VARS[aendern_knoten]){
	if($HTTP_POST_VARS[aktiv_knoten]=='on') $HTTP_POST_VARS[aktiv_knoten]='checked';
	$query1 ="update knoten1 set knoten_name='$HTTP_POST_VARS[knoten_name]', ";
	$query1 .="knoten_pfad='$HTTP_POST_VARS[knoten_pfad]', ";
	$query1 .="knoten_verzeichnis='$HTTP_POST_VARS[knoten_verzeichnis]', ";
	$query1 .="knoten_aktiv='$HTTP_POST_VARS[aktiv_knoten]' ";
	$query1 .="where knoten_id=$knoten_id";
	$antwort1=$db->query($query1);
	unset($HTTP_POST_VARS[aendern_knoten]);
}

/********************************************* Anzeige der Knoten ************************************/
if(!$HTTP_POST_VARS[aendern_knoten] and !$HTTP_POST_VARS[loeschen_knoten]
	and !$HTTP_POST_VARS[info_knoten] and !$HTTP_POST_VARS[blatt] and !$HTTP_POST_VARS[hinzufuegen_knoten]){
	
	$query1="select * from knoten1 order by knoten_name";
	$antwort1=$db->query($query1);
	$antwort1=array_bildung($antwort1);
	$tmpl->setAttribute('knoten','visibility','visibility');
	$tmpl->setAttribute('knoten_liste','visibility','visibility');
	$verzeichnis=verzeichnis(KUNDE);  // Abfrage der Verzeichnisse
	$verzeichnis1=verzeichnis_simple($verzeichnis);
	$tmpl->addVar('knoten','KNOTEN_VERZEICHNIS1',$verzeichnis1);
	$antwort1[knoten_pfad]=seite_pulldown($antwort1[knoten_pfad]);
	$antwort1[knoten_verzeichnis]=knoten_pulldown($verzeichnis,$antwort1[knoten_verzeichnis]);
	$tmpl->addVars('knoten_liste',$antwort1);
}

/******************* hinzufuegen eines Blatt ********************************/
if($HTTP_POST_VARS[hinzufuegen_blatt]){
	$HTTP_POST_VARS[blatt_info]=htmlentities($HTTP_POST_VARS[blatt_info]);
	$query1 ="insert into blatt1 (blatt_name, blatt_pfad, blatt_verzeichnis, blatt_info) ";
	$query1 .="values ('$HTTP_POST_VARS[blatt_name]', ";
	$query1 .="'$HTTP_POST_VARS[blatt_pfad]', ";
	$query1 .="'$HTTP_POST_VARS[blatt_verzeichnis]', ";
	$query1 .="'$HTTP_POST_VARS[blatt_info]')";
	$antwort1=$db->query($query1);  // eintragen neues Blatt in 'blatt1'
	$last_id=$db->insert_id();
	$query1="insert into knoten1_blatt1 (knoten_id, blatt_id) values ('$HTTP_POST_VARS[knoten_id]', '$last_id')";
	$db->query($query1);  // eintragen Beziehung in 'knoten1_blatt1'
	unset($HTTP_POST_VARS[hinzufuegen_blatt]);
}



/************************ Blaetter aendern ***************************/
if($HTTP_POST_VARS[blatt] and $HTTP_POST_VARS[aendern_blatt]){
	if($HTTP_POST_VARS[aktiv_blatt]=='on') $HTTP_POST_VARS[aktiv_blatt]='checked';
	$query1 ="update blatt1 set blatt_name='$HTTP_POST_VARS[blatt_name]', ";
	$query1 .="blatt_pfad='$HTTP_POST_VARS[blatt_pfad]', ";
	$query1 .="blatt_verzeichnis='$HTTP_POST_VARS[blatt_verzeichnis]', ";
	$query1 .="blatt_aktiv='$HTTP_POST_VARS[aktiv_blatt]' ";
	$query1 .="where id=$HTTP_POST_VARS[blatt_id]";
	$antwort1=$db->query($query1);
	unset($HTTP_POST_VARS[aendern_blatt]);
}

/*************************** Blaetter loeschen *******************************/
if($HTTP_POST_VARS[blatt] and $HTTP_POST_VARS[loeschen_blatt]){
	$query="delete from blatt1 where id=$HTTP_POST_VARS[blatt_id]";
	$db->query($query);
	$query="delete from knoten1_blatt1 where blatt_id=$HTTP_POST_VARS[blatt_id]";
	$db->query($query);
	unset($HTTP_POST_VARS[loeschen_blatt]);
}


/****************************************** Anzeige der Blaetter ***************************************/
if($HTTP_POST_VARS[blatt]){
	$tmpl->addVar('blatt','KNOTENNAME',$HTTP_POST_VARS[knoten_name]);  // Blattname fuer Ueberschrift
	$tmpl->addVar('blatt','KNOTEN_ID',$HTTP_POST_VARS[knoten_id]);  // Knoten - ID
	$tmpl->addVar('blatt_liste','KNOTENNAME',$HTTP_POST_VARS[knoten_name]);  // Blattname fuer Formular
	$tmpl->addVar('blatt_liste','KNOTEN_ID',$HTTP_POST_VARS[knoten_id]);  // Knoten - ID fuer Formular
	$tmpl->setAttribute('blatt','visibility','visibility');
	$query1="select blatt_id from knoten1_blatt1 where knoten_id=$HTTP_POST_VARS[knoten_id]";
	$antwort1=$db->query($query1);
	$blatt_array=array_bildung_simpel($antwort1);  // Bestimmung der Blaetter des Knoten
	$antwort1=welche_blaetter($db,$blatt_array);  // Bildung Array der Blattinformationen
	$tmpl->setAttribute('blatt_liste','visibility','visibility');
	$verzeichnis=verzeichnis(KUNDE);  // Abfrage der Verzeichnisse
	$verzeichnis1=verzeichnis_simple($verzeichnis);
	$tmpl->addVar('blatt','BLATT_VERZEICHNIS1',$verzeichnis1);  // Liste der Verzeichnisse fuer Neueintrag
	$antwort1[blatt_verzeichnis]=knoten_pulldown($verzeichnis,$antwort1[blatt_verzeichnis]);  // welches Verzeichnis ist aktiv
	$antwort1[blatt_pfad]=seite_pulldown($antwort1[blatt_pfad]);  // welche Blattform ist aktiv
	$tmpl->addVars('blatt_liste',$antwort1);
}

$tmpl->displayParsedTemplate();
//$tmpl->dump();
$db->close();  // Verbindung zur Datenbank aufheben
?>
