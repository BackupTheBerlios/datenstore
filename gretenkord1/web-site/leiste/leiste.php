<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc');  // allgemeine Funktionen

/********** locale Includedateien ***************/
include_once(PHP_LEISTE.'leiste_function.inc');


$tmpl = new patTemplate();
$tmpl->setBasedir(T_LEISTE);
$tmpl->readTemplatesFromFile('leiste.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$db->connect();

if($absenden){  // Eroeffnungsmenue des CMS
	$query1="select * from user"; // Anfrage 1
	$abfrage1=$db->query($query1);
	$zugang=start_passwort($abfrage1,$benutzer,$passwd);
}

if($zugang){
	$query1="select rechte_id from rechte_user where user_id='$zugang[id]'";
	$abfrage1=$db->query($query1);
	$i=0; // Zaehler fuer 
	$j=0;
	while($wert=$abfrage1->fetch_array(patDBC_TYPEASSOC)){  // Datensaetze aus Tabelle 'rechte_user'
		foreach($wert as $inhalt){
			$ausgabe[$i]=$inhalt;
			$query3="select Rechte_Art,Modul,Formular from rechte where id='$ausgabe[$i]'";  // Zuordnung 'Rechte-Name' zu 'rechte-id'
			$abfrage3=$db->query($query3);
			while($wert=$abfrage3->fetch_array(patDBC_TYPEASSOC)){ // Abrufen eines Datensatzes
				if($wert[Formular]=='kein'){
					$ausgabe1[Modul][$i]=$wert[Modul];
					$ausgabe1[Rechte_Art][$i]=$wert[Rechte_Art];
					$i++;
				}
				else{
					$ausgabe2[USER_ID][$j]=$zugang[id];
					$ausgabe2[Formular][$j]=$wert[Formular];
					$ausgabe2[Name_Formular][$j]=$wert[Rechte_Art];
					$j++;
				}
			}
		}
	}
	$tmpl->setAttribute('person','visibility','visibility');
	$tmpl->setAttribute('navi','visibility','visibility');
	$tmpl->addVars('navi',$ausgabe1);
	$tmpl->setAttribute('formulare','visibility','visibility');
	$tmpl->addVars('formulare',$ausgabe2);
	$tmpl->addVar('person','PERSON_ID',$zugang[id]);
	$tmpl->setAttribute('logout','visibility','visibility');
}
	
$db->close();
$tmpl->displayParsedTemplate();
gz_output();
?>
