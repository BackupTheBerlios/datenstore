<?
/**
* Aufruf des Objektes mit
*  Knoten und Blatt
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
include_once('tree.inc');


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
