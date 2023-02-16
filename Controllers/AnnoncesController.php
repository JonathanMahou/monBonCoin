<?php

namespace Controllers;

use Models\AnnoncesModel;
use Models\CategoriesModel;

class AnnoncesController extends Controller
{
    // Méthode pour afficher les dernieres annonces misent en ligne sur la page d'accueil
    public static function accueil()
    {
        $annonces = AnnoncesModel::findAll("date DESC", "LIMIT 2");

        // On utilise la méthode render()
        self::render('annonces/accueil', [
            'title' => 'Bienvenue sur mon bon coin',
            'annonces' => $annonces,
            'sousTitre' => 'Les dernières annonces mise en ligne'
        ]);
    }

    //Méthode pour afficher le détail d'une annonce 
    public static function detail(int $id)
    {
        $annonce = AnnoncesModel::findById([$id]);
        $msg = '';
        if (!$annonce) {
            $msg = "Cette annonce n'existe pas";
        }

        //on utilise le render()
        self::render('annonces/detail', [
            'title' => 'Détail de l\'annonce',
            'annonce' => $annonce,
            'msg' => $msg
        ]);
    }


    // Méthode pour afficher toutes les annonces 
    public static function annonces($order = null, $categorie = null)
    {
        if ($categorie == null) {
            $annonces = AnnoncesModel::findAll($order);
        } else {
            $annonces = AnnoncesModel::findByCat([$categorie], $order);
        }

        //Récupération des catégories
        $categories = CategoriesModel::findAll();

        self::render('annonces/annonces', [
            'title' => "Les annonces de mon bon coin",
            'annonces' => $annonces,
            'categories' => $categories
        ]);
    }

    //Méthode pour créer une annonce
    public static function annonceAjout()
    {
        //Récupérer les catégories
        $categories = CategoriesModel::findAll();

        //Traitement du formulaire
        $errMsg = "";
        if (
            !empty($_POST['title']) &&
            !empty($_POST['idCategorie']) &&
            !empty($_POST['price']) &&
            !empty($_POST['description']) &&
            !empty($_FILES['image'])
        ) {
            //Test de la photo

            if (($_FILES['image']['size'] < 3000000) &&
                (($_FILES['image']['type'] == 'image/jpeg') ||
                ($_FILES['image']['type'] == 'image/jpg') ||
                ($_FILES['image']['type'] == 'image/png'))
            ) {
                //On sécurise 
                $secu = self::security();
                //On renomme la photo
                $photoName = uniqid() . $_FILES['image']['name'];
                //On copie la photo sur le serveur
                copy($_FILES['image']['tmp_name'], ROOT . "/public/img/annonces/" . $photoName);
                // On appel la requete d'enregistrement en BDD
                // idUser, idCategorie, title, description, price, image
                $user = $_SESSION['user']['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = (int)$_POST['price'];
                $categorie = (int)$_POST['idCategorie'];
                $photoName;

                $newAnnonce = AnnoncesModel::create([$user, $categorie, $title, $description, $price, $photoName]);
                header('Location: ' . SITEBASE);
            }else{
                $errMsg = "Image trop lourde ou mauvais format";
            }
        } elseif (!empty($_POST)) {
            $errMsg = "Merci de remplir tous les champs";
        }

        self::render('annonces/ajout', [
            'title' => "Nouvelle annonce",
            'categories' => $categories,
            'errMsg' => $errMsg
        ]);
    }


    // Méthode pour modifier une annonce
    public static function annonceModif($id){
        $errMsg="";
        // On récupère les catégories
        $categories = CategoriesModel::findAll();
        // On récupérer l'annonce à modifier

        $annonce = AnnoncesModel::findById([$id]);
        !$annonce ? header('Location: annonces') : null;
        // Vérifier que l'utilisateur est admin ou que l'utilisateur est le propriétaire  de l'annonce
        if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['id'] == $annonce['idUser']) {
            // Traitement de mon formulaire
            // var_dump($annonce);
            if(!empty($_POST['title']) &&
                !empty($_POST['idCategorie']) &&
                !empty($_POST['price']) &&
                !empty($_POST['description'])){
                        // Controle sur la photo
                        // var_dump($annonce);
                        if (!empty($_FILES['image']['name']) &&
                            ($_FILES['image']['size'] < 3000000) &&
                        (($_FILES['image']['type'] == 'image/jpeg') ||
                        ($_FILES['image']['type'] == 'image/jpg') ||
                        ($_FILES['image']['type'] == 'image/png')))
                        {
                            $photoName = uniqid() . $_FILES['image']['name'];
                            copy($_FILES['image']['tmp_name'], ROOT . "/public/img/annonces/" . $photoName);
                        }elseif(!empty($_FILES['image']['name'])){
                            $errMsg = "Photo trop lourde ou mauvais format";
                        }
                        // On securise
                        // var_dump($annonce);
                        self::security();
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = (int)$_POST['price'];
                        $categorie = (int)$_POST['idCategorie'];
                        $idAnnonce = $annonce['idAnnonce'];
                        if(isset($photoName)){
                            $data = [$categorie, $title, $description, $price, $photoName, $idAnnonce];
                        }else{
                            $data = [$categorie, $title, $description, $price, $annonce['image'], $idAnnonce];
                        }
                        // Executer la requete update
                        $annonceModif = AnnoncesModel::update($data);

                }elseif(!empty($_POST)){
                    $errMsg = "Merci de remplire tous les champs (a part la photo)";
                }
        }else{
            header('Location: annonces');
        }


        self::render('annonces/modification', [
            'title' => 'Modification de l\' annonce',
            'annonce' => $annonce,
            'errMsg' => $errMsg,
            'categories' => $categories,
            'errMsg' => $errMsg

        ]);
    }
}
