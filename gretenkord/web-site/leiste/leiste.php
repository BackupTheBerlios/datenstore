<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse

include_once(PHP_PFAD.'function.inc');  // allgemeine Funktionen


$tmpl = new patTemplate();
$tmpl->setBasedir(T_LEISTE);
$tmpl->readTemplatesFromFile('leiste.ihtml');
// $tmpl->dump();
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass); // Verbindung zur Datenbank
$db->connect();

if($absenden){  // Eroeffnungsmenue des CMS
	$query1="select id,Benutzername,Passwort from user"; // Anfrage 1
	$abfrage1=$db->query($query1);
	// $abfrage1->dump();  // Kontrolle fuer Anfrage 1
	$zugang=passwort($abfrage1,$benutzer,$passwd);
}

if($zugang[erlaubt]=='ja'){
	$query2="select rechte_id from rechte_user where user_id='$zugang[id]'";
	$abfrage2=$db->query($query2);
	$i=0;
	while($wert=$abfrage2->fetch_array(patDBC_TYPEASSOC)){
		foreach($wert as $inhalt){
			$ausgabe[$i]=$inhalt;
			$query3="select Rechte_Art,Modul from rechte where id='$ausgabe[$i]'";
			$abfrage3=$db->query($query3);
			while($wert=$abfrage3->fetch_array(patDBC_TYPEASSOC)){ // Abrufen eines Datensatzes
				foreach($wert as $name => $inhalt){ // Zerlegung Datensatz in Array
					$ausgabe[$name][$i]=$inhalt;
				}
			}
		}
	$i++;
	}
	$tmpl->addVar('person','PERSON_ID',$zugang[id]);
	$tmpl->addVar('navi','ID',$zugang[id]);
	$tmpl->addVars('navi',$ausgabe);
}
	
$db->close();
$tmpl->displayParsedTemplate();
?>
