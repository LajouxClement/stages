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
 * Description of SectionDAO
 *
 * @author Ludo
 */
class SectionDAO extends AbstractDAORead {

    //put your code here

    private $db;

    public function __construct() {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function getById($id) {
        $query = $this->db->prepare("SELECT no_section,libelle_section,libelle_section_long,duree_soutenance,no_resp FROM section WHERE no_section = ?");
        $query->bindValue(1,$id,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function request() {
        return $this->db->query("SELECT * FROM section")->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getSectionByResponsable($id){
        
        $query = $this->db->prepare('SELECT libelle_section,libelle_section_long,s.no_section FROM section AS s '
                . 'LEFT JOIN responsable AS r ON s.no_resp = r.no_resp '
                . 'LEFT JOIN calendrier AS c ON c.no_section = s.no_section '
                . 'WHERE r.no_resp = ? '
                . 'AND no_evt = ? '
                . 'GROUP BY(c.no_section)'
                . 'ORDER BY c.no_section');
        $query->bindValue(1,$id,PDO::PARAM_INT);
        $query->bindValue(2,10,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    public function getNumSection($array){
        $res = "";
        //var_dump($array);
        foreach($array as $data){
            $res .= "c.no_section = ".$data['noSection']." OR ";
        }
        $query = $this->db->prepare("SELECT MIN(date) AS minDate, c.no_section AS noSec,libelle_section "
                . "FROM calendrier AS c "
                . "LEFT JOIN section AS s ON s.no_section = c.no_section "
                . "WHERE no_evt = ? "
                . "AND annee_diplome = ? "
                . "AND (".substr($res,0,-3).") "
                . "AND date >= ?");
        $query->bindValue(1,10,PDO::PARAM_INT);
        $query->bindValue(2, date('Y'), PDO::PARAM_STR);
        $query->bindValue(3, date('Y-m-d', time()), PDO::PARAM_STR);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
        
    }
    
    public function getNumSuiviByNoSection($noSection){
         $query = $this->db->prepare("SELECT `suivi` 
             FROM `section` 
             WHERE `no_section`= ?");
        $query->bindValue(1,$noSection,PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    
    

}
