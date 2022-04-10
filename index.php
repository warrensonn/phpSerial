<?php 
/*! \mainpage Projet Temperature
 *
 * \section desc Temperature suivant le modèle MVC utilisant PHP Version 7
 * 
 * Classe d'accès aux données / Fonctions / Vues / Controleurs détaillés dans cette documentation
 *
 * @category  Projet
 * @package   Temperature
 * @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 */

session_start();
require_once 'utils/class.pdoTemperature.inc.php';

include 'vues/v_entete.php';

if(!isset($_REQUEST['uc']))
    $uc = 'jour';
else
	$uc = $_REQUEST['uc'];

$pdo = PdoTemperature::getPdoTemperature();
switch($uc)
{
	case 'jour':
		include 'vues/v_jour.php';
		break;
	case 'historique' :
		include 'controleurs/c_historique.php';
		break;
}
?>