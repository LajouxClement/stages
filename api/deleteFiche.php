<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$vinDao = new vinDAO();
$arr = array();


if(isset($_POST['id']) && is_numeric($_POST['id'])){
    
    $vin = new vin(htmlspecialchars($_POST['id']), null, null, " ", " ", " ", " ", " ", " ", " ", " ");
    $rowDelete =$vinDao->delete($vin);
    array_push($arr, array("delete" => $rowDelete));
    exit(json_encode($arr));
}