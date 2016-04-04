<?php

/*
 * The MIT License
 *
 * Copyright 2015 Ludovic Sanctorum <ludovic.sanctorum@gmail.com>.
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

//instance DAO
$juryDAO = new JuryDAO();
$soutenanceDAO = new SoutenanceDAO();
//end 

$section = (isset($_POST['section']) && !empty($_POST['section'])) ? $_POST['section'] : NULL;
if (isset($_POST['send']) && $_POST['send'] == "true") {

    $salle = (isset($_POST['idSalle']) && !empty($_POST['idSalle'])) ? $_POST['idSalle'] : NULL;
    $president = (isset($_POST['idPresident']) && !empty($_POST['idPresident'])) ? $_POST['idPresident'] : NULL;
    $enseignant = (isset($_POST['idEnseignant']) && !empty($_POST['idEnseignant'])) ? $_POST['idEnseignant'] : NULL;
    $expCom = (isset($_POST['idExpCom']) && !empty($_POST['idExpCom'])) ? $_POST['idExpCom'] : NULL; // can be null
    $jour = (isset($_POST['dateJour']) && !empty($_POST['dateJour'])) ? $_POST['dateJour'] : NULL;
    $etudiants = (isset($_POST['etudiants']) && !empty($_POST['etudiants'])) ? $_POST['etudiants'] : NULL;

    if ($section != NULL && $salle != NULL && $president != NULL && $enseignant != NULL && $jour != NULL) {
        $juryExists = $juryDAO->exists(new Jury('', '', $president, $enseignant, '', $salle, $jour));
        if ($juryExists->total > 0) { //it exists
            $soutenanceDAO->delete(new Soutenance('', $juryExists->no, '', '')); // no update, delete all and create after
            $idJury = $juryExists->no;
        } else { //jury doesn't exists, create
            $idJury = $juryDAO->create(new Jury('', '', $president, $enseignant, $expCom, $salle, $jour));
        }
    }

    if (isset($idJury) && !empty($idJury) && $etudiants != NULL) {
        foreach ($etudiants as $data) {
            $soutenanceDAO->create(new Soutenance('', $idJury, $data['noEtud'], $data['heureEtud']));
        }
    }
}

if ($section != NULL) {
    $i = 1;
    foreach ($juryDAO->getOrderNumber($section) as $data) {
        $juryDAO->updateOrderNumber($i, $data->no); //sort and udpate no_order of jury
        ++$i;
    }
}


echo json_encode(array("createOk" => "ok"));
