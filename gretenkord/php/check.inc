<?
class check{
var $inhalt;       // Inhalt des Feldes
var $art;          // Art der Variable
var $laenge;       // Laenge der Variablen
var $erforderlich; // ist die Variable eine 'Pflichtvariable' ?
var $artliste;     // Array der definierten Arten
var $farbe;        // Array der Fehlerfarbe
var $name;         // Array der Namen der Fehlerfarbe
var $zaehler;      // Fehlerzaehler

	// Ueberpruefung ob die Klasse diese Art von Variable kennt
	function init($name,$inhalt,$art,$laenge,$erforderlich=false){
		if(!is_array($this->artliste)){
			$this->artliste = array(
				'char' => true, # fuer ein beliebiges Varcharfeld
				'zahl_exakt' => true, # eine Zahlenfolge mit genau definierter Laenge
				'zahl' => true, # eine Zahlenfolge mit Hoechstlaenge
				'mail' => true, # eine Email-Adresse
				'url' => true, # eine url
				'zeit' => true, # Ueberpruefung der Zeit
				'datum' => true, # Ueberpruefung Datum
				'plz' => true, # Ueberpruefung PLZ Deutschland
				'monat' => true, # Monat von 1 bis 12
				'jahr' => true, # das Jahr zwischen 1900 und 2100
				'text' => true, # Ueberpruefung Textstring a-z A-Z 0-9 _
				'preis' => true, # eine Zahl mit max 2 nachkommastellen
				'telefon' => true, # eine Telefonnummer Deutschland (XXXX)XXXXX
				'name' => true, # Familienname und Vorname
			);
		}
		// Ueberpruefung ob diese Variante vorgesehen ist
		if($this->artliste[$art]){
			$name="ERR_".strtoupper($name); // Bildung Name der Fehlerfarbe
			$this->farbe[$name]="black"; // Vorbelegung der Fehlerfarbe
			$this->name=$name;  // Name des Formularfeldes
			// $this->array_kontrolle();
			$this->inhalt=$inhalt; // Inhalt des Formularfeldes
			$this->art=$art;  // Typ der Kontrolle
			$this->laenge=$laenge;  // max. Laenge der Eingabe
			$this->erforderlich=$erforderlich;  // ist Eingabe zwingend erforderlich
			// echo "Typ des Feldes: ".$this->art."<hr>";
			$this->steuerung();
		}
		else{
			echo "Diese Art der Variablen&uuml;berpr&uuml;fung<br>ist in der Klasse nicht vorgesehen !";
		}
	}
	
	/******************************* Steuerungsfunktion *****************************************/
	
	// Steuerungsfunktion der einzelnen Kontrollfunktionen
	function steuerung(){
		if($this->erforderlich==1 and $this->inhalt==""){ # wenn String Pflicht aber 'leer' ist
		// echo "Variante 1 !<br>";
			$this->fehlerfarbe();
			$this->fehlerzaehler();
		}
		elseif(strlen($this->inhalt) > $this->laenge){ # wenn String groesser als max. Vorgabe
		// echo "Variante 2 !<br>";
			$this->fehlerfarbe();
			$this->fehlerzaehler();
		}
		elseif(!$this->inhalt and $this->erforderlich==1){ # wenn Variable nicht vorhanden, aber Pflicht
		// echo "Variante 3 !<br>";
				$this->fehlerfarbe();
				$this->fehlerzaehler();
		}
		else{ # fuehrt Kontrollfunktion entsprechend dem Typ aus
		// echo "Variante 4 !<br>";
				$funktionsname="check_".$this->art;
				$this->$funktionsname();
		}
	}
	
	/**************************** Hilfsmethoden fuer Steuerung ***************************************************/
		
	// Zuordnung Fehlerfarbe
	function fehlerfarbe(){
		$this->farbe[$this->name]="red";
		return;
	}
	
	// Erhoehung Fehlerzaehler
	function fehlerzaehler(){
		$this->zaehler++;
		return;
	}
	
	// Arraykontrolle
	function array_kontrolle(){
		foreach($this->farbe as $feld => $inhalt){
			echo "das Feld: $feld hat den Inhalt $inhalt<br>";
		}
		return;
	}
	
	// Ausgabe Array der Fehlerfarben
	function farb_ausgabe(){
		return $this->farbe;
	}
	
	// Ausgabe Fehlerzaehler
	function zaehler_ausgabe(){
		if($this->zaehler > 0){
			$this->zaehler=1;
		}
		else{
			$this->zaehler=0;
		}
		return $this->zaehler;
	}
	
	/********************************* Kontrollmethoden ***********************************************/
	// Ueberpruefung einzelnes Zeichen
	function check_char(){
		if(ereg('[^[[:print:]]]',$this->inhalt)){
			$this->fehlerfarbe();
			$this->fehlerzaehler();
		}
	}
	
	// Ueberpruefung ob Zahl und genaue Laenge
	function check_zahl_exakt(){
		if(!ereg('^([0-9]{2})$',$this->inhalt)){
			$this->fehlerfarbe();
			$this->fehlerzaehler();
		}
	}
	
	// Ueberpruefung einer Zahl
	function check_zahl(){
		if(!ereg('^([0-9]+)$',$this->inhalt)){
			$this->fehlerfarbe();
			$this->fehlerzaehler();
		}
	}
	
	// Ueberpruefung Text
	function check_text(){
			return;
	}
	
	// Ueberpruefung Telefon
	function check_telefon(){
		echo "in Funktion Telefon !<br>";
	}
	
	// Ueberpruefung Name / Vorname
	function check_name(){
		if(!ereg('^([a-zA-Z-]+)$',$this->inhalt)){
			$this->fehlerfarbe();
			$this->fehlerzaehler();
		}
	}
	
	
	
}
?>
