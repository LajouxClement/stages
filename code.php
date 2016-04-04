<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 22/03/2016
 * Time: 14:51
 */

include_once(__DIR__ . '/dao/connection/AbstractDAORead.php');
include_once(__DIR__ . '/dao/connection/AbstractDAOReadWrite.php');
include_once(__DIR__ . '/dao/connection/Connection.php');
include_once(__DIR__ . '/include/configBDD.php');
include_once(__DIR__ . '/include/autoload.php');
if(isset($_GET['u']) && isset($_GET['cd'])){

    $dao = new UtilisateurDAO();
    $code = $dao->getCodeRecup($_GET['u']);
    if(!($_GET['cd'] == $code)){
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}

?>
<html>
<head>
    <title>Recuperation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="javascript/lib/gmaps.js"></script>
    <script src="javascript/lib/jquery.min.js"></script>
    <script src="javascript/lib/jquery.md5.min.js"></script>
    <script src="javascript/lib/jquery-ui-touch.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bodyStyle.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

</head>
<body id="main">
<?php session_start()?>
<?php include("views/include/entete.php"); ?>
<div class = "container">
    <form role="form" action="">
        <span id="identification" hidden><?php echo $_GET['u'];?></span>
        <div class="form-group" id="form_mdp">

            <div class="row">
                <label class="col-sm-offset-2" >Nouveau mot-de-passe:</label>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label" for="newpwd"></label>
              <div class="col-sm-10">
                  <input type="password" class="form-control" id="newpwd" required="true">
              </div>
            </div>

            <div class="row">
                <label class="col-sm-offset-2" >Confirmation nouveau mot-de-passe:</label>
            </div>

            <div class="row">
                <label class="col-sm-2 control-label" for="newpwd_verif" id="newpwd_verif_label"></label>
                <div class="col-sm-10">
                    <input type="password" class="col-sm-10 form-control" id="newpwd_verif" required="true">
                </div>
            </div>




           <!-- <div class="form-group has-error has-feedback">
                <label class="col-sm-2 control-label" for="inputError">Input with error and glyphicon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputError">
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                </div>
            </div>-->

        </div>
        <button type="button" class="btn btn-success" id="btnNewPwd"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>  Valider</button>

    </form>
</div>
<div id="errjs"></div>

</body>
<script src="javascript/css/style.js"></script>
<script src="javascript/objects/configURL.js"></script>
<script src="javascript/objects/code.js"></script>


