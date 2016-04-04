<?php
session_start();
include ("../../model/vin.php");

$fiche = new vin($_POST['id'],$_POST['idUser'],1,$_POST['nomVin'],$_POST['nomCepage'],$_POST['noteTesteur'],$_POST['couleur'],$_POST['urlImage'],$_POST['anneeVin'],$_POST['latitude'],$_POST['longitude']);


?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
    
<?php
//print_r($_POST['compteur']);
if($_POST['compteurLigne']==3)
{
    echo "<div class='row'>";
}

?>


<div class="col-md-<?php if (!isset($_POST['fiche'])){?>4"
    onclick="setMapPosition(<?php echo "{$fiche->getLatitude()}"; ?>,<?php echo "{$fiche->getLongitude()}"; ?>,'<?php echo "{$fiche}"; ?>')"
<?php }else{
    echo $_POST['fiche'];
}; ?>>
    <div class="col-md-12 well fiche">
        <button type="button" class="btn btn-default" id="btnZoomFiche<?php echo "{$_POST['id']}"; ?>"
                aria-label="Left Align" data-toggle="modal" data-target="#modalZoom<?php echo "{$_POST['id']}"; ?>">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        </button>
        <?php
        if ((!(empty($_SESSION)) && $_SESSION['droit'] == 1) || (!(empty($_SESSION)) && $_SESSION['droit'] == 2 && $_SESSION['idUser'] == $_POST['idUser'])) {
            ?>
            <button type="button" class="btn btn-default" id="btnDeleteFiche<?php echo "{$_POST['id']}"; ?>"
                    aria-label="Left Align" data-toggle="modal"
                    data-target="#modalDelete<?php echo "{$_POST['id']}"; ?>">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-default" id="btnModifFiche<?php echo "{$_POST['id']}"; ?>"
                    aria-label="Left Align" data-toggle="collapse"
                    data-target="#Edition<?php echo "{$_POST['id']}"; ?>,#formEdition<?php echo "{$_POST['id']}"; ?>">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
        }
        ?>
        <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
        <?php
        if ((!(empty($_SESSION)) && $_SESSION['droit'] == 1) || (!(empty($_SESSION)) && $_SESSION['droit'] == 2 && $_SESSION['idUser'] == $_POST['idUser'])) {
            ?>
            <form role="form" class="collapse formEdition<?php echo "{$_POST['id']}"; ?>"
                  id="formEdition<?php echo "{$_POST['id']}"; ?>">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur<?php echo "{$_POST['id']}"; ?>" name="editeur"
                              rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading
                            <small class="col-md-12">Secondary text</small>
                        </h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                             ac turpis
                             egestas.
                             Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu
                             libero
                             sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                         </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
            <?php
        }
        ?>
        <div class="col-md-12 fiche-text in" id="Edition<?php echo "{$_POST['id']}"; ?>">
            <h3 class="col-md-12"><?php echo " {$_POST['nomVin']}"; ?>
                <small class="col-md-12">Secondary text</small>
            </h3>


            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>

        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3"><?php echo " {$_POST['couleur']}"; ?></div>
            <div class="col-md-3 fiche-espace"><?php echo substr($_POST['nomCepage'], 0, 5) . '...'; ?></div>
            <div class="col-md-3 fiche-espace"><?php echo " {$_POST['anneeVin']}"; ?></div>
            <div class="col-md-3"><?php echo " {$_POST['noteTesteur']}"; ?></div>
        </div>
    </div>
</div>

    <div class="modal fade" id="modalZoom<?php echo "{$_POST['id']}"; ?>" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="col-md-12"><?php echo " {$_POST['nomVin']}"; ?>
                                <small class="col-md-12">Secondary text</small>
                            </h3>
                            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada
                                fames ac turpis
                                egestas.
                                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu
                                libero
                                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend
                                leo.
                            </p>
                            <h3 class="col-md-12">Noter le vin</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control input-sm modalMarginLeft">
                                        <option></option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="row ">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-danger modalMarginLeft" data-dismiss="modal">
                                        Noter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="row">
                                <div class="thumbnail imgModal">
                                    <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
                                    <div class="caption">
                                        <h3>Informations diverses:</h3>
                                        <p class="text-primary">Couleur: <?php echo " {$_POST['couleur']}"; ?></p>
                                        <p class="text-primary">Cépage: <?php echo " {$_POST['nomCepage']}"; ?></p>
                                        <p class="text-primary">Année: <?php echo " {$_POST['anneeVin']}"; ?></p>
                                        <p class="text-primary">Moyenne
                                            Internautes: <?php echo " {$_POST['noteTesteur']}"; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalDelete<?php echo "{$_POST['id']}"; ?>" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Suppression du Vin</h4>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous supprimer le vin <?php echo " {$_POST['nomVin']}"; ?>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="deleteFiche<?php echo "{$_POST['id']}"; ?>"
                            onclick="deleteFiche(<?php echo "{$_POST['id']}"; ?>)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>


    <?php
    if ($_POST['compteurLigne'] == 3) {
        echo "</div>";
    }


?>