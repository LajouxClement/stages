<?php if (!(empty($_SESSION)) &&$_SESSION['droit'] == 1){?>
<div id="menuAdmin" class="menuAdmin">
    <div class="sousmenuAdmin">
        <center>
            <h4 id="titreMenu"><strong>Espace Administrateur<strong></h4>
        </center>
        
        <center style="padding-top:5px;padding-bottom:5px;">
            <h5><i class="fa fa-tachometer"></i>  Membre: <?php echo $_SESSION['identifiant'];?></h5>
        </center>
        <a class="deconnexion pull-right" href="membre/destructSession.php">se déconnecter</a> 
        <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-desktop"></i>  Accès du site<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#"><i class="fa fa-home"></i>  Accueil</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-book"></i>  Présentation</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-search"></i>  Recherche</a></li>            
        </ul>        
        <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-user"></i>  Gestion du compte<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>            
        </ul>
        
        <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-glass"></i>  Gestion du vin<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#"><i class="fa fa-plus"></i>  Ajouter un vin</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-minus"></i>  Supprimer un vin</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-refresh"></i>  Modifier un vin</a></li>            
        </ul>
        
         <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-file"></i>  Gestion des fiches<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#"><i class="fa fa-plus"></i>  Ajouter une fiche</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-minus"></i>  Supprimer une fiche</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-refresh"></i>  Modifier une fiche</a></li>               
        </ul>
        
         <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-globe"></i>  Gestion de la carte<strong></h5>
        </center>        
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#"><i class="fa fa-map-marker"></i>  Gestion du marqueur</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>            
        </ul>            
    </div>
</div>
<?php }?>

<?php if (!(empty($_SESSION)) &&$_SESSION['droit'] == 2){?>
<div id="menuAdmin" class="menuAdmin">
    <div class="sousmenuAdmin">
        <center>
            <h4 id="titreMenu"><strong>Espace Editeur<strong></h4>
        </center>
        
        <center style="padding-top:5px;padding-bottom:5px;">
            <h5><i class="fa fa-tachometer"></i>  Membre: <?php echo $_SESSION['identifiant'];?></h5>
        </center>
        <a class="deconnexion pull-right" href="membre/destructSession.php">se déconnecter</a> 
        <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-desktop"></i>  Accès du site<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#"><i class="fa fa-home"></i>  Accueil</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-book"></i>  Présentation</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-search"></i>  Recherche</a></li>            
        </ul>        
        <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-user"></i>  Gestion du compte<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#">Profile</a></li>   
        </ul>
        
        <center>
            <h5 class="titreSousMenu"><strong><i class="fa fa-glass"></i>  Gestion du vin<strong></h5>
        </center>
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation"><a href="#"><i class="fa fa-plus"></i>  Ajouter un vin</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-minus"></i>  Supprimer un vin</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-refresh"></i>  Modifier un vin</a></li>            
        </ul>
           
    </div>
</div>
<?php } ?>
