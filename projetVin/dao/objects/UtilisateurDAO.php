<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilisateurDAO
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class UtilisateurDAO extends AbstractDAOReadWrite{
    //put your code here
        private $db;
    
    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }    
    public function getById($id) {
        
    }

    public function request() {
        
    }

    public function create($obj) {
        
    }

    public function delete($obj) {
        
    }

    public function update($obj){
        $query = $this->db->prepare("UPDATE `utilisateur` SET mdp_user=? WHERE id_user=?");
        $query->bindValue(1, $obj->getMdpUser());
        $query->bindValue(2, $obj->getIdUser());
        $query->execute();
        return $query->errorCode();
    }
    
    public function getByNameAndPassword($obj){
        $query = $this->db->prepare("SELECT * FROM `utilisateur` WHERE `mail_user`= ? AND `mdp_user`=?");
        $query->bindValue(1, $obj->getMailUser() , PDO::PARAM_STR);
        $query->bindValue(2, $obj->getMdpUser(), PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getCodeRecup($id){
        $query = $this->db->prepare("SELECT code_recup_user FROM `utilisateur` WHERE `id_user`= ?");
        $query->bindParam(1,$id);
        $query->execute();
        $tab = $query->fetch();
        return $tab['code_recup_user'];
    }

    public function getByMail($obj){
        $query = $this->db->prepare("SELECT * FROM `utilisateur` WHERE `mail_user`= ?");
        $query->bindValue(1, $obj->getMailUser() , PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
