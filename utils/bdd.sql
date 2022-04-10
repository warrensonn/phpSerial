-- Création base de données PHPmyAdmin pour le projet Temperature

#---------------------------------------
-- ADMINISTRATION DE LA BASE DE DONNEES
#---------------------------------------

CREATE DATABASE IF NOT EXISTS temperature ;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
USE temperature ;


#-------------------------------------------------
-- CREATION DE LA STRUCTURE DE LA BASE DE DONNEES
#-------------------------------------------------


# -----------------------------------------------------------------------------
#       TABLE : MESSAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TEMPERATURE
 (
  moment DATETIME NOT NULL DEFAUT CURRENT_TIMESTAMP,
  temperature INT (3) NOT NULL,
  PRIMARY KEY (moment)
 )
 ENGINE=InnoDB;


# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE MESSAGE
# -----------------------------------------------------------------------------

CREATE  INDEX I_TEMPERATURE_MOMENT
    ON TEMPERATURE (moment ASC);




#-----------------------------------------------------------------------------
-- CREATION DES LIGNES DES TABLES
#-----------------------------------------------------------------------------

INSERT INTO TEMPERATURE VALUES ('2022-04-04 10:23:24', 12);
INSERT INTO TEMPERATURE VALUES ('2022-04-04 10:23:48', 24);
INSERT INTO TEMPERATURE VALUES (CURRENT_TIMESTAMP, 22);