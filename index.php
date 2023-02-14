<?php

use Models\AnnoncesModel;

require_once('autoloader.php');


//Tester la méthode findAll()
// $order = "price DESC";
// $annonces = AnnoncesModel::findAll(null,"LIMIT 2");

// var_dump($annonces);

//Test de la méthode findByID()
// 

// Test de la méthode findByIdUser
// $idUser = [2]; 
// $annoncesUser = AnnoncesModel::findByUser($idUser);
// var_dump($annoncesUser);

//test la méthode findByIdCat()
// $idCategorie = [2];
// $annoncesCat = AnnoncesModel::findByCat($idCategorie);
// var_dump($annoncesCat);


//Teste de la méthode create 
$data = [1,2, "tondeuse", "maximum 250m² moteur électrique", 185, "tondeuse.jpg"];
// AnnoncesModel::create($data);

// //Test méthode update
// $data = [2, "tondeuse à gazon", "maximum 250m² moteur électrique", 185, "tondeuse.jpg", 2];
//AnnoncesModel::update($data);

$id = [2];
AnnoncesModel::delete($id);