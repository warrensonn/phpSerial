<?php
/** Vue entête
 *  -------
 *  @file
 *  @brief Header
 * 
 *  @category  Projet
 *  @package   Temperature
 *  @author    Warren BEVILACQUA <bevilacqua.warren@gmail.com
 */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<div id="bandeau">
	<img src="images/temperatures.png"	alt="temperature" title="temperature"/>
</div>
<br>
<!-- TITRE ET MENUS -->
<html lang="fr">
<head>
<title>Temperatures</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="utils/cssGeneral.css" rel="stylesheet" type="text/css">
<?php


	
echo 'Bonjour, bienvenue dans votre visionneur des temperatures :'; ?> <br><br> 
<!--  Menu haut-->
<ul id="menu">
	<li style="background-color:#3febdc"><a href="index.php?uc=jour"> Temperature du Jour </a></li>
	<li style="background-color:#3febdc" ><a href="index.php?uc=historique&action=listHistorique"> Historique des Temperatures </a></li> 
</ul>