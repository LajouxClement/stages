/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global tabEtudiants, dureeSoutenance */

$(document).ready(function () {

    var $fromRight = $('#btnAjouterEtud'); //etudiant à placer => étudiant placé
    var $fromLeft = $('#btnRetirerEtud'); //etudiants placés => étudiant à placer
    var $etudiantsPlaces = $('#listeEtudPlaces');
    var $btnChangeHour = $('#changeHour');
    var heurePassage = new Date();
    //var lienEtudiants = '';
    //pour modifier l'heure d'une soutenance
    var etudiantSelected;
    var idEtudiantSelected;
    var boolHeureModif = false;
    var i = 0;


    $fromRight.click(function () {
        var maListe = $("#listeEtudPlaces li");
        if ($('#freeTime').val().trim() === "" && $('#heureDebut').val() === "" && maListe.length === 0) {
            showMessage("Attention", "SVP, veuillez sélectionner une heure de début ou en saisir une afin de continuer.", "Warning");
            $('#modal .btn-primary').on('click', function () {
                $('#heureDebut').focus();
            });

        } else {
            $('#option-etudiant :selected').each(function () {
                var heurePassage = getHourLastStudent(); // on prend la dernière heure incrementee
                var heure = (parseInt(heurePassage) < 10) ? heurePassage.substring(0, 1) : heurePassage.substring(0, 2);
                if (heure < 18) {
                    $(this).attr('disabled', true);
                    $(this).attr("selected", false);
                    $etudiantsPlaces.append('<li class="ui-state-default" id="' + $(this).val() + '">' + heurePassage + ' - ' + $(this).text().trim() + '</li>'); //on ajoute aux etudiants places

                    //setTabEtudiant($(this).val(), parseDate(heurePassage),$(this).text().trim());
                }
            });
            updateTab();
            showTab();
        }
    });

    $fromLeft.click(function () {
        $("#listeEtudPlaces li").each(function () {
            if ($(this).hasClass('isSelected') && typeof $(this) !== "undefined") {
                var nameStudent = $(this).text().split('-')[1].trim();
                $('#option-etudiant option:contains(' + nameStudent + ')').attr('disabled', false);
                $(this).remove(); //retire des etudiants places
                $.each(tabEtudiants, function (key, val) {
                    if (typeof val !== "undefined") {
                        if (val.nomEtud === nameStudent) {
                            tabEtudiants.splice(key, 1); //supprime du tableau d'etudiant qu'on postera
                        }
                    }
                });
            }
        });
        updateTab();
        showTab();
    });

    var touchtime = 0;
    $("#listeEtudPlaces").on('click', 'li', function () {
        if (touchtime === 0) {
            //set first click
            touchtime = new Date().getTime();
        } else {
            //compare first click to this click and see if they occurred within double click threshold
            if (((new Date().getTime()) - touchtime) < 800) {
                //double click occurred
                $(this).hasClass('isSelected') ? $(this).removeClass('isSelected') : $(this).addClass('isSelected');
                idEtudiantSelected = $(this).attr('id');
                etudiantSelected = $(this)[0].textContent;
                touchtime = 0;
            } else {
                //not a double click so set as a new first click
                touchtime = new Date().getTime();
            }
        }
        return false;
    });

    $btnChangeHour.on('click', function () {

        var data = $('#inputChangeHour').val().trim().toLowerCase().split('h');
        var hour = data[0];
        var minute = data[1];
        var nomEtudiant = (parseInt(etudiantSelected) < 10) ? etudiantSelected.substring(7) : etudiantSelected.substring(8);

        //Supprimer l'etudiant et le recreer avec sa nouvelle heure puis l'ajouter dans tabEtudiant
        $.each(tabEtudiants, function (key, val) {
            if (val.nomEtud.trim() == nomEtudiant.trim()) {
                //créé le nouvel etudiant avec la nouvelle heure
                var etudiant = {
                    noEtud: idEtudiantSelected,
                    heureBrut: hour + "h" + minute,
                    heureEtud: parseDate(hour + "h" + minute),
                    nomEtud: nomEtudiant
                };
                tabEtudiants.splice(key, 1, etudiant); //change l'etudiant dont l'heure est modif
            }
        });

        tabEtudiants.sort(function (a, b) {
            var compareDateA = new Date();
            var compareDateB = new Date();
            var dataA = (a.heureEtud).trim().toLowerCase().split(':');
            var dataB = (b.heureEtud).trim().toLowerCase().split(':');
            compareDateA.setHours(dataA[0]);
            compareDateA.setMinutes(dataA[1]);
            compareDateB.setHours(dataB[0]);
            compareDateB.setMinutes(dataB[1]);
            return compareDateA.getTime() - compareDateB.getTime();
        });

        showTabWarning();

        //reorganiserHeuresSoutenances(hour + "h" + minute);
        boolHeureModif = false;
        
        //empty input
        $btnChangeHour.val("");
    });

    /** if event click on "reordonner" **/
    $('#newStartHour').on('click', function () {
        var data;
        if ($('#freeTime').val().trim() !== "") {
            data = $('#freeTime').val().trim().toLowerCase().split('h');
            $("#heureDebut").val("");
            if ($("#heureDebut").parent('div').hasClass('has-success')) {
                $("#heureDebut").parent('div').removeClass('has-success');
            }
            if ($("#heureDebut").parent('div').hasClass('has-error')) {
                $("#heureDebut").parent('div').removeClass('has-error');
            }
            $('#freeTime').parent('div').addClass('has-success');
        } else if ($('#heureDebut :selected').val() !== "") {
            data = $('#heureDebut :selected').text().trim().toLowerCase().split('h');
        }

        var hour = data[0];
        var minute = data[1];
        heurePassage.setHours(hour);
        heurePassage.setMinutes(minute);

        updateTab();

        //recuperer la nouvelle liste
        $("#listeEtudPlaces").empty();
        $.each(tabEtudiants, function (key, val) {
            $("#listeEtudPlaces").append(rempListeEtudiant(val, val.nomEtud));
        });
    });

    //Faire d'un etudiant un element <li> de la liste html
    function rempListeEtudiant(val, nomEtud) {
        if (heurePassage.getHours() === 12) {
            heurePassage.setHours(13);
            heurePassage.setMinutes(0);
        }

        var heureComplete = heurePassage.getHours() + "H" + parseMinutes(heurePassage.getMinutes());//heurePassage.getMinutes() + res;
        dureeSoutenance === 40 ? heurePassage.setMinutes(heurePassage.getMinutes() + 40) : heurePassage.setHours(heurePassage.getHours() + 1);

        return '<li class="ui-state-default" id="' + val.noEtud + '">' + heureComplete + ' - ' + nomEtud + '</li>';
    }

    //Remplir le tableau tabEtudiants
    function rempTabEtudiants(liste) {
        do {
            var content = liste[i].textContent;
            var nomEtudiant = (parseInt(content) < 10) ? content.substring(7) : content.substring(8);
            var heureDePassage = (parseInt(content) < 10) ? content.substring(0, 4) : content.substring(0, 5);
            //Créer un objet avec param noEtud et heureEtud
            var etudiant = new Object();
            etudiant.noEtud = liste[i].id;
            etudiant.heureEtud = parseDate(heureDePassage);
            etudiant.nomEtud = nomEtudiant;
            tabEtudiants.push(etudiant);
            i++;

        } while (liste.length > i);
    }

    //Reorganiser les soutenances apres la modif d'une heure
    function reorganiserHeuresSoutenances(heureModifiee) {

        $.each(tabEtudiants, function (key, val) {
            var newHour = new Date();
            var data = val.heureEtud.trim().toLowerCase().split(':');
            //on affiche les horaires normaux de base
            if ((val.heureEtud != parseDate(heureModifiee)) && boolHeureModif == false) {
                newHour.setHours(data[0]);
                newHour.setMinutes(data[1]);
                //lienEtudiants += '<li class="ui-state-default" id="' + val.noEtud + '">' + newHour.getHours() + "H" + parseMinutes(newHour.getMinutes()) + ' - ' + val.nomEtud + '</li>';
                $('#listeEtudPlaces').append('<li class="ui-state-default" id="' + val.noEtud + '">' + newHour.getHours() + "H" + parseMinutes(newHour.getMinutes()) + ' - ' + val.nomEtud + '</li>');
            } else if ((val.heureEtud == parseDate(heureModifiee)) && boolHeureModif == false) {
                newHour.setHours(data[0]);
                newHour.setMinutes(data[1]);
                $('#listeEtudPlaces').append('<li class="ui-state-default" id="' + val.noEtud + '">' + newHour.getHours() + "H" + parseMinutes(newHour.getMinutes()) + ' - ' + val.nomEtud + '</li>');
                boolHeureModif = true;
            }
            //ensuite on reorganise tout le planning en fonction de dureeSoutenance
            else if (boolHeureModif) {
                newHour.setHours(data[0]);
                newHour.setMinutes(data[1]);
                dureeSoutenance === 40 ? newHour.setMinutes(newHour.getMinutes() + 40) : newHour.setHours(newHour.getHours() + 1);
                //lienEtudiants += '<li class="ui-state-default" id="' + val.noEtud + '">' + newHour.getHours() + "H" + parseMinutes(newHour.getMinutes()) + ' - ' + val.nomEtud + '</li>';
                $('#listeEtudPlaces').append('<li class="ui-state-default" id="' + val.noEtud + '">' + newHour.getHours() + "H" + parseMinutes(newHour.getMinutes()) + ' - ' + val.nomEtud + '</li>');
            }
        });

        $('#listeEtudPlaces').empty();

        showTab();
    }
});