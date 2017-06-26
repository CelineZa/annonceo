CREATE DATABASE IF NOT EXISTS annonceo;

USE annonceo;

CREATE TABLE annonce(
	id_annonce INT(3) AUTO_INCREMENT,
	titre VARCHAR(255) NOT NULL,
	description TEXT NOT NULL,
	prix INT(20) NOT NULL,
	photo VARCHAR(200) NOT NULL,
	pays VARCHAR(20) NOT NULL,
	ville VARCHAR(20) NOT NULL,
	adresse VARCHAR(50) NOT NULL,
	cp INT(5) NOT NULL,
	membre_id INT(3) NOT NULL,
	photo_id INT(3) NOT NULL,
	categorie_id INT(3) NOT NULL,
	date_enregistrement DATETIME DEFAULT NULL,
	PRIMARY KEY(id_annonce)
) ENGINE=InnoDB;

CREATE TABLE photo(
	id_photo INT(3) NOT NULL AUTO_INCREMENT,
	photo1 VARCHAR(255) NOT NULL,
	photo2 VARCHAR(255) NOT NULL,
	photo3 VARCHAR(255) NOT NULL,
	photo4 VARCHAR(255) NOT NULL,
	photo5 VARCHAR(255) NOT NULL,
	PRIMARY KEY(id_photo)
) ENGINE=InnoDB;


CREATE TABLE commentaire(
	id_commentaire INT(3) NOT NULL AUTO_INCREMENT,
	membre_id INT(3) NOT NULL,
	annonce_id INT(3) NOT NULL,
	commentaire TEXT NOT NULL,
	date_enregistrement DATETIME DEFAULT NULL,
	PRIMARY KEY(id_commentaire)
)ENGINE=InnoDB;

CREATE TABLE categorie(
	id_categorie INT(3) NOT NULL AUTO_INCREMENT,
	titre VARCHAR(255) NOT NULL,
	motscles TEXT NOT NULL,
	PRIMARY KEY(id_categorie)
)ENGINE=InnoDB;

CREATE TABLE note(
	id_note INT(3) NOT NULL AUTO_INCREMENT,
	membre_id1 INT(3) NOT NULL,
	membre_id2 INT(3) NOT NULL,
	note INT(3) NOT NULL,
	avis TEXT NOT NULL,
	date_enregistrement DATETIME DEFAULT NULL,
	moyenne_note INT(4) NOT NULL,
	PRIMARY KEY(id_note)
)ENGINE=InnoDB;

CREATE TABLE membre(
	id_membre INT(3) NOT NULL AUTO_INCREMENT,
	pseudo VARCHAR(20) NOT NULL,
	mdp VARCHAR(60) NOT NULL,
	nom VARCHAR(20) NOT NULL,
	prenom VARCHAR(20) NOT NULL,
	telephone INT(20) NOT NULL,
	email VARCHAR(50) NOT NULL,
	civilite ENUM('m','f') NOT NULL,
	statut INT(1) NOT NULL,
	date_enregistrement DATETIME DEFAULT NULL,
	moyenne_note INT(4) NOT NULL,
	PRIMARY KEY(id_membre)
)ENGINE=InnoDB;

ALTER TABLE annonce ADD FOREIGN KEY (membre_id) REFERENCES annonceo.membre(id_membre);
ALTER TABLE annonce ADD FOREIGN KEY (photo_id) REFERENCES annonceo.photo(id_photo);
ALTER TABLE annonce ADD FOREIGN KEY (categorie_id) REFERENCES annonceo.categorie(id_categorie);
ALTER TABLE commentaire ADD FOREIGN KEY (membre_id) REFERENCES annonceo.membre(id_membre);
ALTER TABLE commentaire ADD FOREIGN KEY (annonce_id) REFERENCES annonceo.annonce(id_annonce);
