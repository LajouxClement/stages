<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$juryDAO = new JuryDAO();
$encadrantDAO = new EncadrantDAO();
$etudiantDAO = new EtudiantDAO();
$salleDAO = new SalleDAO();
$soutenanceDAO=new SoutenanceDAO();
$sectionDAO = new SectionDAO();
$coherenceDAO = new CoherenceDAO();

/** get jury by salle **/
if (isset($_POST['getNoSalle']) && !empty($_POST['getNoSalle']) && is_numeric($_POST['getNoSalle']) && (int) $_POST['getNoSalle'] > 0 && isset($_POST['getSection']) && !empty($_POST['getSection']) && is_numeric($_POST['getSection']) && (int) $_POST['getSection'] > 0 && !isset($_POST['getIdJury'])) {
    $arr = array();
    
    //variables pour les cohérences
    $PhraseErreurNbEtudiant="<br /><strong>Attention !</strong> Les étudiants suivants ont plusieurs soutenances:<br />";
    $nbErreur=0;
    
    $PhraseErreurNbJury="<br /><strong>Attention !</strong> les jurys ont plusieurs soutenances dans une même salle à la même heure:<br />";
    $nbErreurJury=0;
    
    $PhraseErreurNbSoutenance="<br /><strong>Attention !</strong> Les enseignants suivants ont plusieurs soutenances à la même heure:<br />";
    $nbErreurSoutenance=0;
    
    foreach ($juryDAO->getByIdNoSalle($_POST['getNoSalle'],$_POST['getSection']) as $data) {

        $jury = new Jury($data->no, $data->no_ordre, 
                new Encadrant($data->noPdt, $data->nompdt, $data->prenompdt, '', '', '', ''), 
                new Encadrant($data->noEnc, $data->nomens, $data->prenomens, '', '', '', ''), 
                new Encadrant($data->noExpCom, $data->nomexpcom, $data->prenomexpcom, '', '', '', ''), $data->no_salle, $data->date
        );

        $etudiant = $etudiantDAO->getEtudiantByNoJury($jury->getNo());
        
        $explode = explode('-', $jury->getDate());
        //split date format Y-m-d ex: 2010-05-20
        $dateFr = strftime("%A %d/%m", mktime(0, 0, 0, $explode[1], $explode[2], $explode[0]));

        $soutenance = '';
        if (!empty($etudiant)) {
            foreach ($etudiant as $data) {
                $explodeHour = explode(':', $data->heure);
                $soutenance .= '<b><u>'.$explodeHour[0] . 'h' . $explodeHour[1] . ':</u></b><span class="' . $data->nom . $data->no_etud.'"> ' . $data->nom . ' ' . $data->prenom.'</span>, ';
            }
            $soutenance = substr($soutenance, 0, -2);
        }
        
        array_push($arr, array("no" => $jury->getNo(), "noOrdre" => $jury->getNoOrdre(), 'noPdt' => $jury->getNoPdt()->getNoEnc(), 'noEns' => $jury->getNoEns()->getNoEnc(), 'noExpcom' => $jury->getNoExpcom()->getNoEnc(), 'noSalle' => $jury->getNoSalle(), 'date' => $dateFr,
            'nomPresident' => $jury->getNoPdt()->getNomEnc(), 'prenomPresident' => $jury->getNoPdt()->getPrenomEnc(), //pdt
            'nomEnseignant' => $jury->getNoEns()->getNomEnc(), 'prenomEnseignant' => $jury->getNoEns()->getPrenomEnc(), //ens2
            'nomExpCom' => $jury->getNoExpcom()->getNomEnc(), 'prenomExpCom' => $jury->getNoExpcom()->getNomEnc(), //exp com
            'soutenance' => $soutenance, 'eleve' => 'true', 'dateBdd' => $jury->getDate()));
    }
    
    foreach ($etudiantDAO->getEtudiantPromoByRoom($_POST['getSection'],$_POST['getNoSalle']) as $data) { 
        $etudiant = new Etudiant($data->no_etud, $data->nom,  $data->prenom, 0, 0, 0, 0);
        $nbSoutenance=$coherenceDAO->soutienDeja($etudiant->getNoEtud())->total;
        
        if($nbSoutenance>1)
        {
            $nbErreur++;
            array_push($arr, array("noEtud" => $data->nom . $data->no_etud, "nbErreurEleve" => $nbErreur,"etudiant" => $etudiant->getNom().' '.$etudiant->getPrenom(), "Eleve"=> 'false'));
        }
    }
    
    foreach ($juryDAO->getJuryByYearByPromo($_POST['getNoSalle']) as $data) { 
        $jury = new Jury($data->no, $data->no_ordre,  $data->no_pdt, $data->no_ens2, $data->no_expcom, $data->no_salle, $data->date);
        $heureMin = $soutenanceDAO->getMinHourJury($jury->getNo())->heure;
        $heureMax = $soutenanceDAO->getMaxHourJury($jury->getNo())->heure;
        $nbJurySalle = $coherenceDAO->deuxSoutDeuxJury($data->date, $data->no_salle, $heureMax, $heureMin)->total;
        
        if($nbJurySalle>1)
        {
            $nbErreurJury++;
            array_push($arr, array("nbErreurJury" => $nbErreurJury, "noJury" => $data->no, "Eleve"=> 'false'));
        }

    }
  
     //Cet algo fait ralentir la mise en page
    foreach ($encadrantDAO->requestByUtil($_POST['getNoSalle'],$_POST['getSection']) as $data) { 
        //print_r($data);
        $encadrant = new Encadrant($data->no_enc, $data->nomenc,  $data->prenomenc, 0, 0, 0, 0);
        foreach ($encadrantDAO->getJourByEncadrant($encadrant->getNoEnc()) as $jour) { 
            $heureMin = $soutenanceDAO->getMinHourJury($jour->no)->heure;
            $heureMax = $soutenanceDAO->getMaxHourJury($jour->no)->heure;
            $nbJurySoutenance = $coherenceDAO->encDeuxJuryMemeTemps ($jour->date, $heureMin, $heureMax, $encadrant->getNoEnc())->total;
            if($nbJurySoutenance>1)
            {
            $nbErreurSoutenance++;
            array_push($arr, array("nbErreurSoutenance" => $nbErreurSoutenance, "noJury" => $jour->no, "enseignant" => $data->nomenc." ".$data->prenomenc, "Eleve"=> 'false'));
            }
        }
    }
    
    
    exit(json_encode($arr));
}

/* onglet avancement*/
if (isset($_POST['getNoSalle']) && $_POST['getNoSalle'] == -1 && isset($_POST['getSection']) && !empty($_POST['getSection']) && is_numeric($_POST['getSection']) && (int) $_POST['getSection'] > 0) {
    $arr = array();
    foreach ($encadrantDAO->requestByName() as $data) {

        $enseignant = new Encadrant($data->no_enc, $data->nomenc, $data->prenomenc, 0, 0, $data->inactif, $data->encadrement);
        $encadrant = $enseignant->getNomEnc() . ' ' . $enseignant->getPrenomEnc();
        
        $suivi = (int) $sectionDAO->getNumSuiviByNoSection($_POST['getSection'])->suivi;
        $noenc = (int) $encadrantDAO->getNoEncByNoSection($_POST['getSection'])->no_enc;
        
        $totalEtudiant = (int) $encadrantDAO->getNbEtudiantByEncadrant($enseignant->getNoEnc(),$_POST['getSection'],$suivi)->total;
        
        
        
        $totalJury = (int) $juryDAO->getNbJuryByEncadrant($enseignant->getNoEnc(),$_POST['getSection'])->total;
        $totalSoutenance = (int) $juryDAO->getNbSoutenanceByEncadrant($enseignant->getNoEnc(),$_POST['getSection'])->total;        
        $totalIntervention = $juryDAO->getInterventionByEncadrant($enseignant->getNoEnc(),$_POST['getSection']);
        $totalEtudiantPlace = (int) $encadrantDAO->getNbEtudiantPlaceByEncadrant($enseignant->getNoEnc(),$_POST['getSection'])->total;
        $totalPromo=(int) $etudiantDAO->getNbEtudiantPromo($_POST['getSection'])->total;
        $intervention = ' ';

        if (!empty($totalIntervention)) {
            foreach ($totalIntervention as $date) {
                $explode = explode('-', $date->date);
                $dateFr = strftime("%A %d/%m", mktime(0, 0, 0, $explode[1], $explode[2], $explode[0]));
                $explodeHour = explode(':', $date->heure);
                $intervention .= $dateFr . ' ' . $explodeHour[0] . 'h' . $explodeHour[1] . ', ';
            }
            $intervention = substr($intervention, 0, -2);
        }

        if ($data->inactif == 0 && $data->encadrement == 1 && $suivi == 1) {
            array_push($arr, array("encadrant" => $encadrant, "etudiant" => $totalEtudiant, 'jurys' => $totalJury, 'soutenance' => $totalSoutenance, 'intervention' => $intervention, 'etudiantPlace' => $totalEtudiantPlace, 'Promo' => $totalPromo, 'eleve' => 'true'));
        }
        elseif ($data->inactif == 0 && $data->encadrement == 1 && $suivi == 0 && $noenc == $enseignant->getNoEnc() ) {
            array_push($arr, array("encadrant" => $encadrant, "etudiant" => $totalEtudiantPlace, 'jurys' => $totalJury, 'soutenance' => $totalSoutenance, 'intervention' => $intervention, 'etudiantPlace' => $totalEtudiant, 'Promo' => $totalPromo, 'eleve' => 'true'));
        }
        elseif ($data->inactif == 0 && $data->encadrement == 1 && $suivi == 0 ) {
            array_push($arr, array("encadrant" => $encadrant, "etudiant" => 0, 'jurys' => $totalJury, 'soutenance' => $totalSoutenance, 'intervention' => $intervention, 'etudiantPlace' => $totalEtudiantPlace, 'Promo' => $totalPromo, 'eleve' => 'true'));
        }
        
    }
    exit(json_encode($arr));
}
/** delete jury **/
if (isset($_POST['getIdJury']) && !empty($_POST['getIdJury']) && is_numeric($_POST['getIdJury']) && (int) $_POST['getIdJury'] > 0 && isset($_POST['getNoSalle']) && !empty($_POST['getNoSalle']) && is_numeric($_POST['getNoSalle']) && (int) $_POST['getNoSalle'] > 0) {
    $arr = array();
    $jury = new Jury($_POST['getIdJury'], '', '', '', '', '', '');
    $juryDAO->delete($jury);
    $soutenanceDAO->deleteByNoJury($_POST['getIdJury']);
    array_push($arr, array("nosalle" => $_POST['getNoSalle']));
    exit(json_encode($arr));
}