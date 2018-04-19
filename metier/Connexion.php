<?php
include '../classes/Queries.php';

$values = array($_POST['surnom'],$_POST['mail'],hash('MD5', $_POST['mdp']));

$getID= new Queries();

$_SESSION['idUser'] = $getID;

