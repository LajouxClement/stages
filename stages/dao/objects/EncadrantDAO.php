<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EncadrantDAO
 *
 * @author Clément
 */
class EncadrantDAO extends AbstractDAORead {

//put your code here

    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function getById($id) {
        $query = $this->db->prepare("SELECT * FROM encadrant WHERE no_enc = ?");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query('SELECT * FROM encadrant ORDER BY nomenc')->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function requestByUtil($noSalle,$noSection) {
        $query=$this->db->prepare('SELECT DISTINCT(nomenc), prenomenc, no_enc  FROM encadrant, jury, etudiant, section, soutenance
                                 WHERE expcom=0 
                                 AND inactif=0 
                                 AND (encadrant.no_enc=jury.no_pdt OR encadrant.no_enc=jury.no_ens2)
                                 AND jury.no_salle=?
                                 and jury.no=soutenance.no_jury 
                                 and soutenance.no_etud=etudiant.no_etud 
                                 and etudiant.no_section=?
                                 ORDER BY nomenc');
        $query->bindValue(1, $noSalle, PDO::PARAM_INT);
        $query->bindValue(2, $noSection, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function requestByName() {
        return $this->db->query('SELECT * FROM encadrant ORDER BY `encadrant`.`nomenc`')->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getNbEtudiantByEncadrant($idEnc,$section,$suivi) {
        if($suivi == 1){
            $query=$this->db->prepare("SELECT count(*) as total FROM `stage`s,`etudiant`e WHERE e.no_section=? and s.no_enc=? and e.no_etud=s.no_etud and date_validation BETWEEN ? and ?");
            $query->bindValue(1, $section, PDO::PARAM_STR);
            $query->bindValue(2, $idEnc, PDO::PARAM_INT);
            $query->bindValue(3, date('Y').'-01-01', PDO::PARAM_STR);
            $query->bindValue(4, date('Y').'-12-31', PDO::PARAM_STR);
            $query->execute();

            return $query->fetch(PDO::FETCH_OBJ);
        }
        elseif($suivi == 0){
            $query=$this->db->prepare("SELECT count(*) as total FROM `stage`s,`etudiant`e WHERE e.no_section=? and s.no_enc IS NULL and e.no_etud=s.no_etud and date_validation BETWEEN ? and ?");
            $query->bindValue(1, $section, PDO::PARAM_STR);
            $query->bindValue(2, date('Y').'-01-01', PDO::PARAM_STR);
            $query->bindValue(3, date('Y').'-12-31', PDO::PARAM_STR);
            $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
        }
 
    }
    
    public function getNbEtudiantPlaceByEncadrant($idEnc,$section) {
        $query=$this->db->prepare("SELECT COUNT(s.no_etud) AS total FROM stage s 
                                   WHERE s.no_enc=?
                                   AND s.date_validation BETWEEN ? AND ? 
                                   AND s.no_etud IN (SELECT ss.no_etud 
                                                     FROM jury j,soutenance ss, section sec, etudiant e, calendrier ca
                                                     WHERE (j.no_pdt=? OR j.no_ens2=?)
                                                     AND j.date BETWEEN ? AND ?
                                                     AND ss.no_jury = j.no
                                                     AND ss.no_etud=e.no_etud
                                                     AND e.no_section=sec.no_section
                                                     AND sec.no_section=ca.no_section
                                                     AND ca.no_section=?
                                                    )");
        $query->bindValue(1, $idEnc, PDO::PARAM_INT);
        $query->bindValue(2, date('Y').'-01-01', PDO::PARAM_STR);
        $query->bindValue(3, date('Y').'-12-31', PDO::PARAM_STR);
        $query->bindValue(4, $idEnc, PDO::PARAM_INT);
        $query->bindValue(5, $idEnc, PDO::PARAM_INT);
        $query->bindValue(6, date('Y').'-01-01', PDO::PARAM_STR);
        $query->bindValue(7, date('Y').'-12-31', PDO::PARAM_STR);
        $query->bindValue(8, $section, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    
    public function getNoEncByNoSection($noSection){
         $query = $this->db->prepare("SELECT no_enc 
             FROM `section`s ,`responsable`r,`encadrant`e 
             WHERE s.no_section = ?
             AND s.no_resp=r.no_resp
             AND r.nom_resp = e.nomenc 
             AND r.prenom_resp = e.prenomenc");
        $query->bindValue(1,$noSection,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function getMinHourByEncadrant($idEnc, $jour)
    {
        $query = $this->db->prepare("SELECT jury.no, MIN(heure)
                                    FROM soutenance AS sout
                                    LEFT JOIN jury ON sout.no_jury = jury.no
                                    LEFT JOIN encadrant AS enc ON jury.no_pdt = enc.no_enc
                                    WHERE date=?
                                       AND (jury.no_pdt=? or jury.no_ens2=?)
                                    GROUP BY jury.date");
        $query->bindValue(1, $jour, PDO::PARAM_STR);
        $query->bindValue(2, $idEnc, PDO::PARAM_STR);
        $query->bindValue(3, $idEnc, PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);   
    }

        public function getMaxHourByEncadrant($idEnc, $jour)
    {
        $query = $this->db->prepare("SELECT jury.no, Max(heure)
                                    FROM soutenance AS sout
                                    LEFT JOIN jury ON sout.no_jury = jury.no
                                    LEFT JOIN encadrant AS enc ON jury.no_pdt = enc.no_enc
                                    WHERE date= ?
                                    AND (jury.no_pdt=? or jury.no_ens2=?)
                                    GROUP BY jury.date");
        $query->bindValue(1, $jour, PDO::PARAM_STR);
        $query->bindValue(2, $idEnc, PDO::PARAM_STR);
        $query->bindValue(3, $idEnc, PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);   
    }
    
    
            public function getJourByEncadrant($idEnc)
    {
        $query = $this->db->prepare("SELECT *
                                    FROM soutenance AS sout
                                    LEFT JOIN jury ON sout.no_jury = jury.no
                                    LEFT JOIN encadrant AS enc ON jury.no_pdt = enc.no_enc
                                    WHERE date BETWEEN ? AND ?
                                    AND (jury.no_pdt=? or jury.no_ens2=?)
                                    GROUP BY jury.no");
        $query->bindValue(1, date('Y').'-01-01', PDO::PARAM_STR);
        $query->bindValue(2, date('Y').'-12-31', PDO::PARAM_STR);
        $query->bindValue(3, $idEnc, PDO::PARAM_STR);
        $query->bindValue(4, $idEnc, PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);   
    }
    
}


