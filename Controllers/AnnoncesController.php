<?php
namespace Controllers;

use Models\AnnoncesModel;

class AnnoncesController extends Controller {
    // Méthode pour afficher les dernieres annonces misent en ligne sur la page d'accueil
    public static function accueil(){
        $annonces = AnnoncesModel::findAll("date DESC", "LIMIT 2");

        // On utilise la méthode render()
        self::render('annonces/accueil', [
            'title' => 'Bienvenue sur mon bon coin',
            'annonces' => $annonces,
            'sousTitre' => 'Les dernières annonces mise en ligne'
        ]);
    }
    
    //Méthode pour afficher le détail d'une annonce 
    public static function detail(int $id){
        $annonce = AnnoncesModel::findById([$id]);
        $msg = '';
        if (!$annonce){
            $msg = "Cette annonce n'existe pas";
            
        }

        //on utilise le render()
        self::render('annonces/detail', [
            'title' => 'Détail de l\'annonce',
            'annonce' => $annonce,
            'msg' => $msg
        ]);
    }
}