<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vinDao = new vinDAO();
$arr = array();


$vins = $vinDao->getAll();
foreach($vins as $vin){

    array_push($arr, array("nomVin" => $vin["nom_vin"],
        "nomCepage" => $vin["nom_cepage"],
        "noteTesteur" => $vin["note_testeur"],
        "couleur" => $vin["couleur"],
        "urlImage" => $vin["url_img"],
        "anneeVin" => $vin["annee_vin"],
        "idUser" => $vin["id_user"],
        "latitude" => $vin["latitude"],
        "longitude" => $vin["longitude"],
        "id" => $vin["id_vin"]));
}



exit(json_encode($arr));

