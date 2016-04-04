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
        <div class="form-group">
            <label for="emailrecup">Adresse Email:</label>
            <input type="email" class="form-control" id="emailrecup" required="true">
        </div>
            <button type="button" class="btn btn-success" id="btnRecuperation"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>  Valider</button>

    </form>
</div>
<div id="errjs"></div>

</body>
<script src="javascript/css/style.js"></script>
<script src="javascript/objects/configURL.js"></script>
<script src="javascript/objects/recuperation.js"></script>

</html>
