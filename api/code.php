<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 22/03/2016
 * Time: 16:13
 */
$utilisateurDAO = new UtilisateurDAO();
$arr = array();
if(isset($_POST['mdp']) && isset($_POST['id'])){

    $user = new Utilisateur($_POST['id'],null,null,null,null,$_POST['mdp'],null);
    $errorCode = $utilisateurDAO->update($user);
    // print_r($user);


}else{
    $errorCode = 'pb parametre';
}
echo($errorCode);