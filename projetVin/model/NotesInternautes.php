<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotesInternautes
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class NotesInternautes {
    //put your code here
    private $idNote;
    private $idVin;
    private $note;
    
    function __construct($idNote, $idVin, $note) {
        $this->idNote = $idNote;
        $this->idVin = $idVin;
        $this->note = $note;
    }

    function getIdNote() {
        return $this->idNote;
    }

    function getIdVin() {
        return $this->idVin;
    }

    function getNote() {
        return $this->note;
    }

    function setIdNote($idNote) {
        $this->idNote = $idNote;
    }

    function setIdVin($idVin) {
        $this->idVin = $idVin;
    }

    function setNote($note) {
        $this->note = $note;
    }


}
