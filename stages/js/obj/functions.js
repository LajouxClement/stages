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

/* global tabEtudiants, dureeSoutenance */

function parseDate(str) {
    // change format 8h15 to 8:15:00
    var explode = str.toLowerCase().split('h');
    var goodDate = new Date(0, 0, 0, explode[0], explode[1]);

    return goodDate.getHours() + ':' + parseMinutes(goodDate.getMinutes()) + ':00';
}

function showMessage(title, content, type) {
    if ($('#modal .modal-header').hasClass("alert-danger"))
        $('#modal .modal-header').removeClass("alert-danger");
    if ($('#modal .modal-header').hasClass("alert-success"))
        $('#modal .modal-header').removeClass("alert-success");
    if ($('#modal .modal-header').hasClass("alert-warning"))
        $('#modal .modal-header').removeClass("alert-warning");
    if ($('#modal .modal-header').hasClass("alert-info"))
        $('#modal .modal-header').removeClass("alert-info");
    switch (type) {
        case "Error":
            $('#modal .modal-header').addClass("alert-danger");
            break;
        case "Success":
            $('#modal .modal-header').addClass("alert-success");
            break;
        case "Warning":
            $('#modal .modal-header').addClass("alert-warning");
            break;
        default:
            $('#modal .modal-header').addClass("alert-info");
            break;
    }
    //show modal with title = title and content = content
    $('#modal').find('.modal-title').html(title);
    $('#modal').find('.modal-body').html(content);
    $('#modal').modal('show');
}

function getHour(dateType) {
    var h, m, time, explode;
    if ($('#heureDebut :selected').val() !== "") {
        time = parseDate($('#heureDebut :selected').text().trim());
    } else if ($('#freeTime').val().trim() !== "") {
        time = parseDate($('#freeTime').val().trim());
    }
    explode = time.split(':');
    h = explode[0];
    m = explode[1];
    dateType.setHours(h);
    dateType.setMinutes(m);

}

function parseMinutes(min) {
    if (min < 10 && min !== 0)
        return '0' + min;

    if (min === 0)
        return "00";

    if (min >= 10)
        return min;

}

function setTabEtudiant(id, hour, name, brut) {
    var etudiant = {
        noEtud: id,
        heureEtud: hour,
        heureBrut: brut,
        nomEtud: name
    };
    tabEtudiants.push(etudiant); //on ajoute l'objet au tableau

}

function showTab() {
    var liste = "";
    for (var i = 0; i < tabEtudiants.length; ++i) {
        liste += '<li class="ui-state-default" id="' + tabEtudiants[i].noEtud + '">' + tabEtudiants[i].heureBrut + ' - ' + tabEtudiants[i].nomEtud + '</li>';
    }

    $('#listeEtudPlaces').html(liste);
}

//Change la couleur d'une ligne si l'écart n'est plus bon
function showTabWarning() {
    var liste = "";
    var date1 = new Date();
    var date2 = new Date();

    for (var i = 0; i < tabEtudiants.length; ++i) {

        var data1 = tabEtudiants[i].heureBrut.trim().toLowerCase().split('h');
        date1.setHours(data1[0]);
        date1.setMinutes((data1[1]));

        if (typeof tabEtudiants[i + 1] == "undefined") {
            var data2 = tabEtudiants[i].heureBrut.trim().toLowerCase().split('h');
        } else {
            var data2 = tabEtudiants[i + 1].heureBrut.trim().toLowerCase().split('h');
            if (dureeSoutenance == 40) {
                date1.setMinutes(date1.getMinutes() + 40);
            } else {
                date1.setHours(date1.getHours() + 1);
            }
        }

        if (date1.getHours() === 12) {
            date1.setHours(13);
            date1.setMinutes(0);
        }

        date2.setHours(data2[0]);
        date2.setMinutes((data2[1]));

        if (date1.getHours() === date2.getHours() && date1.getMinutes() === date2.getMinutes()) {
            liste += '<li class="ui-state-default" id="' + tabEtudiants[i].noEtud + '">' + tabEtudiants[i].heureBrut + ' - ' + tabEtudiants[i].nomEtud + '</li>';

        } else {
            liste += '<li class="ui-state-default  warningHour" id="' + tabEtudiants[i].noEtud + '">' + tabEtudiants[i].heureBrut + ' - ' + tabEtudiants[i].nomEtud + '</li>';
        }
    }

    $('#listeEtudPlaces').html(liste);
}

function clearTab() {
    tabEtudiants = [];
}

function updateTab() {
    clearTab();
    arrIdStudent = [];

    $('#listeEtudPlaces li').each(function (key, val) {
        //delete doublons
        var ids = $('[id="' + $(this).attr('id') + '"]');
        if (ids.length > 1) {
            $('[id="' + $(this).attr('id') + '"]:gt(0)').remove();
        }
    });

    $("#listeEtudPlaces li").each(function (key, val) {
        setTabEtudiant($(this).attr('id'), parseDate($(this).text().split('-')[0]), $(this).text().split('-')[1], $(this).text().split('-')[0]);
        arrIdStudent.push($(this).attr('id'));
    });
}

function getHourFirstStudent() {

    updateTab();

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

    return tabEtudiants[0].heureBrut;
}

function getHourLastStudent() {
    var maListe = $("#listeEtudPlaces li");
    var heureDernierEtud = new Date();
    var dernierEtud = (maListe.length) - 1;
    var heureComplete;
    if (dernierEtud === -1) {
        getHour(heureDernierEtud);
    } else {
        var heureEtud = maListe[dernierEtud].textContent;
        var heure = (parseInt(heureEtud) < 10) ? heureEtud.substring(0, 1) : heureEtud.substring(0, 2);
        var minutes = (parseInt(heureEtud) < 10) ? heureEtud.substring(2, 4) : heureEtud.substring(3, 5);
        heureDernierEtud.setHours(heure);
        heureDernierEtud.setMinutes(minutes);
        dureeSoutenance === 40 ? heureDernierEtud.setMinutes(heureDernierEtud.getMinutes() + 40) : heureDernierEtud.setHours(heureDernierEtud.getHours() + 1);
        heureDernierEtud.getHours() === 12 ? heureDernierEtud.setHours(13) : heureDernierEtud.getHours();
    }
    heureComplete = heureDernierEtud.getHours() + "H" + parseMinutes(heureDernierEtud.getMinutes());

    //Heure du dernier etudiant
    return heureComplete;
}