<?php

/**
 * Class Connexion : Permet de se connecter à la base de données
 */
class Connexion
{

    /**
     * Permet de se connecter à la base de données
     * 
     * @return PDO
     */
    public static function login(): PDO
    {
        $file = json_decode(file_get_contents("config.json"), true);
        return new PDO("mysql:host=" . $file['HOST'] . ";dbname=" . $file['DBNAME'] . ";charset=utf8", $file['LOGIN'], $file['MDP']);
    }

    /**
     * Permet de se déconnecter de la base de données
     * 
     * @return null
     */
    public static function logout()
    {
        return null;
    }

}

/**
 * Permet de hasher un mot de passe
 * 
 * @param string $passwd
 * @return string
 */
function hashPassword($passwd)
{
    return password_hash($passwd, PASSWORD_DEFAULT);
}
?>