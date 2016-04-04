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
 * Description of SoutenanceDAO
 *
 * @author Ludo
 */
class SoutenanceDAO extends AbstractDAOReadWrite{
    //put your code here
    
    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function create($obj) {
        $query = $this->db->prepare('INSERT INTO soutenance (no_sout, no_jury, no_etud, heure) VALUES (?,?,?,?)');
        $query->bindValue(1, $obj->getNoSout(), PDO::PARAM_INT);
        $query->bindValue(2, $obj->getNoJury(), PDO::PARAM_INT);
        $query->bindValue(3, $obj->getNoEtud(), PDO::PARAM_INT);
        $query->bindValue(4, $obj->getHeure(), PDO::PARAM_STR);
        $query->execute();
    }

    public function delete($obj) {
        $query = $this->db->prepare('DELETE FROM soutenance WHERE no_jury = ?');
        $query->bindValue(1, $obj->getNoJury(), PDO::PARAM_INT);
        $query->execute();
    }

    public function getById($id) {
        $query = $this->prepare("SELECT * FROM soutenance WHERE no_sout = ?");
        $query->bindValue(1,$id,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query("SELECT * FROM soutenance")->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($obj) {
        $query = $this->db->prepare('UPDATE soutenance SET no_jury = ?, no_etud = ?, heure = ? WHERE no_sout = ?');
        $query->bindValue(1, $obj->getNoJury(), PDO::PARAM_INT);
        $query->bindValue(2, $obj->getNoEtud(), PDO::PARAM_INT);
        $query->bindValue(3, $obj->getHeure(), PDO::PARAM_STR);
        $query->bindValue(4, $obj->getNoSout(), PDO::PARAM_INT);
        $query->execute();
    }

    
        public function deleteByNoJury($noJury) {
        $query = $this->db->prepare('DELETE FROM soutenance WHERE no_jury = ?');
        $query->bindValue(1, $noJury, PDO::PARAM_INT);
        $query->execute();
    }
    
        public function getMaxHourJury($idJury){
        $query = $this->db->prepare("SELECT MAX(heure) as heure FROM `soutenance` WHERE `no_jury`=?");
        $query->bindValue(1, $idJury, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
        public function getMinHourJury($idJury){
        $query = $this->db->prepare("SELECT MIN(heure) as heure FROM `soutenance` WHERE `no_jury`=?");
        $query->bindValue(1, $idJury, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
