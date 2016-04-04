/**
 * Created by Clément on 14/03/2016.
 */
$(document).ready(function () {
    //127.0.0.1:8080/edsa-Projet%20vin/site/

    $("#newFiche").click(function () {
        compteur = 0;
        $.ajax({
            method: "POST",
            url: link + "parse.php?page=addFiche",
            dataType: 'json',
            success: function (data) {

                $.each(data, function (key, value) {
                    //alert(value.identifiant);
                    compteur++;
                    $("#newFiche").remove();
                    $("#fiche").append($("<div id='ficheVin'>").load("views/include/fiche.php", { // N'oubliez pas l'ouverture des accolades !
                        nomVin: value.nomVin,
                        nomCepage: value.nomCepage,
                        noteTesteur: value.noteTesteur,
                        couleur: value.couleur,
                        urlImage: value.urlImage,
                        idUser: value.idUser,
                        anneeVin: value.anneeVin,
                        latitude: value.latitude,
                        longitude: value.longitude,
                        compteurLigne: compteur,
                        id: value.id
                    }));

                    if (compteur >= 3) {
                        compteur = 0;
                    }


                });

                $("#fiche").append($("<div id='ficheAdd'>").load("views/include/ficheAdd.php"));

            },
            error: function () {
                $("#fiche").append("erreur chargement");
            }
        });
        $('html, body').animate({
            scrollTop: $(document).height()
        }, 3250);
    });
});