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

 
/**
 * Description of EtudiantDAO
 *
 * @author Ludo
 */
class EtudiantDAO extends AbstractDAORead {

    //put your code here

    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function getById($id) {
        $query = $this->prepare("SELECT * FROM etudiant WHERE no_etud = ?");
        $query->bindValue(1,$id,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query("SELECT * FROM etudiant")->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEtudiantByNoJury($jury){
        $query = $this->db->prepare("SELECT * FROM jury, soutenance, etudiant WHERE jury.no=soutenance.no_jury and etudiant.no_etud=soutenance.no_etud and no= ? ORDER BY soutenance.heure ASC");
        $query->bindValue(1,$jury,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function placer($nom1, $nom2, $local) {
        //regarde si section est lp web
        $quer=$this->db->prepare("SELECT no_section AS no FROM section WHERE libelle_section = ?");
        $quer->bindValue(1, "LP SIL WCE", PDO::PARAM_STR);
        $quer->execute();
        $sec = $quer->fetch(PDO::FETCH_OBJ);
        
        //regarde si il y a une association section
        $quera=$this->db->prepare("SELECT no_section2 AS no FROM association_sections WHERE no_section1 = ? AND annee_diplome = ?");
        $quera->bindValue(1, $local, PDO::PARAM_INT);
        $quera->bindValue(2, date('Y'), PDO::PARAM_INT);
        $quera->execute();
        $assoc = $quer->fetch(PDO::FETCH_OBJ);
        
        //stockage numero section associé dans variable
        $avec = (!empty($assoc)) ? $assoc->no : NULL;
        
        if ($sec->no == $local) {
            $query=$this->db->prepare("SELECT no_etud, nom, prenom 
                                    FROM etudiant 
                                    WHERE no_section = ?
                                    UNION
                                    SELECT et.no_etud, et.nom, et.prenom 
                                    FROM etudiant AS et
                                    LEFT JOIN stage AS st ON et.no_etud = st.no_etud
                                    LEFT JOIN encadrant AS enc ON st.no_enc = enc.no_enc
                                    WHERE no_section = ?
                                    AND st.no_enc IN (?, ?)
                                    AND et.no_etud NOT IN
                                    (SELECT no_etud
                                    FROM soutenance)
                                    ORDER BY nom;");
            $query->bindValue(1, $local, PDO::PARAM_INT);
            $query->bindValue(2, $avec, PDO::PARAM_INT);
            $query->bindValue(3, $nom1, PDO::PARAM_INT);
            $query->bindValue(4, $nom2, PDO::PARAM_INT);
        }else {
            $query=$this->db->prepare("SELECT et.no_etud, nom, prenom
                                    FROM etudiant AS et
                                    LEFT JOIN stage AS st ON et.no_etud = st.no_etud
                                    LEFT JOIN encadrant AS enc ON st.no_enc = enc.no_enc
                                    LEFT JOIN section AS se ON et.no_section = se.no_section
                                    WHERE enc.no_enc IN (?, ?)
                                    AND et.no_section = ? 
                                    UNION
                                    SELECT et.no_etud, et.nom, et.prenom 
                                    FROM etudiant AS et
                                    LEFT JOIN stage AS st ON et.no_etud = st.no_etud
                                    LEFT JOIN encadrant AS enc ON st.no_enc = enc.no_enc
                                    WHERE no_section = ?
                                    AND et.no_etud NOT IN
                                    (SELECT no_etud
                                    FROM soutenance)
                                    ORDER BY nom;");
        
            $query->bindValue(1, $nom1, PDO::PARAM_INT);
            $query->bindValue(2, $nom2, PDO::PARAM_INT);
            $query->bindValue(3, $local, PDO::PARAM_INT);
            $query->bindValue(4, $avec, PDO::PARAM_INT);
        }
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
        
    }
     
     public function getNbEtudiantPromo($section) {
        $query=$this->db->prepare("SELECT count(*) as total FROM `stage`s,`etudiant`e WHERE e.no_section=? and e.no_etud=s.no_etud and date_validation BETWEEN ? and ?");
        $query->bindValue(1, $section, PDO::PARAM_STR);
        $query->bindValue(2, date('Y').'-01-01', PDO::PARAM_STR);
        $query->bindValue(3, date('Y').'-12-31', PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
         public function getEtudiantPromoByRoom($section,$noSalle) {
        $query=$this->db->prepare("SELECT e.no_etud, nom, prenom 
                                   FROM `stage`s,`etudiant`e, `soutenance` sou, `jury` j
                                   WHERE e.no_section=? 
                                   and e.no_etud=s.no_etud 
                                   and date_validation BETWEEN ? and ?
                                   AND e.no_etud=sou.no_etud
                                   AND sou.no_jury=j.no
                                   AND j.no_salle=?");
        $query->bindValue(1, $section, PDO::PARAM_STR);
        $query->bindValue(2, date('Y').'-01-01', PDO::PARAM_STR);
        $query->bindValue(3, date('Y').'-12-31', PDO::PARAM_STR);
        $query->bindValue(4, $noSalle, PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function mis($nom1, $nom2, $date, $salle) {
        $quer=$this->db->prepare("SELECT no
                                FROM jury
                                WHERE date = ?
                                AND no_salle = ?
                                AND no_pdt = ?
                                AND no_ens2 = ?");
        
        $quer->bindValue(1, $date, PDO::PARAM_INT);
        $quer->bindValue(2, $salle, PDO::PARAM_INT);
        $quer->bindValue(3, $nom1, PDO::PARAM_INT);
        $quer->bindValue(4, $nom2, PDO::PARAM_INT);
        $quer->execute();
        
        $jur = $quer->fetch(PDO::FETCH_OBJ);
        $avec = (!empty($jur)) ? $jur->no : NULL;
        
        
        $query=$this->db->prepare("SELECT et.no_etud, et.nom, et.prenom, heure
                                FROM etudiant AS et
                                LEFT JOIN soutenance AS sout ON et.no_etud = sout.no_etud
                                WHERE no_jury = ? 
                                ORDER BY heure");

        $query->bindValue(1, $avec, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    public function dejaPlace($local){
        $query=$this->db->prepare("SELECT sout.no_etud
                                FROM soutenance AS sout
                                LEFT JOIN etudiant AS et ON sout.no_etud = et.no_etud
                                WHERE no_section = ?");
        
        $query->bindValue(1, $local, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
