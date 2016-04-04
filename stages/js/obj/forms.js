/* 
 * The MIT License
 *
 * Copyright 2015 Ludovic Sanctorum <ludovic.sanctorum@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


/* global link, arraySection, Console, tabEtudiants, debug, arrIdStudent */


$(document).ready(function () {

    $('#clearLocal').on('click', function () {
        localStorage.removeItem("nomResp");
        localStorage.removeItem("civilite");
        localStorage.removeItem("login");
        localStorage.removeItem("pass");
        localStorage.removeItem("noResp");
        localStorage.removeItem("libSection");
        localStorage.removeItem("numSection");
        location.replace("index.html");
    });

    //queries for responsable
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=encadrant",
        data: {
            getAllEncadrant: "true"
        },
        dataType: 'json', // JSON
        beforeSend: function () {
            if (debug) {
                $('#loadEncadrant').append('<div class="alert alert-info">Chargement des encadrants <img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie" /></div>');
            }
        }
    }).done(function (data) {
        $.each(data, function (key, val) {
            if (val.inactif === 0) {
                if (val.expCom === 1) {
                    $('#expCom').append('<option value="' + val.noEnc + '">' + val.nomEnc + ' ' + val.prenomEnc + '</option>');
                } else {
                    $('#president').append('<option value="' + val.noEnc + '">' + val.nomEnc + ' ' + val.prenomEnc + '</option>');
                    $('#enseignant').append('<option value="' + val.noEnc + '">' + val.nomEnc + ' ' + val.prenomEnc + '</option>');
                }
            }
        });

        if (debug) {
            $('#loadEncadrant').empty();
            $('#loadEncadrant').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong> Encadrants chargés</div>');
        }
    }).fail(function () {
        if (debug) {
            $('#loadEncadrant').empty();
            $('#loadEncadrant').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"></span></strong> Une erreur est survenue lors du chargement des encadrants</div>');
        }
    });

    //query for salles
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=salle",
        data: {
            getAllSalle: "true"
        },
        dataType: 'json', //JSON
        beforeSend: function () {
            if (debug) {
                $('#loadSalle').append('<div class="alert alert-info">Chargement des salles <img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie" /></div>');
            }
        }
    }).done(function (data) {
        $.each(data, function (key, val) {
            $('#salle').append('<option value="' + val.noSalle + '">' + val.nomSalle + '</option>');
            $('#button-salle').append('<button class="btn btn-success" style="margin: 10px;" id="' + val.noSalle + '">' + val.nomSalle + '</button>');

        });
        $('#button-salle').append('<button class="btn btn-success" id="-1">Avancement</button>');
        if (debug) {
            $('#loadSalle').empty();
            $('#loadSalle').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong> Salles chargées</div>');
        }


    }).fail(function () {
        if (debug) {
            $('#loadSalle').empty();
            $('#loadSalle').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"> Une erreur est survenue lors du chargement des encadrants</div>');
        }
    });

    //query for select day
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=jour",
        data: {
            requete: "getAllJour",
            noSection: localStorage.getItem("numSection")
        },
        dataType: 'json',
        beforeSend: function () {
            if (debug) {
                $('#loadJour').append('<div class="alert alert-info">Chargement des jours <img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie" /></div>');
            }
        }
    }).done(function (data) {
        $.each(data, function (key, val) {
            $('#selectJour').append('<option value="' + val.date + '">' + val.dateParse + '</option>');
        });
        if (debug) {
            $('#loadJour').empty();
            $('#loadJour').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong> Jours chargés</div>');
        }
    }).fail(function () {
        if (debug) {
            $('#loadJour').empty();
            $('#loadJour').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"> Une erreur est survenue lors du chargement des jours</div>');
        }
    });

    //récupère les étudiants à afficher dans "étudiants à placer" et "étudiants déja placés"
    $('#president').on('change', function () {
        if ($(this).val() !== "") {
            getEtudiantAPlacer();
            if ($('#enseignant').val() !== "" && $('#selectJour').val() !== "" && $('#salle').val() !== "") {
                getEtudiantDejaPlacer();
            }
        }
    });

    $('#enseignant').on('change', function () {
        if ($(this).val() !== "") {
            getEtudiantAPlacer();
            if ($('#president').val() !== "" && $('#selectJour').val() !== "" && $('#salle').val() !== "") {
                getEtudiantDejaPlacer();
            }
        }
    });

    $('#selectJour').on('change', function () {
        if ($('#enseignant').val() !== "" && $('#president').val() !== "" && $('#salle').val() !== "" && $(this).val() !== "") {
            getEtudiantDejaPlacer();
        }
    });

    $('#salle').on('change', function () {
        if ($('#enseignant').val() !== "" && $('#selectJour').val() !== "" && $('#president').val() !== "" && $(this).val() !== "") {
            getEtudiantDejaPlacer();
        }
    });


    //query for take dureeSoutenance
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=heure",
        data: {
            requete: "getDureeSoutenance",
            noSection: localStorage.getItem("numSection")
        },
        dataType: 'json',
        async: false
    }).done(function (data) {
        dureeSoutenance = parseInt(data.intervalle);
        selectHour(dureeSoutenance, 8, 0);
    }).fail(function () {

    });


    function selectHour(intervalle, heureDebut, minutesDebut) {
        var d = new Date();
        d.setHours(heureDebut);
        d.setMinutes(minutesDebut);
        $('#heureDebut').empty();
        $('#heureDebut').append("<option value=''>Sélectionner heure début</option>");
        if (d.getHours() < 18 && d.getHours() >= 8) {
            do {
                var res = (d.getMinutes() === 0) ? 0 : '';
                if (intervalle === 40) {
                    $('#heureDebut').append('<option value="' + d.getHours() + ":" + d.getMinutes() + res + ':00">' + d.getHours() + "H" + d.getMinutes() + res + '</option>');
                    minutesDebut = 40;
                    d.setMinutes(d.getMinutes() + 40);
                } else if (intervalle === 60) {
                    $('#heureDebut').append('<option value="' + d.getHours() + ":" + d.getMinutes() + res + ':00">' + d.getHours() + "H" + d.getMinutes() + res + '</option>');
                    heureDebut++;
                    d.setHours(heureDebut);
                }
            } while (d.getHours() < 18);
        }
    }

    $("#listeEtudPlaces li").hover(function () {
        $('#listeEtudPlaces li').css('cursor', 'move');
    });

    /* var pour le drag & drop */

    //var contenant le code html de la liste des horaires et des etudiants
    var lienEtudiants = '';
    //var de travail a incrementer
    var i = 0;
    //var de la l'heure de passage de l'étudiant
    var heurePassage = new Date();
    //var qui contiendra l'heure sous sa forme complete : ex 8H00
    var heureComplete;

    $("#listeEtudPlaces").sortable({
        placeholder: "ui-state-highlight",
        cursor: "move",
        update: function (event, ui) {  // callback quand l'ordre de la liste est changee
            clearTab();
            var maListe = $("#listeEtudPlaces li");
            if(maListe.length > 0) {
                var heurePassagePremierEtud = getHourFirstStudent();
                var data = heurePassagePremierEtud.trim().toLowerCase().split('h');
                var heureDernierEtud = data[0];
                var minuteDernierEtud = data[1];
                heurePassage.setHours(heureDernierEtud);
                heurePassage.setMinutes(minuteDernierEtud);
            } else {
                getHour(heurePassage);
            }

            updateTab();

            //vides la liste afin d'éviter les doublons
            $("#listeEtudPlaces").empty();
            $.each(tabEtudiants, function (key, val) {
                $("#listeEtudPlaces").append(rempListeEtudiant(val, val.nomEtud));
            });
        }
    });

    //Faire d'un etudiant un element <li> de la liste html
    function rempListeEtudiant(val, nomEtud) {
        if (heurePassage.getHours() === 12) {
            heurePassage.setHours(13);
            heurePassage.setMinutes(0);
        }

        heureComplete = heurePassage.getHours() + "H" + parseMinutes(heurePassage.getMinutes());
        dureeSoutenance === 40 ? heurePassage.setMinutes(heurePassage.getMinutes() + 40) : heurePassage.setHours(heurePassage.getHours() + 1);

        return '<li class="ui-state-default" id="' + val.noEtud + '">' + heureComplete + ' - ' + nomEtud + '</li>';
    }

    function getEtudiantDejaPlacer() {
        $.ajax({
            url: link + "parse.php?page=etudiantPlace",
            type: "POST",
            data: {
                valPresident: $('#president').val(),
                valEnseignant: $('#enseignant').val(),
                valDate: $('#selectJour').val(),
                valSalle: $('#salle').val()
            },
            dataType: 'json', // JSON
            success: function (data) { // tout est ok, check précédemment
                var arrPlace = [];
                $.each(data, function (key, val) {
                    var nomEtud = val.nom + " " + val.prenom;
                    var dataHeure = (val.heure).trim().toLowerCase().split(':');
                    var hour = dataHeure[0];
                    var minute = dataHeure[1];


                    //lienEtudiants += '<li class="ui-state-default" id="' + val.noEtud + '">' + hour + "H" + minute + ' - ' + nomEtud + '</li>';
                    $('#listeEtudPlaces').append('<li class="ui-state-default" id="' + val.noEtud + '">' + hour + "H" + minute + ' - ' + nomEtud + '</li>');
                    arrPlace.push(val.noEtud);
                });
                updateTab();
                var arrOption = [];
                $('#option-etudiant option').each(function (key, val) {
                    arrOption.push($(this).val());
                });

                $('#listeEtudPlaces li').each(function (key, val) {
                    if ($.inArray($(this).attr('id'), arrOption) >= 0 && ($.inArray($(this).attr('id'), arrPlace) >= 0 || $.inArray($(this).attr('id'), arrIdStudent) >= 0)/*) || 
                            ($.inArray($(this).attr('id'), arrIdStudent) >= 0 && $.inArray($(this).attr('id'), arrOption) >= 0)*/) {
                        $('[value=' + $(this).attr('id') + ']').attr('disabled', true);
                    } /*else if ($.inArray($(this).attr('id'), arrOption) < 0) {
                        $('[value=' + $(this).attr('id') + ']').attr('disabled', false);
                        $(this).remove();
                    } else if ($.inArray($(this).attr('id'), arrIdStudent) >= 0 && $.inArray($(this).attr('id'), arrOption) >= 0) {
                        $('[value=' + $(this).attr('id') + ']').attr('disabled', true);
                        
                    }*/ else {
                        $('[value=' + $(this).attr('id') + ']').attr('disabled', false);
                        $(this).remove();
                    }
//                    if ($.inArray($(this).attr('id'), arrOption) >= 0) {
//                        if ($.inArray($(this).attr('id'), arrPlace) >= 0) {
//                            $('[value=' + $(this).attr('id') + ']').attr('disabled', true);
//                        } else {
//                            $('[value=' + $(this).attr('id') + ']').attr('disabled', false);
//                            $(this).remove();
//                        }
//                    } else {
//                        $(this).remove();
//                    }
                });

                updateTab();
                showTab();
            },
            error: function () {
                console.log("Erreur getEtudiantDejaPlacer() in forms.js");
            }
        });
    }
});