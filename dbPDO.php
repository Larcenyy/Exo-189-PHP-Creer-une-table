<?php

class dbPDO
{
    private static string $server = 'localhost';
    private static string $username = 'root';
    private static string $password = '';
    private static string $database = 'table_test_php_2';
    private static ?PDO $db = null;

    public static function connect(): ?PDO {
        if (self::$db == null){
            try {
                self::$db = new PDO("mysql:host=".self::$server.";dbname=".self::$database, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "
                CREATE TABLE produit(
                  `id` int NOT NULL AUTO_INCREMENT,
                  `titre` varchar(255) NOT NULL,
                  `prix` float NOT NULL,
                  `description_courte` mediumtext NOT NULL,
                  `description_longue` longtext NOT NULL,
                  PRIMARY KEY (`id`)
                )";
                $sql2 = "
                CREATE TABLE utilisateur(
                  `id` int NOT NULL AUTO_INCREMENT,
                  `nom` varchar(50) NOT NULL,
                  `prenom` varchar(50) NOT NULL,
                  `email` varchar(100) NOT NULL,
                  `password` varchar(100) NOT NULL,
                  `adresse` varchar(255) NOT NULL,
                  `code_postal` int NOT NULL,
                  `pays` varchar(40) NOT NULL,
                  `date_join` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `email` (`email`)
                )";

                $result = self::$db->exec($sql2);
                echo $result;

            } catch (PDOException $e) {
                echo "Erreur de la connexion à la dn : " . $e->getMessage();
                die();
            }
        }
        return self::$db;

    }
}