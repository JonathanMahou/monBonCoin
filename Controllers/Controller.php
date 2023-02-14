<?php 
namespace Controllers;

class Controller{
    //Création du render
    public static function render ($views, $data= []){
        //On utilise "extract()" pour créer autant de variable que de clé dans le tableau $data
        extract($data);

        // On commence à mettre en mémoire tampon
        ob_start();

        //On appel la bonne vue 
        require_once ROOT . '/Views/' . $views . '.php';

        $content = ob_get_clean();

        //On appel le layout principale 
        require_once ROOT . '/Views/layout.php';
    }


    //test
//     public function test(){
//         $this->render('test', [
//             'title' => 'page de test'
//         ]);
//     }
}
