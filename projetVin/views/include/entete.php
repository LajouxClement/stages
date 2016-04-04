<?php if(empty($_SESSION)){ ?>
<nav class="navbar navbar-default navbarStyle">
    <div class="container-fluid elementStyle">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" id="burgerMenu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" id="barreTop"></span>
                <span class="icon-bar" id="barreMiddle"></span>
                <span class="icon-bar" id="barreBottom"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="collapse navbar-collapse pull-right boiteLien" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav lienStyle">
                <li class=""><a href="#">Accueil</a></li>
                <li><a href="#">Présentation</a></li>
                <li><a href="#">Recherche</a></li>
                <li class="dropdown encadre">
                    <a href="#" class="dropdown-toggle dropdownStyle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Se connecter <span class="caret"></span></a>
                    <div class="dropdown-menu " style="padding:17px;">
                        <div class="alert alert-warning" id="info"><strong>Oops! </strong>L'identifiant ou le mot de passe est incorrect!</div>
                        <center>
                            <h5><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Espace Connexion</h5>
                        </center>
                        <br/>
                        <div class="trait"></div>
                        <br/>
                        <a class="pull-right" href="">Créer un compte</a>
                        <form role="form">
                            <div class="form-group">
                                <label for="email">Adresse Email:</label>
                                <input type="email" class="form-control" id="email" required="true">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Mot de passe:</label>
                                <input type="password" class="form-control" id="pwd" required="true">
                            </div>
                            <center>
                                <button type="submit" class="btn btn-success" id="btnConnexion"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>  Valider</button>
                                <center>
                        </form>
                        <br/>
                        <center>
                            <a href="recuperation.php">Vous avez perdu votre mot de passe?</a>

                        </center>
                    </div>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
}
else{
?>
<nav class="navbar navbar-default navbar-fixed-top navbarStyle navbarAdminStyle">

        <div class="navbar-header navbarHeaderAdmin">
            <a class="navbar-brand pull-left buttonMenu" data-menu="false" id="buttonMenu" href="#">
                <span class="menuText">Menu</span>
                <div class="glyphicon glyphicon glyphicon-menu-hamburger" id="ouvrir"></div>
                <div class="glyphicon glyphicon glyphicon-remove" id="fermer"></div>
            </a>
            <a class="navbar-brand" href="#">Brand</a>
        </div>
      
</nav>
<?php
}
?>