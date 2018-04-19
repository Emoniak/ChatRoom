<?php
include '../classes/Queries.php';

$values = array($_POST['mail'],hash('MD5', $_POST['mdp']));

$requette= new Queries();
$canConnect = $requette -> connexionUtilisateur($values);
if ($canConnect) {
    $donnees = $requette -> getDonneesUtilisateur($values);
    foreach ($donnees as $key => $value) {
        $_SESSION["$key"] = $value;
    }

    header('Location: index.php');
    return;
}
header('Location: Connexion.php');
