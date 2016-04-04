/**
 * Created by Clément on 14/03/2016.
 */
$(document).ready(function () {
    //127.0.0.1:8080/edsa-Projet%20vin/site/
    compteur = 0;
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=fiche",
        dataType: 'json',
        success: function (data) {

            $.each(data, function (key, value) {
                //alert(value.identifiant);
                compteur++;

                if (value.nomVin != "null") {
                    $("#fiche").append($("<div id='ficheVin'>").load("views/include/fiche.php", { // N'oubliez pas l'ouverture des accolades !
                        nomVin: value.nomVin,
                        nomCepage: value.nomCepage,
                        noteTesteur: value.noteTesteur,
                        couleur: value.couleur,
                        urlImage: value.urlImage,
                        anneeVin: value.anneeVin,
                        idUser: value.idUser,
                        compteurLigne: compteur,
                        latitude: value.latitude,
                        longitude: value.longitude,
                        id: value.id
                    }));
                }
                else {
                    $("#fiche").append("erreur chargement");
                }

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


});


// effacer la fiche
function deleteFiche(id) {
    modal = "#modalDelete" + id;
    $(modal).modal('hide');
    $('body').removeClass('modal-open');
    $('body').css("padding-right", "0px");
    $('.modal-backdrop').remove();
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=deleteFiche",
        data: "id=" + id,
        dataType: 'json',
        success: function (data) {
            if (data[0].delete == 1) {
                window.location.reload(link + "redirection.php");
            }


        },
        error: function () {
            alert("erreur AjAx");
            //$("#fiche").append("erreur chargement");
        }
    });
}

function setMapPosition(latitude, longitude, fiche) {

    var res = fiche.split("&");
    var url =  // N'oubliez pas l'ouverture des accolades !
        "id="+ res[0]+
        "&idUser="+res[1]+
        "&nomVin="+res[3]+
        "&nomCepage="+res[4]+
        "&noteTesteur="+res[5]+
        "&couleur="+res[6]+
        "&urlImage="+res[7]+
        "&anneeVin="+res[8]+
        "&latitude="+res[9]+
        "&longitude="+res[10]+
        "&fiche="+12+
        "&compteurLigne="+0;


    var template = "";
    $.ajax({
        url: "views/include/fiche.php",
        type: 'post',
        data: url,
        async: false,
        success: function (html) {
            console.log(html); // here you'll store the html in a string if you want

            template = html;
        }
    });

    console.log(template);
    $("html, body").animate({scrollTop: 0}, 500);
    map.removeMarkers();
    map.setZoom(10);
    map.addMarker({
        lat: latitude,
        lng: longitude,
        title: 'Metz',
        infoWindow: {
            content: template
        },
        click: function (e) {
            map.setCenter({
                lat: latitude,
                lng: longitude
            });
        }
    });
    map.setCenter({
        lat: latitude,
        lng: longitude
    });
}

