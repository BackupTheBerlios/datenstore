<?
class tree{
	/********** anzupassende Werte ************/
	var $pfad="c:/php/navigation/";  // Pfad
	var $db_host="localhost";  // Datenbankhost
	var $db_user="walter";  // User
	var $db_passwd="walter";  // Passwort
	var $db_database="verwaltung"; // Datenbank
	
	var $verbindung; // Datenbankverbindung
	var $knoten_array; // Array aller Knoten
	var $blatt_array;  // Array aller Blaetter, die zu einem Knoten gehoeren
	var $knoten;  // Knoten der aktiv ist
	var $blatt;  // Blatt das aktiv ist
	
	var $knoten_schnitt; // an welcher Stelle muss das Knoten-Array geschnitten werden
	var $blatt_schnitt; // an welcher Stelle muss das Blatt-Array geschnitten werden
	
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
		$this->datenbank_verbindung();  // Datenbankverbindung
		$this->alle_knoten();  // Bestimmung aller Knoten
		if($this->knoten) $this->blaetter_zu_knoten();
		
		mysql_close($this->verbindung);
	}
	
	/**
	* Datenbankverbindung
	*/
	function datenbank_verbindung(){
		$this->verbindung= mysql_connect ($this->db_host,$this->db_user,$this->db_passwd); // Datenbankverbindung
	}	
	
	/**
	* Abrufen aller Knoten des Baumes
	*/
	function alle_knoten(){
		$query="select * from knoten1 order by knoten.knoten_id";
		$abfrage=mysql_db_query($this->db_database,$query,$this->verbindung);
		while($arr1=mysql_fetch_array($abfrage,MYSQL_ASSOC)){
			$this->knoten_array[knoten_id][$arr1[knoten_id]]=$arr1[knoten_id];  // knoten_id
			$this->knoten_array[knoten_name][$arr1[knoten_id]]=$arr1[knoten_name];  // knoten_name
			$this->knoten_array[knoten_pfad][$arr1[knoten_id]]=$this->pfad.$arr1[knoten_id]."/".$arr1[knoten_pfad]; // knoten_pfad
			// $this->kontrolle($arr1);
		}
		
		// $this->schnittstelle_knoten();
		// $this->knoten_zerlegung();
	}
	
	/**
	* Bestimmung der Blaetter die zu einem Knoten gehoeren
	*/
	function blaetter_zu_knoten(){
		$query="select * from knoten1_blatt1,blatt1 where knoten1_blatt1.knoten_id=$this->knoten and knoten1_blatt1.blatt_id=blatt1.id order by blatt1.blatt_id";
		$abfrage=mysql_db_query('verwaltung',$query,$this->verbindung);
		while($arr=mysql_fetch_array($abfrage,MYSQL_ASSOC)){
			$this->blatt_array[blatt_pfad][$arr[blatt_id]]=$this->pfad.$this->knoten."/".$arr[blatt_pfad];  // blatt_pfad
			$this->blatt_array[blatt_name][$arr[blatt_id]]=$arr[blatt_name];  // blatt_name
			$this->blatt_array[knoten_id][$arr[blatt_id]]=$arr[knoten_id];  // knoten_id
			$this->blatt_array[blatt_id][$arr[blatt_id]]=$arr[blatt_id];  // blatt_id
			// $this->kontrolle($arr);
		}
	}
	
	/**
	*	Zerlegung des Knotenarray
	*/
	function knoten_zerlegung(){
		echo "Knotenzerlegung";	
	}
	
	
	/**
	* Bestimmung des Knotenschnittpunktes
	*/
	function schnittstelle_knoten(){
		$test1=array_slice($this->knoten_array,0,1);  // Zerlegung in Einzelarray
		foreach($test1 as $name => $inhalt){
			$i=0;
			foreach($inhalt as $name1 => $inhalt1){
			$anzahl=count($inhalt);
				if($name1==$knoten){
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
*/
$knoten=1;
$blatt=2;

$baum = new tree($knoten,$blatt);
echo $baum->knoten_schnitt;
?>
