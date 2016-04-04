<?php

/**
 * Created by PhpStorm.
 * User: dusju
 * Date: 20/09/2015
 * Time: 16:29
 */
class Salle {

    private $noSalle;
    private $nomSalle;
    private $utilisee;

    public function __construct($noSalle, $nomSalle, $utilisee) {
        $this->noSalle = $noSalle;
        $this->nomSalle = $nomSalle;
        $this->utilisee = $utilisee;
    }

    public function getNoSalle() {
        return $this->noSalle;
    }

    public function getNomSalle() {
        return $this->nomSalle;
    }

    public function getUtilisee() {
        return $this->utilisee;
    }

}
