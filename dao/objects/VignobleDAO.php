<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VignobleDAO
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class VignobleDAO extends AbstractDAOReadWrite{
        private $db;
    
    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }    
    
    public function create($obj) {
        
    }

    public function delete($obj) {
        
    }

    public function getById($id) {
        
    }

    public function request() {
        
    }

    public function update($obj) {
        
    }

//put your code here
}
