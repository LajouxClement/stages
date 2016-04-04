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

if (isset($_POST['valPresident']) && isset($_POST['valEnseignant']) && isset($_POST['valDate']) && isset($_POST['valSalle'])) {
    $arr = array();
    $president = (int) (!empty($_POST['valPresident'])) ? $_POST['valPresident'] : -1;
    $enseignant = (int) (!empty($_POST['valEnseignant'])) ? $_POST['valEnseignant'] : -1;
    $laDate = (int) (!empty($_POST['valDate'])) ? $_POST['valDate'] : -1;
    $laSalle = (int) (!empty($_POST['valSalle'])) ? $_POST['valSalle'] : -1;
    foreach ($etudiantDAO->mis($president, $enseignant, $laDate, $laSalle) as $data) {
        array_push($arr, array("noEtud" => $data->no_etud, "nom" => $data->nom, 'prenom' => $data->prenom, 'heure' => $data->heure));
    }
    exit(json_encode($arr));
    
}