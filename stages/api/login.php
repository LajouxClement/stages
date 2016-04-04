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

$responsableDAO = new ResponsableDAO();

/** Check if local storage exists **/
if(isset($_POST['userLogin'],$_POST['passLogin']) && !empty($_POST['userLogin']) && !empty($_POST['passLogin'])){
    $user = trim($_POST['userLogin']);
    $pass = trim($_POST['passLogin']);
    $exist = $responsableDAO->login(new Responsable('', '', '', '', $user, $pass));
    if(!empty($exist->nom_resp)){
        //session + ajax
        $_SESSION['responsable'] = secure($exist->nom_resp);
        exit(json_encode(array("responsable" => $exist->nom_resp, "login" => $user, "pass" => $pass, "identifiant" => $exist->no_resp, "civilite" => $exist->civilite_resp)));
        
    }
}

/** Login **/
if(isset($_POST['loginStore'],$_POST['login'],$_POST['pass']) && !empty($_POST['loginStore']) && !empty($_POST['login']) && !empty($_POST['pass'])){
    $nameResp = $_POST['loginStore'];
    $loginResp = $_POST['login'];
    $passResp = $_POST['pass'];
    
    $check = $responsableDAO->exist(new Responsable('', $nameResp, "", "", $loginResp, $passResp));
    if((int) $check->exist > 0){
        $_SESSION['responsable'] = $nameResp;
        exit(json_encode(array("loginOk" => "ok")));
    }

}