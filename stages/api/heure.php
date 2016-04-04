<?php

/**
 * Created by PhpStorm.
 * User: dusju
 * Date: 02/10/2015
 * Time: 14:35
 */
$sectionDAO = new SectionDAO();

if (isset($_POST['requete']) && $_POST['requete'] == "getDureeSoutenance" && isset($_POST['noSection']) && is_numeric($_POST['noSection']) && (int) $_POST['noSection'] > 0) {
    $data = ($sectionDAO->getById($_POST['noSection']));
    $section = new Section($data->no_section, $data->libelle_section, $data->libelle_section_long, $data->duree_soutenance, $data->no_resp);

    exit(json_encode(['intervalle' => $section->getDureeSoutenance()]));
}