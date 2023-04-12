<?php

/**
 * Return a database connection
 * 
 * @return PDO
 */
function getPdo(): PDO
{
    $servername = "localhost";
    $database = "meteoPoo";
    $username = "root";
    $password = "";

    try {
        $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "erreur de connexion:" . $e->getMessage();
        die();

        return $db;
    };
}

