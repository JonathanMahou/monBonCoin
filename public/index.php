<?php

// Création d'une constante pour l'url de base du site


//Création d'une constante pour l'url de base du site

use App\Routeur;

session_start();
$config = file_get_contents('../App/config.json');
$config = json_decode($config);
$config->baseSite;
define("SITEBASE", $config->baseSite);
//echo SITEBASE;

// echo "<hr>";


//Création d'une constante pour la racine du projet 
define('ROOT', dirname(__DIR__));
// echo ROOT;




//On importe l'autoloader
require_once(ROOT . DIRECTORY_SEPARATOR . 'autoloader.php');

$routeur = new Routeur;
$routeur->app();