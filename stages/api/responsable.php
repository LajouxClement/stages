<?php
/**
 * Created by PhpStorm.
 * User: dusju
 * Date: 25/09/2015
 * Time: 00:16
 */


$responsableDAO = new ResponsableDAO();
$sectionDAO = new SectionDAO();

if (isset($_POST['getAllResponsable']) && $_POST['getAllResponsable'] == "true") {
    $arr = array();
    foreach ($responsableDAO->request() as $data) {
        $responsable = new Responsable($data->no_resp, $data->nom_resp, $data->prenom_resp, $data->civilite_resp, $data->login_resp, $data->pass_resp);

        array_push($arr, array("noResp" => $responsable->getNoResp(), "nomResp" => $responsable->getNomResp(),
            "prenomResp" => $responsable->getPrenomResp(), "civiliteResp" => $responsable->getCiviliteResp(), "loginResp" => $responsable->getLoginResp(),
            "passResp" => $responsable->getPassResp()));
    }
    exit(json_encode($arr));
}


if(isset($_POST['idRes']) && !empty($_POST['idRes']) && is_numeric($_POST['idRes']) && (int) $_POST['idRes'] > 0){
    $idRes = (int) $_POST['idRes'];
    $arr = array();
    foreach($sectionDAO->getSectionByResponsable($idRes) as $data){
        $section = new Section($data->no_section, $data->libelle_section, $data->libelle_section_long, '', $idRes);
        
        array_push($arr, array("noSection" => $section->getNoSection(), "lib" => $section->getLibelleSection(), "libLong" => $section->getLibelleSectionLong()));
    }
    exit(json_encode($arr));
    
}
