<?php

/**
 * Created by PhpStorm.
 * User: dusju
 * Date: 30/09/2015
 * Time: 15:46
 */
if (isset($_POST['requete']) && $_POST['requete'] == "getAllJour") {
    $calendrierDAO = new CalendrierDAO();
    $arr = array();
    foreach ($calendrierDAO->getJourByNoSection($_POST['noSection']) as $data) {
        $calendrier = new Calendrier('', '', '', $data->date, '');

        array_push($arr, array("dateParse" => $calendrier->parseDate(), "date" => $calendrier->getDate()));
    }
    exit(json_encode($arr));
}
