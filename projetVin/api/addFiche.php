<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 20/03/2016
 * Time: 17:32
 */
$vinDao = new vinDAO();
$arr = array();
$vin = new vin(null, $_SESSION["idUser"], 1, " ", " ", "1", "rouge", " ", "2015", "1", "1");


$vinDao->create($vin);

$vins = $vinDao->getLastAdded();


array_push($arr, array("nomVin" => $vins->nom_vin,
    "nomCepage" => $vins->nom_cepage,
    "noteTesteur" => $vins->note_testeur,
    "couleur" => $vins->couleur,
    "urlImage" => $vins->url_img,
    "anneeVin" => $vins->annee_vin,
    "idUser" => $vins->id_user,
    "latitude" => $vins->latitude,
    "longitude" => $vins->longitude,
    "id" => $vins->id_vin));

exit(json_encode($arr));