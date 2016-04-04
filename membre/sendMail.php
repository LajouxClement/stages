<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 15/03/2016
 * Time: 14:01
 */
//mail('raimondi.jordan.57@gmail.com','test','ceci est un test');
$from = "From: \"Raimondi1univ\"<raimondi1univ@gmail.com>" ;
$replyTo = "Reply-to: \"Raimondi1univ\"<raimondi1univ@gmail.com>" ;

$mail = $_POST['mail']; // adresse de destination !
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}

//=====Déclaration des messages au format texte et au format HTML.

$message_txt = "Vous avez oublié votre mot de passe ?! cliquez sur le lien pour le réinitialiser : http://localhost/projects/ProjetVin/site/code.php?u=".$_POST['id']."&cd=".$_POST['codeRecup'];

$message_html = "<html><head></head><body><b>Vous avez oublié votre mot de passe ?!</b>,cliquez sur le lien pour le réinitialiser : <li href='http://localhost/projects/ProjetVin/site/code.php?u=".$_POST['id']."&cd=".$_POST['codeRecup']."'>http://localhost/projects/ProjetVin/site/code.php?u=".$_POST['id']."&cd=".$_POST['codeRecup']."</li>.</body></html>";

//==========

$boundary = "-----=".md5(rand()); // chaine aléatoire, sert de séparation des deiffferentes parties du mail.



//=====Définition du sujet.
$sujet = "Recuperation de mdp";
//=========

//=====Création du header de l'e-mail
$header = $from.$passage_ligne;

$header .= $replyTo.$passage_ligne;

$header .= "MIME-Version: 1.0".$passage_ligne;

$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//==========

//=====Création du message.

$message = $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format texte.

$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_txt.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format HTML

$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_html.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

//==========

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========

?>