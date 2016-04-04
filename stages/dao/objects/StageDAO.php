<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StageDAO
 *
 * @author Marc
 */
class StageDAO extends AbstractDAORead{
    //put your code here
    private $db;
    
    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function getById($id) {
        $query = $this->prepare("SELECT * FROM stage WHERE no_stage = ?");
        $query->bindValue(1,$id,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query("SELECT * FROM stage")->fetchAll(PDO::FETCH_OBJ);
    }

}
