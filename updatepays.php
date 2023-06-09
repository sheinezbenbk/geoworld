<?php
/**
 * Ce script est composé de fonctions d'exploitation des données
 * détenues pas le SGBDR MySQL utilisées par la logique de l'application.
 *
 * C'est le seul endroit dans l'application où a lieu la communication entre
 * la logique métier de l'application et les données en base de données, que
 * ce soit en lecture ou en écriture.
 *
 * PHP version 7
 *
 * @category  Database_Access_Function
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2023 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

/**
 *  Les fonctions dépendent d'une connection à la base de données,
 *  cette fonction est déportée dans un autre script.
 */
require_once 'inc/connect-db.php';
//on récupère et on vérifie les données reçues par le formulaire
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'] ;
}
// à faire sur chaque donnée reçue
$nom = $_GET['Name'];
$population = $_GET['Population'];
$capital = $_GET['Capital'];
$cont=$_GET['continent'];




// on rédige la requête SQL
$sql = "UPDATE country set Name=:nom, Population=:population where id=:id";
$sql2 = "UPDATE city set Name=:nom where idcountry=:id";
try {
    //on prépare la requête avec les données reçues
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->bindParam(':population', $population, PDO::PARAM_INT);
    $stat = $pdo->prepare($sql2);
    $stat->bindParam(':id', $id, PDO::PARAM_INT);
    $stat->bindParam(':nom', $capital, PDO::PARAM_STR);
    $statement->execute();
    $stat->execute();
    
    //On renvoie vers la page d'accueil
    header("Location:index.php?");
}
catch(PDOException $e){
    echo 'Erreur : '.$e->getMessage();
}


?>