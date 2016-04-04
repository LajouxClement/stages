<div class="row">
<div class="col-md-4 ">
    <div class="col-md-12 well fiche">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <button type="button" class="btn btn-default" id="btnModifFiche1" aria-label="Left Align">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
                }
            ?>
            <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <form role="form" class="formEdition1">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage1">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur1" name="editeur" rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
             <?php
                }
            ?>
        <div class="ficheVin1">
        <div class="col-md-12 fiche-text">
            <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
        

            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>
        </div>
        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3">Rouge</div>
            <div class="col-md-3 fiche-espace">Merlot</div>
            <div class="col-md-3 fiche-espace">2015</div>
            <div class="col-md-3">Note</div>
        </div>
    </div>
</div>

<div class="col-md-4 ">
    <div class="col-md-12 well fiche">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <button type="button" class="btn btn-default" id="btnModifFiche2" aria-label="Left Align">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
                }
            ?>
            <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <form role="form" class="formEdition2">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage2">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur2" name="editeur" rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
             <?php
                }
            ?>
        <div class="ficheVin2">
        <div class="col-md-12 fiche-text">
            <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
        

            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>
        </div>
        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3">Rouge</div>
            <div class="col-md-3 fiche-espace">Merlot</div>
            <div class="col-md-3 fiche-espace">2015</div>
            <div class="col-md-3">Note</div>
        </div>
    </div>
</div>


<div class="col-md-4 ">
    <div class="col-md-12 well fiche">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <button type="button" class="btn btn-default" id="btnModifFiche3" aria-label="Left Align">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
                }
            ?>
            <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <form role="form" class="formEdition3">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage3">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur3" name="editeur" rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
             <?php
                }
            ?>
        <div class="ficheVin3">
        <div class="col-md-12 fiche-text">
            <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
        

            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>
        </div>
        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3">Rouge</div>
            <div class="col-md-3 fiche-espace">Merlot</div>
            <div class="col-md-3 fiche-espace">2015</div>
            <div class="col-md-3">Note</div>
        </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-md-4 ">
    <div class="col-md-12 well fiche">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <button type="button" class="btn btn-default" id="btnModifFiche4" aria-label="Left Align">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
                }
            ?>
            <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <form role="form" class="formEdition4">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage4">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur4" name="editeur" rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
             <?php
                }
            ?>
        <div class="ficheVin4">
        <div class="col-md-12 fiche-text">
            <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
        

            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>
        </div>
        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3">Rouge</div>
            <div class="col-md-3 fiche-espace">Merlot</div>
            <div class="col-md-3 fiche-espace">2015</div>
            <div class="col-md-3">Note</div>
        </div>
    </div>
</div>

<div class="col-md-4 ">
    <div class="col-md-12 well fiche">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <button type="button" class="btn btn-default" id="btnModifFiche5" aria-label="Left Align">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
                }
            ?>
            <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <form role="form" class="formEdition5">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage5">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur5" name="editeur" rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
             <?php
                }
            ?>
        <div class="ficheVin5">
        <div class="col-md-12 fiche-text">
            <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
        

            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>
        </div>
        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3">Rouge</div>
            <div class="col-md-3 fiche-espace">Merlot</div>
            <div class="col-md-3 fiche-espace">2015</div>
            <div class="col-md-3">Note</div>
        </div>
    </div>
</div>


<div class="col-md-4 ">
    <div class="col-md-12 well fiche">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <button type="button" class="btn btn-default" id="btnModifFiche6" aria-label="Left Align">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <?php
                }
            ?>
            <img src="css/img/vin-01.jpg" class="img-responsive" alt="Responsive image">
            <?php
                if(!(empty($_SESSION))&&$_SESSION['droit']==1)
                {
            ?>
            <form role="form" class="formEdition6">
                <div class="form-group">
                    <span class="btn btn-success fileinput-button btnEditionImage6">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Choisir une image</span>
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <br/>
                    <br/>
                    <label for="comment">Edition description:</label>
                    <textarea cols="80" class="ckeditor" id="editeur3" name="editeur" rows="10">
                        <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
                         <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                            egestas.
                            Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                            sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success" aria-label="Left Align">Valider</button>
            </form>
             <?php
                }
            ?>
        <div class="ficheVin6">
        <div class="col-md-12 fiche-text">
            <h3 class="col-md-12">h3. Bootstrap heading <small class="col-md-12">Secondary text</small></h3>
        

            <p class="col-md-12">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.
                Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero
                sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

        </div>
        </div>
        <div class="col-md-12 text-center fiche-attribut">
            <div class="col-md-3">Rouge</div>
            <div class="col-md-3 fiche-espace">Merlot</div>
            <div class="col-md-3 fiche-espace">2015</div>
            <div class="col-md-3">Note</div>
        </div>
    </div>
</div>
</div>