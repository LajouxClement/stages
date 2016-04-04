<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendrier
 *
 * @author Guillaume
 */
class Calendrier {
    //put your code here
    private $noSection;
    private $anneeDiplome;
    private $noEvt;
    private $date;
    private $noOrdre;
    
    function __construct($noSection, $anneeDiplome, $noEvt, $date, $noOrdre) {
        $this->noSection = $noSection;
        $this->anneeDiplome = $anneeDiplome;
        $this->noEvt = $noEvt;
        $this->date = $date;
        $this->noOrdre = $noOrdre;
    }

    function getNoSection() {
        return $this->noSection;
    }

    function getAnneeDiplome() {
        return $this->anneeDiplome;
    }

    function getNoEvt() {
        return $this->noEvt;
    }

    function getDate() {
        return $this->date;
    }

    function getNoOrdre() {
        return $this->noOrdre;
    }
    
    function parseDate(){
        $explode = explode('-', $this->date);
        //split date format Y-m-d ex: 2010-05-20
        return strftime("%A %d/%m", mktime(0, 0, 0, $explode[1], $explode[2], $explode[0]));
    }


}
