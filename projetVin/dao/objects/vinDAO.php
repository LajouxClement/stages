<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vinDAO
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class vinDAO extends AbstractDAOReadWrite
{

    private $db;

    public function __construct()
    {
        $co = new Connection();
        $this->db = $co->getConnection();
    }

    public function create($obj)
    {

        $arg1 = $obj->getIdUser();
        $arg2 = $obj->getIdVignoble();
        $arg3 = $obj->getNomVin();
        $arg4 = $obj->getNomCepage();
        $arg5 = $obj->getNoteTesteur();
        $arg6 = $obj->getCouleur();
        $arg7 = $obj->getUrlImage();
        $arg8 = $obj->getAnneeImage();
        $arg9 = $obj->getLatitude();
        $arg10 = $obj->getLongitude();


        $query = $this->db->prepare("INSERT INTO vin (id_user, id_vignoble, nom_vin,nom_cepage,note_testeur,couleur,url_img,annee_vin,latitude,longitude)
                                      VALUES (?,?,?,?,?,?,?,?,?,?)");
        $query->bindParam(1, $arg1);
        $query->bindParam(2, $arg2);
        $query->bindParam(3, $arg3);
        $query->bindParam(4, $arg4);
        $query->bindParam(5, $arg5);
        $query->bindParam(6, $arg6);
        $query->bindParam(7, $arg7);
        $query->bindParam(8, $arg8);
        $query->bindParam(9, $arg9);
        $query->bindParam(10, $arg10);


        $query->execute();


    }

    public function delete($obj)
    {
        try {
            $arg0=$obj->getIdVin();
            $query = $this->db->prepare("DELETE FROM `vin` WHERE id_vin=?");
            $query->bindParam(1, $arg0, PDO::PARAM_INT);
            $query->execute();
            return 1;
        } catch (PDOException $Exception) {
            return 0;
        }
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM vin WHERE id_vin =  ?");
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);

    }

    public function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM vin");
        $query->execute();
        return $query->fetchAll();
    }

    public function request()
    {

    }

    public function update($obj)
    {

    }

    public function getLastAdded()
    {
        $query = $this->db->prepare("SELECT * FROM vin ORDER BY id_vin DESC LIMIT 1");
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);

    }

//put your code here
}
