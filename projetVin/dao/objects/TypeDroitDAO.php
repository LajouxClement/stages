<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeDroitDAO
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class TypeDroitDAO extends AbstractDAORead{
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

    
}
