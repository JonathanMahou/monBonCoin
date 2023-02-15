<?php 

namespace Controllers; 

use Models\UsersModel;

class UsersController extends Controller{
    //Création d'un nouvel utilisateur 
    
    
    public static function inscription(){
    
    //Traitement du formulaires
    $errMsg = '';
    //Regxex du mdp (juste minimum 8 caractère)
    $pattern = '/^.{8,}$/';
    // var_dump($_POST);
    if (!empty($_POST) && 
    !empty ($_POST['email']) &&
    !empty ($_POST['firstName']) &&
    !empty ($_POST['lastName']) &&
    !empty ($_POST['adress']) &&
    !empty ($_POST['cp']) &&
    !empty ($_POST['city']) &&
    !empty ($_POST['password']) &&
    ($_POST['password'] == $_POST['confirm'])
) {


    if(!filter_var($_POST ['email'], FILTER_VALIDATE_EMAIL)){
        $errMsg = "Merci de saisir un email valide<br>";
    }
    if(!preg_match($pattern, $_POST['password'])){
        $errMsg .= "Merci de saisir un mot de passe correcct";
    }
    if(!$errMsg){
        //Tout est ok
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //On verifie que l'email soit pas déja en BDD
        $login = [$_POST['email']];
        $testLogin = UsersModel::findByLogin($login);
        if($testLogin){
            $errMsg = "Vous avez déja un compte";
        }else{
            // on enregistre en BDD
            //On sécurise les données 
            self::security();
            $data = [$_POST['email'],
            $pass, $_POST['firstName'], 
            $_POST['lastName'], 
            $_POST['adress'], 
            $_POST['cp'], 
            $_POST['city']];
            UsersModel::create($data);
            $_SESSION['message'] = "Votre comtpe est crée, vous pouvez vous connecter";
            header('location: ' . SITEBASE); 
        }
    }


}elseif (!empty($_POST)){
    $errMsg = "Merci de remplir tous les champs du formulaire et de vérifier le mot de passe";
}
        self::render('users/inscription', [
            'title' => 'Inscription',
            'errMsg' => $errMsg
        ]);
    }
}