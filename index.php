<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>TODO supply a title</title>
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

</head>
<body id="main">
<?php session_start()?>
<?php include("views/include/sidebar.php"); ?>
<?php include("views/include/entete.php"); ?>
<?php include("views/include/body.php"); ?>

<div class="zone-fiche">

        <div class="container "id="fiche">
        </div>

</div>
</body>
<script src="javascript/css/style.js"></script>
<script src="javascript/objects/configURL.js"></script>
<script src="javascript/objects/connexion.js"></script>
<script src="javascript/objects/fiche.js"></script>
<script src="javascript/objects/jqueryFunction.js"></script>
<script src="javascript/objects/gmapsFunction.js"></script>
</html>
