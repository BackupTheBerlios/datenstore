<?
class tree{
	/********** anzupassende Werte ************/
	var $pfad="c:/php/navigation/";  // Pfad unter denen die Blaetter liegen
	var $db_host="localhost";  // Datenbankhost
	//var $db_host="mysql1.webpack.hosteurope.de";
	var $db_user="walter";  // User
	//var $db_user="ftp12468";
	var $db_passwd="walter";  // Passwort
	//var $db_passwd="Stadtplan";
	var $db_database="verwaltung"; // Datenbank
	//var $db_database="datenstore_de";
	
	var $verbindung; // MySql - Handle
	var $datenbank;  // Datenbank - Handle
	var $knoten_array; // Array aller Knoten
	var $blatt_array;  // Array aller Blaetter, die zu einem Knoten gehoeren
	var $knoten;  // Knoten der aktiv ist
	var $blatt;  // Blatt das aktiv ist
	var $anzahl_blaetter;  // Anzahl der Blaetter die zu einem Knoten gehoeren
	
	var $knoten_schnitt; // an welcher Stelle muss das Knoten-Array geschnitten werden
	var $blatt_schnitt=-1; // an welcher Stelle muss das Blatt-Array geschnitten werden
	
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
	*/
	function tree($knoten=false,$blatt=false){
		$this->knoten=$knoten;  // Uebergabe Knoten
		$this->blatt=$blatt;  // Uebergabe Blatt
		$this->verbindung= mysql_connect ($this->db_host,$this->db_user,$this->db_passwd); // Datenbankverbindung
		$this->alle_knoten();  // Bestimmung aller Knoten
		$this->knoten_zerlegung(); // Zerlegung des Knoten
		if($this->knoten) $this->blaetter_zu_knoten(); // welche Blaetter gehoeren zum Knoten , nur wenn Knoten aktiv !
		if($this->anzahl_blaetter>0) $this->blatt_zerlegung();  // Wenn Unterblaetter zum Knoten gehoeren , wenn Unterblaetter !
		mysql_close($this->verbindung); // loesen Verbindung zur Datenbank
	}
	
	
	/**
	* Abrufen aller Knoten des Baumes
	*/
	function alle_knoten(){
		$result=mysql_db_query($this->db_database,"select * from knoten1 order by knoten_id");
		$i=0;
		while($arr1=mysql_fetch_array($result,MYSQL_ASSOC)){
			$this->knoten_array[knoten_id][$i]=$arr1[knoten_id];  // knoten_id
			$this->knoten_array[knoten_name][$i]=$arr1[knoten_name];  // knoten_name
			$this->knoten_array[knoten_pfad][$i]=$this->pfad.$arr1[knoten_id]."/".$arr1[knoten_pfad]; // knoten_pfad
			if($this->knoten==$arr1[knoten_id]){ // wenn aktiver Knoten
				$this->knoten_schnitt=$i;
			}
			$i++;
		}
		mysql_free_result($result);
	}
	
	
	/**
	*	Funktion zur Zerlegung des Knotenarray
	*/
	function knoten_zerlegung(){
	$j=0;
	$k=0;
	$l=0;
	$anzahl=count($this->knoten_array[knoten_id]);
	
		if($this->knoten==false and $this->blatt==false){  // wenn kein Knoten und kein Blatt aktiv
			$this->knoten_array_oben_passiv=$this->knoten_array;
			$this->knoten_block_oben_passiv="visibility";
		}
		
		for($i=0;$i<$anzahl;$i++){
			if($this->knoten and $this->blatt==false){  // wenn ein Knoten aktiv und kein Blatt aktiv
				if($i<$this->knoten_schnitt){
					$this->knoten_array_oben_passiv[knoten_id][$j]=$this->knoten_array[knoten_id][$i];  // knoten_id
					$this->knoten_array_oben_passiv[knoten_name][$j]=$this->knoten_array[knoten_name][$i];  // knoten_name
					$this->knoten_array_oben_passiv[knoten_pfad][$j]=$this->knoten_array[knoten_pfad][$i];  // knoten_pfad
					$this->knoten_block_oben_passiv='visibility';
					$j++;
				}
				if($i==$this->knoten_schnitt){
					$this->knoten_array_oben_aktiv[knoten_id][$k]=$this->knoten_array[knoten_id][$i];  // knoten_id
					$this->knoten_array_oben_aktiv[knoten_name][$k]=$this->knoten_array[knoten_name][$i];  // knoten_name
					$this->knoten_array_oben_aktiv[knoten_pfad][$k]=$this->knoten_array[knoten_pfad][$i];  // knoten_pfad
					$this->knoten_block_oben_aktiv='visibility';
					$k++;
				}
				if($i>$this->knoten_schnitt){
					$this->knoten_array_unten_passiv[knoten_id][$l]=$this->knoten_array[knoten_id][$i];  // knoten_id
					$this->knoten_array_unten_passiv[knoten_name][$l]=$this->knoten_array[knoten_name][$i];  // knoten_name
					$this->knoten_array_unten_passiv[knoten_pfad][$l]=$this->knoten_array[knoten_pfad][$i];  // knoten_pfad
					$this->knoten_block_unten_passiv='visibility';
					$l++;
				}
			}
			if($this->knoten and $this->blatt){  // wenn ein Knoten und ein Blatt aktiv
				if($i<=$this->knoten_schnitt){
					$this->knoten_array_oben_passiv[knoten_id][$j]=$this->knoten_array[knoten_id][$i];  // knoten_id
					$this->knoten_array_oben_passiv[knoten_name][$j]=$this->knoten_array[knoten_name][$i];  // knoten_name
					$this->knoten_array_oben_passiv[knoten_pfad][$j]=$this->knoten_array[knoten_pfad][$i];  // knoten_pfad
					$this->knoten_block_oben_passiv='visibility';
					$j++;
				}
				if($i>$this->knoten_schnitt){
					$this->knoten_array_unten_passiv[knoten_id][$l]=$this->knoten_array[knoten_id][$i];  // knoten_id
					$this->knoten_array_unten_passiv[knoten_name][$l]=$this->knoten_array[knoten_name][$i];  // knoten_name
					$this->knoten_array_unten_passiv[knoten_pfad][$l]=$this->knoten_array[knoten_pfad][$i];  // knoten_pfad
					$this->knoten_block_unten_passiv='visibility';
					$l++;
				}
			}
		}
	}
	
	/**
	* Bestimmung der Blaetter die zu einem Knoten gehoeren
	*/
	function blaetter_zu_knoten(){
		$query="select * from knoten1_blatt1,blatt1 where knoten1_blatt1.knoten_id=$this->knoten and blatt_id=blatt1.id order by blatt_id";
		$abfrage1=mysql_db_query($this->db_database,$query,$this->verbindung);
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
	mysql_free_result($abfrage1);
	$this->anzahl_blaetter=$i;
	}
	
	/**
	* Funktion zur Zerlegung des Blattarray
	*
	*/
	function blatt_zerlegung(){
		if($this->blatt_schnitt>=0){
			$anzahl=count($this->blatt_array[blatt_id]);
			$j=0;
			$k=0;
			$l=0;
			
			for($i=0;$i<$anzahl;$i++){
				if($i<$this->blatt_schnitt){  // passive Blaetter
					$this->blatt_array_oben[blatt_id][$j]=$this->blatt_array[blatt_id][$i];
					$this->blatt_array_oben[blatt_name][$j]=$this->blatt_array[blatt_name][$i];
					$this->blatt_array_oben[knoten_id][$j]=$this->blatt_array[knoten_id][$i];
					$this->blatt_array_oben[blatt_pfad][$j]=$this->blatt_array[blatt_pfad][$i];
					$this->blatt_block_oben="visibility";
					$j++;
				}
				if($i==$this->blatt_schnitt){  // aktives Blatt
					$this->blatt_array_mitte[blatt_id][$k]=$this->blatt_array[blatt_id][$i];
					$this->blatt_array_mitte[blatt_name][$k]=$this->blatt_array[blatt_name][$i];
					$this->blatt_array_mitte[knoten_id][$k]=$this->blatt_array[knoten_id][$i];
					$this->blatt_array_mitte[blatt_pfad][$k]=$this->blatt_array[blatt_pfad][$i];
					$this->blatt_block_mitte="visibility";
					$k++;
				}
				if($i>$this->blatt_schnitt){  // passive Blaetter
					$this->blatt_array_unten[blatt_id][$l]=$this->blatt_array[blatt_id][$i];
					$this->blatt_array_unten[blatt_name][$l]=$this->blatt_array[blatt_name][$i];
					$this->blatt_array_unten[knoten_id][$l]=$this->blatt_array[knoten_id][$i];
					$this->blatt_array_unten[blatt_pfad][$l]=$this->blatt_array[blatt_pfad][$i];
					$this->blatt_block_unten="visibility";
					$l++;
				}
			}
		}
		else{
			$this->blatt_array_oben=$this->blatt_array;
			$this->blatt_block_oben="visibility";
		}
	}
}// Ende der Klasse


/************* Ausgangswerte **************/

$tmpl = new patTemplate();
$tmpl->setBasedir('c:/php/navigation');
//$tmpl->setBasedir('/is/htdocs/12468/www.datenstore.de/navigation_test/');
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

$tmpl->displayParsedTemplate();
?>
