<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JuryDAO
 *
 * @author Clément
 */
class JuryDAO extends AbstractDAOReadWrite {

    //put your code here

    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function create($obj) {
        $query = $this->db->prepare('INSERT INTO jury (no_ordre, no_pdt, no_ens2, no_expcom, no_salle, date) VALUES (?,?,?,?,?,?)');
        $query->bindValue(1, $obj->getNoOrdre(), PDO::PARAM_INT);
        $query->bindValue(2, $obj->getNoPdt(), PDO::PARAM_INT);
        $query->bindValue(3, $obj->getNoEns(), PDO::PARAM_INT);
        $query->bindValue(4, $obj->getNoExpcom(), PDO::PARAM_INT);
        $query->bindValue(5, $obj->getNoSalle(), PDO::PARAM_INT);
        $query->bindValue(6, $obj->getDate(), PDO::PARAM_STR);
        $query->execute();

        return $this->db->lastInsertId();
    }

    public function delete($obj) {
        $query = $this->db->prepare('DELETE FROM jury WHERE no = ?');
        $query->bindValue(1, $obj->getNo(), PDO::PARAM_INT);
        $query->execute();
    }

    public function getById($id) {
        $query = $this->prepare("SELECT * FROM jury WHERE no = ?");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query("SELECT * FROM jury")->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($obj) {
        $query = $this->db->prepare('UPDATE jury SET no_ordre = ?, no_pdt = ?, no_ens2 = ?, no_expcom = ?, no_salle = ?, date = ? WHERE no = ?');
        $query->bindValue(1, $obj->getNoOrdre(), PDO::PARAM_INT);
        $query->bindValue(2, $obj->getNoPdt(), PDO::PARAM_INT);
        $query->bindValue(3, $obj->getNoEns(), PDO::PARAM_INT);
        $query->bindValue(4, $obj->getNoExpcom(), PDO::PARAM_INT);
        $query->bindValue(5, $obj->getNoSalle(), PDO::PARAM_INT);
        $query->bindValue(6, $obj->getDate(), PDO::PARAM_STR);
        $query->bindValue(7, $obj->getNo(), PDO::PARAM_INT);
        $query->execute();
    }

    public function getByIdNoSalle($id, $section) {
        $query = $this->db->prepare("SELECT pdt.no_enc AS noPdt, ens.no_enc AS noEnc, expcom.no_enc AS noExpCom, pdt.nomenc AS nompdt, pdt.prenomenc AS prenompdt, ens.nomenc AS nomens, ens.prenomenc AS prenomens, expcom.nomenc AS nomexpcom, expcom.prenomenc AS prenomexpcom, j.date, `no_salle`, no, j.no_ordre
                                        FROM jury as j
                                        LEFT JOIN encadrant as pdt ON pdt.no_enc = j.no_pdt
                                        LEFT JOIN encadrant as ens ON ens.no_enc = j.no_ens2
                                        LEFT JOIN encadrant as expcom ON expcom.no_enc = j.no_expcom
                                        LEFT JOIN soutenance ON soutenance.no_jury = j.no
                                        LEFT JOIN etudiant ON etudiant.no_etud=soutenance.no_etud
                                        LEFT JOIN section ON section.no_section=etudiant.no_section
                                        LEFT JOIN calendrier ON calendrier.no_section=etudiant.no_section
                                        WHERE j.no_salle= ? 
                                        AND j.date BETWEEN ? AND ?
                                           AND section.no_section=?
                                        AND calendrier.no_evt=10
                                        GROUP BY no");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->bindValue(2, date('Y') . '-01-01', PDO::PARAM_STR);
        $query->bindValue(3, date('Y') . '-12-31', PDO::PARAM_STR);
        $query->bindValue(4, $section, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNbJuryByEncadrant($idEnc, $section) {
        $query = $this->db->prepare("SELECT COUNT(no) as total
                                    FROM jury ju
                                    WHERE ju.no IN
                                    (SELECT no
                                    FROM jury j,soutenance s, `section` sec,`calendrier` ca,etudiant et
                                    WHERE (no_pdt=? OR no_ens2=?) 
                                    AND s.no_jury = j.no
                                    AND et.no_etud=s.no_etud
                                    AND sec.no_section=et.no_section
                                    AND ca.no_section=sec.no_section
                                    AND ca.annee_diplome=?
                                    AND ca.no_section=?
                                    AND ca.no_evt=10
                                    AND ca.date BETWEEN ? AND ?
                                    AND ca.date=j.date
                                    group by no)
                                    ");

        $query->bindValue(1, $idEnc, PDO::PARAM_INT);
        $query->bindValue(2, $idEnc, PDO::PARAM_INT);
        $query->bindValue(3, date('Y'), PDO::PARAM_INT);
        $query->bindValue(4, $section, PDO::PARAM_INT);
        $query->bindValue(5, date('Y') . '-01-01', PDO::PARAM_STR);
        $query->bindValue(6, date('Y') . '-12-31', PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getInterventionByEncadrant($idEnc, $section) {
        $query = $this->db->prepare("SELECT j.date, Min(heure) as heure, no 
                                    FROM jury j,soutenance s, `section` sec,`calendrier` ca,etudiant et
                                    WHERE (no_pdt=? OR no_ens2=?) 
                                    AND s.no_jury = j.no
                                    AND et.no_etud=s.no_etud
                                    AND sec.no_section=et.no_section
                                    AND ca.no_section=sec.no_section
                                    AND ca.annee_diplome=?
                                    AND ca.no_section=?
                                    AND ca.no_evt=10
                                    AND ca.date BETWEEN ? AND ?
                                    GROUP BY no ");
        $query->bindValue(1, $idEnc, PDO::PARAM_INT);
        $query->bindValue(2, $idEnc, PDO::PARAM_INT);
        $query->bindValue(3, date('Y'), PDO::PARAM_INT);
        $query->bindValue(4, $section, PDO::PARAM_INT);
        $query->bindValue(5, date('Y') . '-01-01', PDO::PARAM_STR);
        $query->bindValue(6, date('Y') . '-12-31', PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNbSoutenanceByEncadrant($idEnc, $section) {
        $query = $this->db->prepare("SELECT count(*) as total
                                    FROM etudiant etu
                                    WHERE etu.no_etud IN( SELECT et.no_etud 
                                    FROM jury j,soutenance s, `section` sec,`calendrier` ca,etudiant et
                                    WHERE (no_pdt=? OR no_ens2=?) 
                                    AND s.no_jury = j.no
                                    AND et.no_etud=s.no_etud
                                    AND sec.no_section=et.no_section
                                    AND ca.no_section=sec.no_section
                                    AND ca.annee_diplome=?
                                    AND ca.no_section=?
                                    AND ca.no_evt=10
                                    AND ca.date BETWEEN ? AND ?
                                    GROUP BY no,heure)");
        $query->bindValue(1, $idEnc, PDO::PARAM_INT);
        $query->bindValue(2, $idEnc, PDO::PARAM_INT);
        $query->bindValue(3, date('Y'), PDO::PARAM_INT);
        $query->bindValue(4, $section, PDO::PARAM_INT);
        $query->bindValue(5, date('Y') . '-01-01', PDO::PARAM_STR);
        $query->bindValue(6, date('Y') . '-12-31', PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    // maybe good maybe not ...

    public function getOrderNumber($section) {
        $query = $this->db->prepare("SELECT j.no FROM `calendrier` AS c "
                . "JOIN jury AS j ON j.date = c.date "
                . "JOIN soutenance AS s ON s.no_jury = j.no "
                . "JOIN salle AS sa ON sa.no_salle = j.no_salle "
                . "AND c.`no_evt` = ? "
                . "AND c.`no_section` = ? "
                . "AND c.`annee_diplome` = ? "
                . "GROUP BY j.no "
                . "ORDER BY j.date,s.heure,sa.nom_salle");
        $query->bindValue(1, 10, PDO::PARAM_INT);
        $query->bindValue(2, $section, PDO::PARAM_INT);
        $query->bindValue(3, date('Y'), PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateOrderNumber($orderNumber, $id) {
        $query = $this->db->prepare("UPDATE jury SET no_ordre = ? WHERE no = ?");
        $query->bindValue(1, $orderNumber, PDO::PARAM_INT);
        $query->bindValue(2, $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function getJuryByYear() {
        $query = $this->db->prepare("SELECT * FROM `jury` WHERE `date` BETWEEN ? AND ?");
        $query->bindValue(1, date('Y') . '-01-01', PDO::PARAM_STR);
        $query->bindValue(2, date('Y') . '-12-31', PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

        public function getJuryByYearByPromo($noSalle) {
        $query = $this->db->prepare("SELECT * FROM `jury` WHERE `date` BETWEEN ? AND ? and no_salle=?");
        $query->bindValue(1, date('Y') . '-01-01', PDO::PARAM_STR);
        $query->bindValue(2, date('Y') . '-12-31', PDO::PARAM_STR);
        $query->bindValue(3, $noSalle, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function exists($obj) {
        $query = $this->db->prepare("SELECT COUNT(*) AS total, no FROM jury "
                . "WHERE no_pdt = ? "
                . "AND no_ens2 = ?"
                . "AND date = ? "
                . "AND no_salle = ?");
        $query->bindValue(1, $obj->getNoPdt(), PDO::PARAM_INT);
        $query->bindValue(2, $obj->getNoEns(), PDO::PARAM_INT);
        $query->bindValue(3, $obj->getDate(), PDO::PARAM_STR);
        $query->bindValue(4, $obj->getNoSalle(), PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

}


