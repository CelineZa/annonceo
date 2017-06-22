<?php

/* ------ CONNEXION À LA BDD ------ */
try{
	$bdd = new PDO('mysql:host=localhost;dbname=annonceo','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(PDOException $e){
	echo 'Connexion impossible. Message error :'.$e;
}

/* ----------- SESSION ----------- */

session_start(); // On démarre une session.

/* -------- CHEMIN PHOTOS -------- */

define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/annonceo/"); // On déclare une constante "RACINE_SITE" qui contient le chemin physique du site.

//echo RACINE_SITE;
//echo '<pre>'; print_r($_SERVER); echo '</pre>';
//echo '<pre>'; print_r($_SERVER['DOCUMENT_ROOT']); echo '</pre>';

define("URL", 'http://localhost/annonceo/'); // URL du site

/* -- DÉCLARATION DE VARIABLE -- */

$content = ''; // Variable initialisée à vide qui permetta de contenir tous les différents messages d'alertes. Elle sera disponible à tout moment sur toutes les pages. Pratique pour un affichage global.

/* - INCLUSIONS DES FONCTIONS - */

require_once('fonction.inc.php');
