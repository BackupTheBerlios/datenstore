<?
/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse

/********* lokale Includedateien ****************/
include_once(PHP_AENDERN.'/aendern_function.inc');  // lokale Funktionssammlung

$tmpl = new patTemplate();
$tmpl->setBasedir(T_AENDERN);
$tmpl->readTemplatesFromFile('aendern.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass); // Verbindung zur Datenbank
$db->connect();

/********* Steuerung Anzeigen der Userdaten und Rechte *********/
if($aendern){
	if($aendern_erfolgt){
		// Update der Userdaten in Tabelle 'user'
		$query1 = "update user SET user.Name='$name', user.Vorname='$vorname', ";
		$query1 .= "user.Passwort='$passwort', user.Benutzername='$benutzer', user.Bemerkung='$bemerkung', user.aktiv='$aktiv', user.Anrede='$anrede' ";
		$query1 .= "where user.id=$aendern_hidden";
		$anfrage1 = $db->query($query1);
		
			// Update der Userdaten in Tabelle 'adresse'
		$query1 = "update adresse SET adresse.PLZ='$plz', adresse.Ort='$ort', adresse.Strasse='$strasse', adresse.Nr='$nr', ";
		$query1 .= "adresse.Telefon='$telefon', adresse.Handy='$handy', adresse.EMail='$email', adresse.Fax='$fax', ";
		$query1 .="adresse.adresse_bestaetigt='$adresse_bestaetigt' ";
		$query1 .= "where adresse.user_id=$aendern_hidden";
		$anfrage1 = $db->query($query1);
		
		  // Update der Userrechte in Brueckentabelle 'rechte_user'
		$query1="delete from rechte_user where user_id=$aendern_hidden";
		$anfrage1=$db->query($query1); // loeschen der alten Rechte
		rechte_anlegen($db,$aendern_hidden,$rechte_check); // eintragen der neuen User - Rechte
	}

	
	/*********** Anzeige Personendaten *******************/
	$query1 = "select * from user,adresse where user.id=$aendern_hidden and adresse.user_id=$aendern_hidden";
	$anfrage1 = $db->query($query1);
	// $anfrage1->dump();
	$antwort1 = array_bildung($anfrage1);  // Personendaten
	$tmpl->setAttribute('person','visibility','visibility');
	$tmpl->setAttribute('rechte','visibility','visibility');
	$tmpl->setAttribute('fuss','visibility','visibility');
	
	if($antwort1[aktiv][0]=='aktiv'){  // Bestimmung ob User aktiv / inaktiv
		$tmpl->addVar('person','ZUSTAND_AKTIV','checked');
	}
	else{
		$tmpl->addVar('person','ZUSTAND_PASSIV','checked');
	}
	
	$antwort1[datum][0]=zeit_verbesserung($antwort1[datum][0]);  // Umwandlung Datum
	
	if($antwort1[adresse_bestaetigt][0]=='ja'){  // Bestimmung ob Adresse unbestaetigt /bestaetigt
		$tmpl->addVar('person','ADRESSE_AKTIV','checked');
	}
	else{
		$tmpl->addVar('person','ADRESSE_INAKTIV','checked');
	}
	
	$anzahl_adressen=count($antwort1[PLZ]);  // Bestimmung Anzahl der Useradressen
	$tmpl->addVar('person','WEITERE_ADRESSEN',$anzahl_adressen);
	
	$tmpl->addVars('person',$antwort1);
	
	$query1="select * from rechte order by id";  // Ermittlung aller Rechte und anzeigen
	$anfrage1=$db->query($query1);
	$anfrage1=array_bildung($anfrage1);
	
	$query2="select user_id,rechte_id from rechte_user where user_id=$aendern_hidden order by id";
	$anfrage2=	$db->query($query2);
	$anfrage2=array_bildung($anfrage2);
	
	/******** Bestimmung ob Recht schon vergeben ************/
	 $anzahl1=count($anfrage1[id]);  // Anzahl aller Elemente der Rechte
	 $anzahl2=count($anfrage2[user_id]); // Anzahl der Rechte die der User hat
	
	for($i=0;$i<$anzahl2;$i++){
		for($j=0;$j<$anzahl1;$j++){
			if($anfrage2[rechte_id][$i]==$anfrage1[id][$j]){
				$anfrage1[checked][$j]="checked";
			}
		}
	}
	
	$anfrage1=veraenderung_array_text('Beschreibung',$anfrage1);  // Umsetzung eines Textes nach 'Html'
	$anfrage1=veraenderung_array_text('Rechte_Art',$anfrage1);
	$tmpl->addVars('rechte',$anfrage1);
}

/************ Steuerung loeschen von User **************/
if($loeschen){
	$query1 = "delete from user where user.id=$loeschen_hidden";
	$antwort1 = $db->query($query1);
	$query1 = "delete from adresse where adresse.user_id=$loeschen_hidden";
	$antwort1 = $db->query($query1);
	unset($loeschen);
}

/********* Steuerung Auflistung der User ******************/
if(!$aendern and !$loeschen){
	$query1="select * from user order by Name,Vorname";  // Sql - Anfrage
	$anfrage1=$db->query($query1);
	// $anfrage1->dump();
	$antwort1=array_bildung($anfrage1);  // Funktion zur Erstellung des Antwortarray
	$tmpl->setAttribute('liste_sichtbar','visibility','visibility');
	$tmpl->addVars('liste',$antwort1);
}

$tmpl->displayParsedTemplate();
$db->close();  // Verbindung zur Datenbank aufheben
?>
