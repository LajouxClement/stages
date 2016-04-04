<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jury
 *
 * @author Clément
 */
class Jury {

    //put your code here
    private $no;
    private $noOrdre;
    private $noPdt;
    private $noEns;
    private $noExpcom;
    private $noSalle;
    private $date;
    
    function __construct($no, $noOrdre, $noPdt, $noEns, $noExpcom, $noSalle, $date) {
        $this->no = $no;
        $this->noOrdre = $noOrdre;
        $this->noPdt = $noPdt;
        $this->noEns = $noEns;
        $this->noExpcom = $noExpcom;
        $this->noSalle = $noSalle;
        $this->date = $date;
    }
    
    function getNo() {
        return $this->no;
    }

    function getNoOrdre() {
        return $this->noOrdre;
    }

    function getNoPdt() {
        return $this->noPdt;
    }

    function getNoEns() {
        return $this->noEns;
    }

    function getNoExpcom() {
        return $this->noExpcom;
    }

    function getNoSalle() {
        return $this->noSalle;
    }

    function getDate() {
        return $this->date;
    }



}
