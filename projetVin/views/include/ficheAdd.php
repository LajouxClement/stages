<?php

session_start();

if ((!(empty($_SESSION)) && $_SESSION['droit'] == 1)||(!(empty($_SESSION)) && $_SESSION['droit'] == 2 && $_SESSION['idUser']==$_POST['idUser'])) {
    ?>

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="javascript/objects/addFiche.js"></script>
    <div class="col-md-4" id="newFiche">
        <div class="btn containerr col-md-12 well fiche">
            <button type="button" class=" jumbotronn  btn-circle btn-xl"><i class="glyphicon glyphicon-plus"></i>
            </button>

        </div>
    </div>
    <?php
}
    ?>