<?
/********* Modul zum erstellen der Navigation ***************/

/********** globale Includedateien *******************/
include_once('patTemplate.inc'); // Templatklasse
include_once('patDbc.inc'); // Datenbankklasse
include_once('function.inc');  // Funktionsdatei
include_once('key.inc');  // Schluesseldatei

$tmpl = new patTemplate();
$tmpl->setBasedir(KNOTEN_PFAD);
$tmpl->readTemplatesFromFile('navigation.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$zugang = $db->connect();


if($knoten==NULL){ // Erststart wenn kein '$knoten' - Modul gewaehlt
	$query1="select * from knoten1 order by knoten_id";
	$abfrage1=$db->query($query1);
	$abfrage1=array_bildung($abfrage1);
	$abfrage1=knoten_pfad($abfrage1);
	$tmpl->setAttribute('knoten_oben_passiv','visibility','visibility');
	$tmpl->addVars('knoten_oben_passiv',$abfrage1);
}
else{
	if($blatt==NULL){  // wenn kein Blatt gewaehlt werden alle Knoten dargestellt die inaktiv sind
		echo "kein Blatt gewaehlt !";
		$query1="select * from knoten1 where knoten_id<$knoten order by knoten_id";
	}
	else{
		$query1="select * from knoten1 where knoten_id<=$knoten order by knoten_id";  // wenn ein Blatt gewaehlt
	}
	
	$abfrage1=$db->query($query1);
	if($abfrage1->num_rows()>0){
		$abfrage1=array_bildung($abfrage1);
		$abfrage1=knoten_pfad($abfrage1);
		$tmpl->setAttribute('knoten_oben_passiv','visibility','visibility');
		$tmpl->addVars('knoten_oben_passiv',$abfrage1);
	}
	
	if($blatt==NULL){  // Darstellung aktiver Knoten wenn kein Blatt gewaehlt
		$query1="select * from knoten1 where knoten_id=$knoten order by knoten_id";
		$abfrage1=$db->query($query1);
		$abfrage1=array_bildung($abfrage1);
		$abfrage1=knoten_pfad($abfrage1);
		$tmpl->setAttribute('knoten_oben_aktiv','visibility','visibility');
		$tmpl->addVars('knoten_oben_aktiv',$abfrage1);
	}
	
	// Darstellung aller Blaetter eines Knoten
	$query1="select * from blatt1,knoten1_blatt1 where knoten1_blatt1.knoten_id=$knoten and knoten1_blatt1.blatt_id=blatt1.id";
	$abfrage1=$db->query($query1);
	if($abfrage1->num_rows()>0){
		if($blatt==NULL){  // wenn kein Blatt gewaehlt
			$abfrage1=array_bildung($abfrage1);
			$abfrage1=blatt_pfad($knoten,$abfrage1);  // Umsetzung des Blattpfades
			$tmpl->setAttribute('blatt_oben','visibility','visibility');
			$tmpl->addVars('blatt_oben',$abfrage1);
		}
		else{  // wenn ein Blatt gewaehlt
			// Darstellung der inaktiven Blaetter
			$query1="select * from blatt1,knoten1_blatt1 where knoten1_blatt1.knoten_id=$knoten and knoten1_blatt1.blatt_id=blatt1.id and blatt1.id<$blatt";
			$abfrage1=$db->query($query1);
			if($abfrage1->num_rows()>0){
				$abfrage1=array_bildung($abfrage1);
				$abfrage1=blatt_pfad($knoten,$abfrage1);  // Umsetzung des Blattpfades
				$tmpl->setAttribute('blatt_oben','visibility','visibility');
				$tmpl->addVars('blatt_oben',$abfrage1);
			}
			
			// Darstellung des aktiven Blattes
			$query1="select * from blatt1,knoten1_blatt1 where knoten1_blatt1.knoten_id=$knoten and knoten1_blatt1.blatt_id=blatt1.id and blatt1.id=$blatt";
			$abfrage1=$db->query($query1);
			if($abfrage1->num_rows()>0){
				$abfrage1=array_bildung($abfrage1);
				$abfrage1=blatt_pfad($knoten,$abfrage1);  // Umsetzung des Blattpfades
				$tmpl->setAttribute('blatt_mitte','visibility','visibility');
				$tmpl->addVars('blatt_mitte',$abfrage1);
			}
			
			// Darstellung der 'restlichen' inaktiven Blaetter
			$query1="select * from blatt1,knoten1_blatt1 where knoten1_blatt1.knoten_id=$knoten and knoten1_blatt1.blatt_id=blatt1.id and blatt1.id>$blatt";
			$abfrage1=$db->query($query1);
			if($abfrage1->num_rows()>0){
				$abfrage1=array_bildung($abfrage1);
				$abfrage1=blatt_pfad($knoten,$abfrage1);  // Umsetzung des Blattpfades
				$tmpl->setAttribute('blatt_unten','visibility','visibility');
				$tmpl->addVars('blatt_unten',$abfrage1);
			}
		}
	}
	
	// Darstellung der 'restlichen' inaktiven Blaetter
	$query1="select * from knoten1 where knoten_id>$knoten order by knoten_id";
	$abfrage1=$db->query($query1);
	if($abfrage1->num_rows()>0){
		$abfrage1=array_bildung($abfrage1);
		$abfrage1=knoten_pfad($abfrage1);
		$tmpl->setAttribute('knoten_unten_passiv','visibility','visibility');
		$tmpl->addVars('knoten_unten_passiv',$abfrage1);
	}
}

$tmpl->displayParsedTemplate();
$db->close();
?>
