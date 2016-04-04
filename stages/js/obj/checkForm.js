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


/* global link, tabEtudiants, selected */

$(document).ready(function () {

    var $form = $('#formCreateSout');
    var $choicePlace = $('#salle');
    var $president = $('#president');
    var $enseignant = $('#enseignant');
    var $expCom = $('#expCom');
    var $day = $('#selectJour');
    var $timeSelect = $('#heureDebut');
    var $freeTime = $('#freeTime');
    var $students = $("#listeEtudPlaces");
    $freeTime.val("");

    $form.submit(function (e) {
        e.preventDefault();
        if ($choicePlace.val() === "" || $president.val() === "" || $enseignant.val() === "" || $day.val() === "" || ($timeSelect.val() === "" && $freeTime.val().trim() === "") || $students.text() === "") {
            changeClassOnEvent($choicePlace, 1);
            changeClassOnEvent($president, 1);
            changeClassOnEvent($day, 1);
            changeClassOnEvent($enseignant, 1);
            changeClassOnEvent($expCom, 0);

            if ($students.text() === "" && $choicePlace.val() !== "" && $president.val() !== "" && $enseignant.val() !== "" && $day.val() !== "" && ($timeSelect.val() !== "" || $freeTime.val().trim() !== "")) {
                showMessage('Attention', "SVP, veuillez placer des étudiants avant la création du jury et des soutenances.", "Warning");
                $('#modal .btn-primary').on('click', function () {
                    $('#option-etudiant').focus();
                });
            }

            if ($timeSelect.val() === "" && $('#freeTime').val().trim() === "") {
                changeClassOnEvent($timeSelect, 1);
                changeClassOnEvent($freeTime, 1);
            }

        } else {
            updateTab();
            showTab();
            /*var tabEtudiantCopy = [];
            $("#listeEtudPlaces li").each(function () {
                var id = $(this).attr('id');
                var name = $(this).text().split('-')[1].trim();
                var hour = parseDate($(this).text().split('-')[0].trim());
                //alert(id + ' et name = ' + name + ' et hour = ' + hour);
                tabEtudiantCopy.push({noEtud: id,
                    heureEtud: hour,
                    nomEtud: name});
            });*/
            $.ajax({
                method: "POST",
                url: link + "parse.php?page=createSoutenance",
                data: {
                    send: "true",
                    idSalle: $choicePlace.val(),
                    idPresident: $president.val(),
                    idEnseignant: $enseignant.val(),
                    idExpCom: $expCom.val(),
                    dateJour: $day.val(),
                    section: localStorage.getItem("numSection"),
                    etudiants: tabEtudiants
                    //etudiants: tabEtudiantCopy
                },
                dataType: 'json',
                success: function (data) {
                    if (data.createOk === "ok") {
                        showMessage("Création réussie",
                                "Le jury et les soutenances ont été crées avec succès.",
                                "Success");
                    }
                    $('button[id="' + $choicePlace.val() + '"]').trigger('click');
                },
                error: function () {

                }
            });
        }
        
    });

    $choicePlace.on('change', function () {
        changeClassOnEvent($choicePlace, 1);
        if ($(this).val() !== "")
            $('button[id="' + $(this).val() + '"]').trigger('click');
    });

    $president.on('change', function () {
        changeClassOnEvent($president, 1);
        if ($(this).val() === $enseignant.val()) {
            $enseignant.val('');
            $enseignant.parent('div').addClass('has-error');
        }
    });

    $enseignant.on('change', function () {
        changeClassOnEvent($enseignant, 1);
        if ($(this).val() === $president.val()) {
            $president.val('');
            $president.parent('div').addClass('has-error');
        }
    });

    $day.on('change', function () {
        changeClassOnEvent($day, 1);
    });

    $expCom.on('change', function () {
        changeClassOnEvent($expCom, 0);
    });

    $timeSelect.on('change', function () {
        if ($timeSelect.parent('div').hasClass('has-error')) {
            $timeSelect.parent('div').removeClass('has-error');
        }
        if ($freeTime.parent('div').hasClass('has-error')) {
            $freeTime.parent('div').removeClass('has-error');
        }
        if ($timeSelect.val() !== "") {
            $freeTime.val("");
            if ($freeTime.parent('div').hasClass('has-success')) {
                $freeTime.parent('div').removeClass('has-success');
            }
            if ($freeTime.parent('div').hasClass('has-error')) {
                $freeTime.parent('div').removeClass('has-error');
            }
            $timeSelect.parent('div').addClass('has-success');
        } else if ($timeSelect.val() === "" && $freeTime.val().trim() !== "") {
            $freeTime.parent('div').addClass('has-success');
            if ($timeSelect.parent('div').hasClass('has-success')) {
                $timeSelect.parent('div').removeClass('has-success');
            }
            if ($timeSelect.parent('div').hasClass('has-error')) {
                $timeSelect.parent('div').removeClass('has-error');
            }
        } else if ($timeSelect.val() === "") {
            if ($freeTime.parent('div').hasClass('has-success')) {
                $freeTime.parent('div').removeClass('has-success');
            }
            $timeSelect.parent('div').addClass('has-error');

        }
    });

    $choicePlace.on('change', function () {
        changeClassOnEvent($choicePlace, 1);
        $('#table-body').empty();
        if ($('#button-salle').find('.btn-success').hasClass('disabled'))
            $('#button-salle').find('.btn-success').removeClass('disabled');
        $('button[id="' + $(this).val() + '"]').trigger('click');
    });


    // function which add class error if required else warning when there are event for example change, blur ...
    function changeClassOnEvent(input, isError) {
        var className = (isError === 1) ? 'has-error' : 'has-warning';
        if (input.val().trim() === "") {
            input.parent('div').addClass(className);
            input.parent('div').hasClass('has-success') ? input.parent('div').removeClass('has-success') : '';
        } else {
            input.parent('div').addClass('has-success');
            input.parent('div').hasClass(className) ? input.parent('div').removeClass(className) : '';
        }
    }

});
