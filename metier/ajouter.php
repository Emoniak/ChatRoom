<?php
    include '../classes/Queries.php';

    $values = array($_POST['surnom'],$_POST['mail'],hash('MD5', $_POST['mdp']));

    $insert = new Queries();
    $insert->insertUtilisateur($values);