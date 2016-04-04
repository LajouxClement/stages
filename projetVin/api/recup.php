<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 15/03/2016
 * Time: 15:19
 */


$utilisateurDAO = new UtilisateurDAO();
$arr = array();
if(isset($_POST['emailrecup'])){

    $unknownUser = new Utilisateur(null,null,null,null,htmlspecialchars($_POST['emailrecup']),null,null);
    $user=$utilisateurDAO->getByMail($unknownUser);
    $codeRecup = $utilisateurDAO->getCodeRecup($user->id_user);
    // print_r($user);
    if(!empty($user)){
        array_push($arr, array("identifiant" => $user->id_user, "mail" => $user->mail_user, "codeRecup" => $codeRecup));
    }
    else{
        array_push($arr, array("identifiant" => "null"));
    }


}

exit(json_encode($arr));