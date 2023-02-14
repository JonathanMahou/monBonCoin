<?php



use Models\AnnoncesModel;
use Models\UsersModel;

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
// $data = [1,2, "tondeuse", "maximum 250m² moteur électrique", 185, "tondeuse.jpg"];
// AnnoncesModel::create($data);

// //Test méthode update
// $data = [2, "tondeuse à gazon", "maximum 250m² moteur électrique", 185, "tondeuse.jpg", 2];
// AnnoncesModel::update($data);

// $id = [2];
// AnnoncesModel::delete($id);

//Test de la méthode findAll() users
// var_dump(UsersModel::findAll());

//Test de la méthode findById() id
// $id = [2];
// var_dump(UsersModel::findById($id));


//Test de la méthode findByLogin() login
// $login = ['admin@admin.fr'];
// var_dump(UsersModel::findByLogin($login));


//Test de la méthode findBy() critere 1
// $data = [1];
// var_dump(UsersModel::findByIdOrLogin($data));


//RECHERCHE AVEC CLEE

/**
 * $user = ['passwaord' => ['1234']];
 * //$user = ['idUser' => [1]];
 * var_dump(UsersModel::findBy($user));
 */


//Test de la méthode create() users
$pass = password_hash("1234", PASSWORD_DEFAULT);
// $data = ['test@gmail.com', $pass, 'test', 'nomTest', '66 rue de paris', 77140, 'nemours'];
// UsersModel::create($data);


//Test de la méthode update() users
// $data = ['sylvain@gmail.com', $pass, 'Jonathan', 'MAHOU', '22 ter Boulevard Chéreau', 77130, 'Montereau-fault-Yonne', 2];
// UsersModel::update($data);


//Test de la méthode delete

