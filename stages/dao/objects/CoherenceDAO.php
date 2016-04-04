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

/**
 * Description of CoherenceDAO
 *
 * @author Guillaume
 */
class CoherenceDAO {
    private $db;

    //TOUTES LES FONCTIONS DOIVENT ETRE UTILISEES AVANT AJOUT DANS LA BDD
    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }
    
    //VERIFIE SI UNE SOUTENANCE EXISTE DEJA POUR L'ETUDIANT
    public function soutienDeja ($etud) {
        $query=$this->db->prepare("SELECT count(no_sout) as total
                                    FROM soutenance
                                    WHERE no_etud = ?");
         
        $query->bindValue(1, $etud, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    //VERIFIE QUE DEUX JURY NE SONT PAS DANS LA MEME SALLE EN MEME TEMPS
    public function deuxSoutDeuxJury ($jour, $sal, $hmax, $hmin) {
        $query = $this->db->prepare("SELECT count(no) as total
                                     FROM Jury
                                     WHERE no in( SELECT sout.no_jury 
                                                  FROM soutenance AS sout
                                                  LEFT JOIN jury ON sout.no_jury = jury.no
                                                  WHERE date = ?
                                                  AND no_salle = ?
                                                  AND heure BETWEEN ? AND ?
                                                  GROUP BY no_jury)");
        $query->bindValue(1, $jour, PDO::PARAM_STR);
        $query->bindValue(2, $sal, PDO::PARAM_INT);
        $query->bindValue(3, $hmin, PDO::PARAM_STR);
        $query->bindValue(4, $hmax, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    //VERIFIE QU'UNE JURY N'A PAS DEUX SOUTENANCE EN MEME TEMPS DANS DES SALLES DIFFERENTES
    public function deuxSoutUnJury ($jour, $h, $jur) {
        $query = $this->db->prepare("SELECT count(no_salle)
                                    FROM jury 
                                    LEFT JOIN soutenance AS sout ON jury.no = sout.no_jury
                                    WHERE date = ?
                                    AND heure = ?
                                    AND no_jury = ?");
        $query->bindValue(1, $jour, PDO::PARAM_STR);
        $query->bindValue(2, $h, PDO::PARAM_STR);
        $query->bindValue(3, $jur, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    //VERIFIE QU'AU MOINS UN DES DEUX ENCADRANT ENCADRE L'ETUDIANT
    public function encadrePas ($enc1, $enc2, $etu) {
        $query = $this->db->prepare("SELECT count(no_etud)
                                    FROM stage
                                    WHERE no_etud = ?
                                    AND no_enc IN (?, ?)");
        $query->bindValue(1, $etu, PDO::PARAM_INT);
        $query->bindValue(2, $enc1, PDO::PARAM_INT);
        $query->bindValue(3, $enc2, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    //VERIFIE QU'UN ENCADRANT N'A PAS 2 SOUTENANCES EN MEME TEMPS AVEC DES JURY DIFFERENTS
    public function encDeuxJuryMemeTemps ($jour, $hmin, $hmax, $enc) {
        $query = $this->db->prepare("SELECT COUNT(jj.no) as total
                                    FROM jury jj
                                    WHERE jj.no in(SELECT jury.no
                                                    FROM soutenance AS sout
                                                    LEFT JOIN jury ON sout.no_jury = jury.no
                                                    LEFT JOIN encadrant AS enc ON jury.no_pdt = enc.no_enc
                                                    WHERE date = ?
                                                    AND heure BETWEEN ? AND ?
                                                    AND ? IN (no_pdt, no_ens2)
                                                    GROUP BY jury.no)");
        $query->bindValue(1, $jour, PDO::PARAM_STR);
        $query->bindValue(2, $hmin, PDO::PARAM_STR);
        $query->bindValue(3, $hmax, PDO::PARAM_STR);
        $query->bindValue(4, $enc, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
