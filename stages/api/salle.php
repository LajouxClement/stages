<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$salleDAO = new SalleDAO();
$coherenceDAO = new CoherenceDAO();
$etudiantDAO = new EtudiantDAO();

if (isset($_POST['getAllSalle']) && $_POST['getAllSalle'] === "true") {
    $arr = array();
    foreach ($salleDAO->request() as $data) {
        $salle = new Salle($data->no_salle, $data->nom_salle,  $data->utilisee);

        array_push($arr, array("noSalle" => $salle->getNoSalle(), "nomSalle" => $salle->getNomSalle(), 'utilisee' => (int) $salle->getUtilisee()));
    }
    

    exit(json_encode($arr));
}

