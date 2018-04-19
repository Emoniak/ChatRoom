<?php
include '../classes/Queries.php';

$values = array($_POST['mail'],hash('MD5', $_POST['mdp']));

$requette= new Queries();
$getID= $requette->getDonneesUtilisateur($values);



$_SESSION['idUser'] = $getID;

