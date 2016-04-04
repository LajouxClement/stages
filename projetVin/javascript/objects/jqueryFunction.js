/**
 * Created by Clément on 28/01/2016.
 */

/*$(".btn").click(function () {
    var idJury = $("#vignobleSaisie").val();
    $.ajax({
        // chargement du fichier externe monfichier-ajax.php
        url: "php/requette.php",
        type: "GET",
        // Passage des données au fichier externe (ici le nom cliqué)
        data: "villeNom=" + idJury,
        cache: true,
        dataType: "json",
        error: function (request, error) { // Info Debuggage si erreur
            alert("Erreur : responseText: " + request.responseText);
        },
        success: function (data) {
            // Informe l'utilisateur que l'opération est terminé et renvoie le résultat
            $.each(data, function (key, value) {

                if (key == 0) {
                    map.removeMarkers();
                    $("#prenom_eleve").html(value.ville_nom + " long:" + value.ville_longitude_deg + " lat:" + value.ville_latitude_deg);

                    var lat = parseFloat(value.ville_latitude_deg);
                    var long = parseFloat(value.ville_longitude_deg);
                    map.setCenter({
                        
                        lat: lat,
                        lng: long
                    });

                    map.addMarker({
                        lat: lat,
                        lng: long,
                        title: value.ville_nom,
                        infoWindow: {
                            content: '<p>' + value.ville_nom + '</p>'
                        },
                        click: function (e) {
                            map.setCenter({
                                lat: lat,
                                lng: long
                            });
                        }
                    });
                    map.setZoom(13);
                }
            });


        }
    });
});*/

$("#vignobleSaisie").keyup(function () {
    var idJury = $("#vignobleSaisie").val();
    $.ajax({
        // chargement du fichier externe monfichier-ajax.php
        url: "php/requette.php",
        type: "GET",
        // Passage des données au fichier externe (ici le nom cliqué)
        data: "villeNom=" + idJury,
        cache: true,
        dataType: "json",
        error: function (request, error) { // Info Debuggage si erreur
            alert("Erreur : responseText: " + request.responseText);
        },
        success: function (data) {
            var availableTags = [];
            // Informe l'utilisateur que l'opération est terminé et renvoie le résultat
            $.each(data, function (key, value) {
                //alert(value.ville_nom);
                availableTags.push(value.ville_nom);
                $("#vignobleSaisie").autocomplete({
                    source: availableTags
                });
            });
        }
    });
});