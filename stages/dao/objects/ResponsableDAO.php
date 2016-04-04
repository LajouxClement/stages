<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResponsableDAO
 *
 * @author Marc
 */
class ResponsableDAO extends AbstractDAORead{

    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function getById($id) {
        $query = $this->prepare("SELECT * FROM responsable WHERE no_resp = ?");
        $query->bindValue(1,$id,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query("SELECT * FROM responsable")->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function login($obj){
        $query = $this->db->prepare('SELECT nom_resp,no_resp,civilite_resp FROM responsable WHERE login_resp = ? AND pass_resp = ?');
        $query->bindValue(1,$obj->getLoginResp(),PDO::PARAM_STR);
        $query->bindValue(2,$obj->getPassResp(),PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function exist($obj){
        $query = $this->db->prepare('SELECT COUNT(*) AS exist FROM responsable WHERE nom_resp = ? AND  login_resp = ? AND pass_resp = ?');
        $query->bindValue(1,$obj->getNomResp(),PDO::PARAM_STR);
        $query->bindValue(2,$obj->getLoginResp(),PDO::PARAM_STR);
        $query->bindValue(3,$obj->getPassResp(),PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

}
