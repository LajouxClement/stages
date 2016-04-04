<?php

/**
 * Created by PhpStorm.
 * User: dusju
 * Date: 20/09/2015
 * Time: 16:25
 */
class Soutenance {

    private $noSout;
    private $noJury;
    private $noEtud;
    private $heure;

    function __construct($noSout, $noJury, $noEtud, $heure) {
        $this->noSout = $noSout;
        $this->noJury = $noJury;
        $this->noEtud = $noEtud;
        $this->heure = $heure;
    }

    public function getNoSout() {
        return $this->noSout;
    }

    public function getNoJury() {
        return $this->noJury;
    }

    public function getNoEtud() {
        return $this->noEtud;
    }

    public function getHeure() {
        return $this->heure;
    }

}
