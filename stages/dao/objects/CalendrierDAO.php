<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalendrierDAO
 *
 * @author Guillaume
 */
class CalendrierDAO extends AbstractDAORead{

    //put your code here
    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function getById($id) {
        
    }

    public function request() {
        return $this->db->query("SELECT * FROM calendrier")->fetchAll(PDO::FETCH_OBJ);
    }

    public function getJourByNoSection($noSect) {
        $query = $this->db->prepare("SELECT date FROM calendrier WHERE no_evt=? AND no_section=?  AND annee_diplome=? ORDER BY date");
        //10 est le no_evt pour une soutenance de stage
        $query->bindValue(1, 10, PDO::PARAM_INT);
        $query->bindValue(2, $noSect, PDO::PARAM_INT);
        $query->bindValue(3, date("Y"), PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
