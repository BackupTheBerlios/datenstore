<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'check.inc');  // Formularkontrolle
include_once(PHP_PFAD.'function.inc');  // zentrale Funktionsklasse

if($anlegen){
	$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass); // Verbindung zur Datenbank
	$db->connect();
	
	$kontrolle = new check;
	
		/* Feldueberpruefung 
			Parameter: Name des Feldes als String (Grossschreibung)
			Parameter: Inhalt des Feldes als Variable (Grossschreibung)
			Parameter: Typ des Feldes als String
			Parameter: max. Laenge des Feldes als Zahl
			Parameter: Prioritaet des Feldes  1 = Pflicht , 0 = keine Pflicht
		*/
		$kontrolle->init('NAME',$HTTP_POST_VARS[NAME],'name',20,1);
		$kontrolle->init('VORNAME',$HTTP_POST_VARS[VORNAME],'name',20,1);
		$kontrolle->init('PASSWORT',$HTTP_POST_VARS[PASSWORT],'name',20,1);
		$kontrolle->init('BENUTZERNAME',$HTTP_POST_VARS[BENUTZERNAME],'name',20,1);
		$farbe=$kontrolle->farb_ausgabe();  // Ausgabe des Fehler - Farbenarray
		$fehler=$kontrolle->zaehler_ausgabe(); // Ausgabe der Fehlerzahl 1= Fehler , 0 = O.K.
		
		
		if($fehler==0){
			$query1="insert into user (Name,Vorname,Passwort,Benutzername) values('$HTTP_POST_VARS[NAME]','$HTTP_POST_VARS[VORNAME]','$HTTP_POST_VARS[PASSWORT]','$HTTP_POST_VARS[BENUTZERNAME]')";
			$abfrage1=$db->query($query1);
			$letzte_id=$db->insert_id();
			$query2="insert into adresse (user_id) values('$letzte_id')";
			$abfrage2=$db->query($query2);
			 
			$db->close();
			header("Location: ../aendern/aendern.php"); // Umlenkung auf Modul 'aendern'
		}
		else{
			$tmpl = new patTemplate();
			$tmpl->setBasedir(T_ANLEGEN);
			$tmpl->readTemplatesFromFile('anlegen.ihtml');
			$tmpl->addVars('haupt',$farbe);
			$tmpl->addVars('haupt',$HTTP_POST_VARS);
			$tmpl->addVar('haupt','ANZEIGE','test');
			$tmpl->displayParsedTemplate();
		}
}


if(!$anlegen){
	$tmpl = new patTemplate();
	$tmpl->setBasedir(T_ANLEGEN);
	$tmpl->readTemplatesFromFile('anlegen.ihtml');
	$tmpl->addVar('haupt','ANZEIGE','test');
	$tmpl->displayParsedTemplate();
}

?>
