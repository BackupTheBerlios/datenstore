<?
class tree{
	/********** anzupassende Werte ************/
	var $pfad="c:/php/navigation/";  // Pfad
	var $db_host="localhost";  // Datenbankhost
	var $db_user="walter";  // User
	var $db_passwd="walter";  // Passwort
	var $db_database="verwaltung"; // Datenbank
	
	var $verbindung; // MySql - Handle
	var $datenbank;  // Datenbank - Handle
	var $anzahl_knoten;  // Anzahl der Knoten - Datensaetze
	var $knoten_array; // Array aller Knoten
	var $blatt_array;  // Array aller Blaetter, die zu einem Knoten gehoeren
	var $knoten;  // Knoten der aktiv ist
	var $blatt;  // Blatt das aktiv ist
	
	var $knoten_schnitt; // an welcher Stelle muss das Knoten-Array geschnitten werden
	var $blatt_schnitt=false; // an welcher Stelle muss das Blatt-Array geschnitten werden
	
	/*********************** Rueckgabewerte ************************/
	var $knoten_array_oben_passiv; // Knoten oberhalb passiv
	var $knoten_block_oben_passiv="hidden"; // Knotenblock passiv oberhalb
	var $knoten_array_oben_aktiv; // Knoten oberhalb aktiv
	var $knoten_block_oben_aktiv="hidden"; // Knotenblock aktiv oberhalb
	
	var $blatt_array_oben;  // Blatt - Array oben
	var $blatt_block_oben="hidden";  // Blatt - Block oben
	var $blatt_array_mitte;  // Blatt - Array mitte
	var $blatt_block_mitte="hidden";  // Blatt - Block mitte
	var $blatt_array_unten;  // Blatt - Array unten
	var $blatt_block_unten="hidden";  // Blatt - Block unten
	
	var $knoten_array_unten_passiv; // Knoten oberhalb passiv
	var $knoten_block_unten_passiv="hidden"; // Knotenblock passiv oberhalb
	
	
	
	/**
	* Konstruktor
	*  Zuordnung von Variablen
	*  Steuerung der Funktionen
	*/
	function tree($knoten=false,$blatt=false){
		$this->knoten=$knoten;
		$this->blatt=$blatt;
		$this->verbindung= mysql_connect ($this->db_host,$this->db_user,$this->db_passwd); // Datenbankverbindung
		$this->alle_knoten();  // Bestimmung aller Knoten
		
		if($this->knoten) $this->blaetter_zu_knoten();
		mysql_close($this->verbindung);
	}
	
	
	/**
	* Abrufen aller Knoten des Baumes
	*/
	function alle_knoten(){
		$result=mysql_db_query($this->db_database,"select * from knoten1 order by knoten_id");
		while($arr1=mysql_fetch_array($result,MYSQL_ASSOC)){
			$this->knoten_array[knoten_id][$arr1[knoten_id]]=$arr1[knoten_id];  // knoten_id
			$this->knoten_array[knoten_name][$arr1[knoten_id]]=$arr1[knoten_name];  // knoten_name
			$this->knoten_array[knoten_pfad][$arr1[knoten_id]]=$this->pfad.$arr1[knoten_id]."/".$arr1[knoten_pfad]; // knoten_pfad
			// $this->kontrolle($arr1);
		}
		mysql_free_result($result);
		$this->schnittstelle_knoten();
		$this->knoten_zerlegung();
	}
	
	/**
	* Bestimmung der Blaetter die zu einem Knoten gehoeren
	*/
	function blaetter_zu_knoten(){
		$query="select * from knoten1_blatt1,blatt1 where knoten1_blatt1.knoten_id=$this->knoten and blatt_id=blatt1.id order by blatt_id";
		$abfrage1=mysql_db_query('verwaltung',$query,$this->verbindung);
		$i=0;
		while($arr=mysql_fetch_array($abfrage1,MYSQL_ASSOC)){
			$this->blatt_array[blatt_id][$i]=$arr[blatt_id];  // blatt_id
			$this->blatt_array[blatt_name][$i]=$arr[blatt_name];  // blatt_name
			$this->blatt_array[knoten_id][$i]=$arr[knoten_id];  // knoten_id
			$this->blatt_array[blatt_pfad][$i]=$this->pfad.$this->knoten."/".$arr[blatt_pfad];  // blatt_pfad
			if($this->blatt==$arr[blatt_id]){ // Ermittlung Blattschnitt
				$this->blatt_schnitt=$i;
			}
			$i++;
		}
	//$this->kontrolle($arr);
	$this->blatt_zerlegung();
	}
	
	/**
	* Funktion zur Zerlegung des Blattarray
	*
	*/
	function blatt_zerlegung(){
		if($this->blatt_schnitt){
			$anzahl=count($this->blatt_array[blatt_id]);
			for($i=0;$i<$anzahl;$i++){
				if($i<$this->blatt_schnitt){
					$this->blatt_array_oben[blatt_id][$i]=$this->blatt_array[blatt_id][$i];
					$this->blatt_array_oben[blatt_name][$i]=$this->blatt_array[blatt_name][$i];
					$this->blatt_array_oben[knoten_id][$i]=$this->blatt_array[knoten_id][$i];
					$this->blatt_array_oben[blatt_pfad][$i]=$this->blatt_array[blatt_pfad][$i];
					$this->blatt_block_oben="visibility";
				}
				if($i==$this->blatt_schnitt){
					$this->blatt_array_mitte[blatt_id][$i]=$this->blatt_array[blatt_id][$i];
					$this->blatt_array_mitte[blatt_name][$i]=$this->blatt_array[blatt_name][$i];
					$this->blatt_array_mitte[knoten_id][$i]=$this->blatt_array[knoten_id][$i];
					$this->blatt_array_mitte[blatt_pfad][$i]=$this->blatt_array[blatt_pfad][$i];
					$this->blatt_block_mitte="visibility";
				}
				if($i>$this->blatt_schnitt){
					$this->blatt_array_unten[blatt_id][$i]=$this->blatt_array[blatt_id][$i];
					$this->blatt_array_unten[blatt_name][$i]=$this->blatt_array[blatt_name][$i];
					$this->blatt_array_unten[knoten_id][$i]=$this->blatt_array[knoten_id][$i];
					$this->blatt_array_unten[blatt_pfad][$i]=$this->blatt_array[blatt_pfad][$i];
					$this->blatt_block_unten="visibility";
				}
			}
		}
		else{
			$this->blatt_array_oben=$this->blatt_array;
			$this->blatt_block_oben="visibility";
		}
	}
	
	/**
	*	Zerlegung des Knotenarray
	*/
	function knoten_zerlegung(){
		foreach($this->knoten_array as $name => $inhalt){
			if($this->knoten==false and $this->blatt==false){
				$this->knoten_array_oben_passiv=$this->knoten_array;
				$this->knoten_block_oben_passiv="visibility";
			}
			if($this->knoten==true and $this->blatt==false){
				$this->knoten_array_oben_passiv[$name]=array_slice($this->knoten_array[$name],0,$this->knoten_schnitt);
				$this->knoten_block_oben_passiv="visibility";
				
				$this->knoten_array_oben_aktiv[$name]=array_slice($this->knoten_array[$name],$this->knoten_schnitt,1);
				$this->knoten_block_oben_aktiv="visibility";
				
		$this->knoten_array_unten_passiv[$name]=array_slice($this->knoten_array[$name],$this->knoten_schnitt+1,$this->anzahl_knoten-1);
				$this->knoten_block_unten_passiv="visibility";
				
			}
			if($this->knoten==true and $this->blatt==true){
				$this->knoten_array_oben_passiv[$name]=array_slice($this->knoten_array[$name],0,$this->knoten_schnitt+1);
				$this->knoten_block_oben_passiv="visibility";
				
				$this->knoten_array_unten_passiv[$name]=array_slice($this->knoten_array[$name],$this->knoten_schnitt+1,$this->anzahl_knoten-1);
				$this->knoten_block_unten_passiv="visibility";
			}
		}
	}
	
	
	/**
	* Bestimmung des Knotenschnittpunktes
	*/
	function schnittstelle_knoten(){
		$test1=array_slice($this->knoten_array,0,1);  // Zerlegung in Einzelarray
		foreach($test1 as $name => $inhalt){
			$i=0;
			$this->anzahl_knoten=count($inhalt);  // Bestimmung der Anzahl der Datensaetze - Knoten
			foreach($inhalt as $name1 => $inhalt1){
				if($name1==$this->knoten){
					$this->knoten_schnitt=$i;  // Bestimmung Knoten - Schnittstelle
				}
				$i++;
			}
		}
	}
	
	
	/**
	* Kontrollfunktion zur Ueberpruefung eines 2 - dimensionalen Array
	*/
	function kontrolle($test){
		foreach($test as $name => $inhalt){
			echo "Name: $name mit Inhalt: $inhalt<br>";
		}
	}
}


/********************* Ende Klasse ****************/

/**
* Aufruf des Objektes mit
*  Knoten = 1
*  Blatt = 1
*	
* Rueckgabewerte:
*		$baum->knoten_array_oben_passiv , Rueckgabe des passiven oberen Knoten - Array
*		$baum->knoten_block_oben_passiv , Sichtbarkeit des passiven oberen Knoten - Array
*
*		$baum->knoten_array_oben_aktiv , Rueckgabe des aktiven oberen Knoten - Array
		$baum->knoten_block_oben_aktiv , Sichtbarkeit des aktiven oberen Knoten - Array
*
*		$baum->knoten_array_unten_passiv , Rueckgabe des passiven unteren Knoten - Array
*		$baum->knoten_block_unten_passiv , Sichtbarkeit des passiven unteren Knoten - Array
*/

/************* globale Includedateien ***********************/
include_once('patTemplate.inc');


/************* Ausgangswerte **************/
//$knoten=3;
//$blatt=8;

$tmpl = new patTemplate();
$tmpl->setBasedir('c:/php/navigation');
$tmpl->readTemplatesFromFile('navigation1.ihtml');

$baum = new tree($knoten,$blatt);

$tmpl->setAttribute('knoten_oben_passiv','visibility',$baum->knoten_block_oben_passiv);
$tmpl->addVars('knoten_oben_passiv',$baum->knoten_array_oben_passiv);

$tmpl->setAttribute('knoten_oben_aktiv','visibility',$baum->knoten_block_oben_aktiv);
$tmpl->addVars('knoten_oben_aktiv',$baum->knoten_array_oben_aktiv);


$tmpl->setAttribute('blatt_oben','visibility',$baum->blatt_block_oben);
$tmpl->addVars('blatt_oben',$baum->blatt_array_oben);

$tmpl->setAttribute('blatt_mitte','visibility',$baum->blatt_block_mitte);
$tmpl->addVars('blatt_mitte',$baum->blatt_array_mitte);

$tmpl->setAttribute('blatt_unten','visibility',$baum->blatt_block_unten);
$tmpl->addVars('blatt_unten',$baum->blatt_array_unten);


$tmpl->setAttribute('knoten_unten_passiv','visibility',$baum->knoten_block_unten_passiv);
$tmpl->addVars('knoten_unten_passiv',$baum->knoten_array_unten_passiv);

$tmpl->dump();
$tmpl->displayParsedTemplate();

//echo "Sichtbarkeit: ".$baum->blatt_block_unten;
//kontrolle($baum->blatt_array_unten);

function kontrolle($test){
	foreach($test as $name => $inhalt){
		foreach($inhalt as $name1 => $inhalt1){
			echo "Teilarray: $name mit Name: $name1 Inhalt: $inhalt1<br>";
		}
	}
}
?>
