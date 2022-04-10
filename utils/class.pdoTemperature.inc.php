<?php

class PdoTemperature
{   		
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=temperature';
    private static $user='warren';
    private static $mdp='secret';
	private static $monPdo;
	private static $monPdoTemperature = null;


 /**
  * __construct

  * Constructeur privé, crée l'instance de PDO qui sera sollicitée
  * pour toutes les méthodes de la classe
  */				
 private function __construct() { // le constructeur ne peut pas être appelé à l'exterieur de la classe => on utlise get PdoTemperature
    PdoTemperature::$monPdo = new PDO(PdoTemperature::$serveur.';'.PdoTemperature::$bdd, PdoTemperature::$user, PdoTemperature::$mdp); 
 	PdoTemperature::$monPdo->query("SET CHARACTER SET utf8");
 }

  
 /**
  * _destruct
  *
  * Détruit l'instance de PDO
  */
 public function _destruct()
 {
    PdoTemperature::$monPdo = null;
 }


 /**
  * getPdoTemperature
  * 
  * Fonction statique qui crée l'unique instance de la classe (singleton)
  * Appel : $instancePdoTemperature = PdoTemperature::getPdoTemperature();
  *
  * @return l'unique objet de la classe PdoTemperature
  */
  public static function getPdoTemperature()
  {
  	if(PdoTemperature::$monPdoTemperature == null) {
  		PdoTemperature::$monPdoTemperature = new PdoTemperature();
  	}
  	return PdoTemperature::$monPdoTemperature;  
  }



/**
  * Retourne les messages entre deux personnes
  *
  * @param Int $idCompte ID du chatteur
  *
  * @return Array un tableau associatif de clé datetime et pseudo
  */
  public function getLesTemperatures()
  {
    $requetePrepare = PdoTemperature::$monPdo->prepare(
      'SELECT moment, temperature '
      . 'FROM temperature '
      . 'ORDER BY moment ASC '
      . 'LIMIT 15'
    );
    $requetePrepare->execute();
    $lesTemperatures = array();
    while ($laLigne = $requetePrepare->fetch()) {
        $moment = $laLigne['moment'];
        $temperature = $laLigne['temperature'];
        $lesTemperatures[] = array(
            'moment' => $moment,
            'temperature' => $temperature,
        );
    }
    return $lesTemperatures;
  }

  public function getLesDernieresTemperatures()
  {
    $requetePrepare = PdoTemperature::$monPdo->prepare(
      'SELECT date_format(moment, \'%H:%i:%s\') as moment, temperature '
      . 'FROM temperature '
      . 'ORDER BY moment DESC '
      . 'LIMIT 13'
    );
    $requetePrepare->execute();
    $lesTemperatures = array();
    while ($laLigne = $requetePrepare->fetch()) {
        $moment = $laLigne['moment'];
        $temperature = $laLigne['temperature'];
        $lesTemperatures[] = array(
            'moment' => $moment,
            'temperature' => $temperature,
        );
    }
    return $lesTemperatures;
  }



  public function insertTemperature($temperature)
  {
    $requetePrepare = PdoTemperature::$monPdo->prepare(
      'INSERT INTO temperature VALUES (CURRENT_TIMESTAMP, :temperature)'
    );
    $requetePrepare->bindParam(':temperature', $temperature, PDO::PARAM_INT);
    $requetePrepare->execute();
  }

  public function getDateOfTheDay()
  {
    $requetePrepare = PdoTemperature::$monPdo->prepare(
    'SELECT CONVERT(DATE_FORMAT(CURRENT_DATE,"%d/%m/%Y"), CHAR)'
    );
    $requetePrepare->execute();
    return $requetePrepare->fetch();
  }

  # public abstract function maxTemperature();

  # public abstract function minTemperature();

}

?>