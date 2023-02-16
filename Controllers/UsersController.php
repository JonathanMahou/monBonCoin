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


    if(!filter_var($_POST ['login'], FILTER_VALIDATE_EMAIL)){
        $errMsg = "Merci de saisir un email valide<br>";
    }
    if(!preg_match($pattern, $_POST['password'])){
        $errMsg .= "Merci de saisir un mot de passe correcct";
    }
    if(!$errMsg){
        //Tout est ok
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //On verifie que l'email soit pas déja en BDD
        $login = [$_POST['login']];
        $testLogin = UsersModel::findByLogin($login);
        if($testLogin){
            $errMsg = "Vous avez déja un compte";
        }else{
            // on enregistre en BDD
            //On sécurise les données 
            self::security();
            $data = [$_POST['login'],
            $pass, $_POST['firstName'], 
            $_POST['lastName'], 
            $_POST['adress'], 
            $_POST['cp'], 
            $_POST['city']];
            UsersModel::create($data);
            $_SESSION['message'] = "Votre comtpe est crée, vous pouvez vous connecter";
            header('location: connexion'); 
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


    //Méthode de connexion 
    public static function connexion (){
        $errMsg = "";

        //Traitement du formulaire
        if(!empty($_POST['login']) && !empty($_POST['password'])){
            //On sécurise la saisie
            self::security();
            $login = $_POST['login'];
            //On verifie que l'utilisateur soit présent en BDD
            $user = UsersModel::findByLogin([$login]);
            if (!$user) {
                $errMsg = "Login ou mot de passe incorrect";
            }else{
                $pass = $_POST['password'];
                if (password_verify($pass, $user['password'])) {
                    //Enregistre des infos de l'utilisateur en session
                    $_SESSION['messages'] = "Salut, content de vous revoir";
                    $_SESSION['user'] = [
                        'role' => $user['role'],
                        'id' => $user['id'],
                        'firstName' => $user['firstName'],
                        'login' => $user['login']
                    ];
                    //Redirection vers la page d'accueil
                    header('Location: ' . SITEBASE);
                }else{
                    $errMsg = "Login ou mot de passe incorrect";
                }
            }
        }elseif(!empty($_POST)){
            $errMsg = "Merci de remplir tous les champs";
        }

        self::render ('users/connexion', [
            'title' => 'connexion',
            'errMsg' => $errMsg
        ]);
    }
}