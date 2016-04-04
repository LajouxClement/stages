<?php

/* 
 * The MIT License
 *
 * Copyright 2015 Guillaume.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

$etudiantDAO = new EtudiantDAO();

if (isset($_POST['valPresident']) && isset($_POST['valEnseignant'])) {
    $arr = array();
    $tabSout = [];
    $president = (int) (!empty($_POST['valPresident'])) ? $_POST['valPresident'] : -1;
    $enseignant = (int) (!empty($_POST['valEnseignant'])) ? $_POST['valEnseignant'] : -1;
    $section = (int) (!empty($_POST['section'])) ? $_POST['section'] : -1;
    $i=0;
    
    foreach ($etudiantDAO->dejaPlace($section) as $dataPlace) {
        $tabSout[$i] = $dataPlace->no_etud;
        $i++;
    }
    
    foreach ($etudiantDAO->placer($president, $enseignant, $section) as $data) {
        $i=0;
        $trouve=false;
        $etudiant = new Etudiant($data->no_etud, $data->nom,  $data->prenom, '', '');
        while($i<count($tabSout)&&$trouve==false){
            if($etudiant->getNoEtud()==$tabSout[$i]){
                $trouve=true;
            }else{
                $i++;
            }
        }
        if($trouve==true){
            array_push($arr, array("noEtud" => $etudiant->getNoEtud(), "nom" => $etudiant->getNom(), 'prenom' => $etudiant->getPrenom(), 'anneeDiplome' => $etudiant->getAnneeDiplome(), 'noSection' => $etudiant->getNoSection(), 'place' => 1));
        }else{
            array_push($arr, array("noEtud" => $etudiant->getNoEtud(), "nom" => $etudiant->getNom(), 'prenom' => $etudiant->getPrenom(), 'anneeDiplome' => $etudiant->getAnneeDiplome(), 'noSection' => $etudiant->getNoSection(), 'place' => 0));
        }
    }
    
    exit(json_encode($arr));
}

if (isset($_POST['getAllEtudiant']) && $_POST['getAllEtudiant'] == "true") {
    $arr = array();
    foreach ($etudiantDAO->request() as $data) {
        $etudiant = new Etudiant($data->no_etud, $data->nom, $data->prenom, $data->annee_diplome, $data->no_section);

        array_push($arr, array("noEtud" => $etudiant->getNoEtud(), "nomEtud" => $etudiant->getNom(), "prenomEtud" => $etudiant->getPrenom(),
            "anneeDiplome" => $etudiant->getAnneeDiplome(), "noSection" => $etudiant->getNoSection()));
    }
    exit(json_encode($arr));
    
}

if (isset($_POST['getIdJury']) && !empty($_POST['getIdJury']) && is_numeric($_POST['getIdJury']) && (int) $_POST['getIdJury'] > 0){
    $arr = array();
    foreach ($etudiantDAO->getEtudiantByNoJury($_POST['getIdJury']) as $data) {
        $etudiant = new Etudiant($data->no_etud, $data->nom, $data->prenom, 0, 0);
        
        $explodeHour = explode(':', $data->heure);
        $heure =  $explodeHour[0] . 'h' . $explodeHour[1];
        
        array_push($arr, array( "nomEtud" => $etudiant->getNom(), "prenomEtud" => $etudiant->getPrenom(), "heure" => $heure, "id" => $etudiant->getNoEtud()));
    }
    exit(json_encode($arr));
}