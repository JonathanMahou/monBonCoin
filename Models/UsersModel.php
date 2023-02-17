<?php

namespace Models;

use PDO;
use App\Db;

class UsersModel extends Db
{
    ///////////////////////////CRUD/////////////////////////////////////

    ///////////////////////// Méthode de lecture

    //Trouver tous les utilisateurs
    public static function findAll()
    {
        $request = "SELECT * FROM users";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }



    //Trouver un utilisateur par son id
    /**
     * Attend un id utilisateur
     * @param array $id[int]
     */


    public static function findById(array $id)
    {
        $request = "SELECT * FROM users WHERE idUser = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($id);

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    //Trouver un utilisateur par son login
    /**
     * Attend un login utilisateur
     * @param array $login[string]
     */


    public static function findByLogin(array $login)
    {
        $request = "SELECT * FROM users WHERE login = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($login);

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    //Trouver avec l'id ou le user
    public static function findByIdOrLogin(array $data)
    {
        if (is_int($data[0])) {
            $request = "SELECT * FROM users WHERE idUser = ?";
        } else {
            $request = "SELECT * FROM users WHERE login = ?";
        }
        $response = self::getDb()->prepare($request);
        $response->execute($data);

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    // Recherche par clée
    /**
     * Cette méthode permet de trouver un ou des utilistauers par n'importe quel critère
     * elle attend un tableau associatif
     * @param array $user["clé" => ["valeur"]]
     */
    // public static function findBy(array $user){
    //     $request = "SELECT * FROM users WHERE " . key($user) ."= ?";
    //     $response = self::getDb()->prepare($request);
    //     $response->execute(current($user));

    //     return $response->fetchAll(PDO::FETCH_ASSOC);
    // }



    ////////////////////Méthode d'écriture///////////////////////////////

    //créer un nouvel utilisateur
    public static function create(array $data)
    {
        //$data est un tableau qui contient les valeurs à insérer en BDD
        //INSERT INTO annnonce (idUser, idCategorie, title, description, price, image) VALUES (1, 2, tondeuse, max 250 m², 150, tondeuse.jpg)
        $request = "INSERT INTO users (login, password, firstName, lastName, adress, cp, city) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }


    //Modification d'un utilisateur 
    public static function update(array $data)
    {
        $request = "UPDATE users SET login = ?, password= ?, firstName= ?, lastName = ?, adress = ?, cp = ?, city = ? WHERE idUser = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }


    ////////////////////Méthode de suppression///////////////////////
    public static function delete(array $id)
    {
        $request = " DELETE FROM annonces WHERE idUser = ? ";
        $response = self::getDb()->prepare($request);

        return $response->execute($id);
    }
}
