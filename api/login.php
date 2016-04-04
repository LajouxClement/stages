<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$utilisateurDAO = new UtilisateurDAO();
$arr = array();
if(isset($_POST['email']) && isset($_POST['psw'])){
    
    $unknownUser = new Utilisateur(null,null,null,null,htmlspecialchars($_POST['email']),htmlspecialchars($_POST['psw']),null);
    $user=$utilisateurDAO->getByNameAndPassword($unknownUser);
    //print_r($user);
    if(!empty($user)){
        array_push($arr, array("identifiant" => $user->nom_user.' '.$user->prenom_user, "droit" => $user->id_droit, "idUser" => $user->id_user));
    }
    else{
        array_push($arr, array("identifiant" => "null"));
    }
    
    exit(json_encode($arr));
}
