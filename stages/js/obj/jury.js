
/* global link, debug */

$(document).ready(function () {
    getId = function (id) {
        //utilisation du $ possible dans la fonction

        $("#button-salle .btn-success").click(function () {
            $(".btn-success").removeClass('disabled');
            $(this).addClass("disabled");
        });

        $.ajax({
            url: link + "parse.php?page=jury",
            type: "POST",
            data: {
                getNoSalle: id,
                getSection: localStorage.getItem("numSection")
            },
            dataType: 'json', // JSON
            beforeSend: function () {
                if (debug) {
                    $('#loadJury').append('<div class="alert alert-info">Chargement des jurys <img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie" /></div>');
                }
            },
            success: function (data) {
                $('#table-body').empty();
                //var nbetudiant = 0;
                var nbetudiantplace = 0;
                (id === -1) ? $('#table-body').append('<tr class="info" ><td colspan=5><center id="etu-place"><b> Etudiants placés </b><center></td></tr>\n\
                                                        <tr><td><b>Encadrants</b></td><td><b>Etudiants</b></td><td><b>Jury</b></td><td><b>Soutenances</b></td><td><b>Interventions</b></td></tr>')
                        :
                        $('#table-body').append('<tr class="info">\n\
                                                        <td id="noOrdre"><b>Jury</b></td>\n\
                                                        <td id="date">Date</td>\n\
                                                        <td id="soutenance"><b>Soutenances</b></td>\n\
                                                        <td id="president"><b>Président</b></td>\n\
                                                        <td id="enseignant"><b>Enseignants</b></td>\n\
                                                        <td id="expCom"><b>Exp-com</b></td>\n\
                                                        <td><b>Supprimer le Jury</b></td>\n\
                                                    </tr>');

                $('#informationAlert').empty();

                $.each(data, function (key, value) {
                    if (value.eleve === 'true') {
                        var $expCom = (value.nomExpCom === null && value.prenomExpCom === null) ? "" : value.nomExpCom + ' ' + value.prenomExpCom;
                        if (id === -1) {
                            if (value.soutenance !== 0) {

                                nbetudiantplace += value.etudiantPlace;
                                $('#table-body').append('<tr><td>' + value.encadrant + '</td><td>' + value.etudiantPlace + "/" + value.etudiant + '</td>\n\
                                                <td>' + value.jurys + '</td><td>' + value.soutenance + '</td><td>' + value.intervention + '</td></tr>');
                                $('#etu-place').html("Etudiants placés : " + nbetudiantplace + "/" + value.Promo);
                            }
                        }
                        else {
                            $('#table-body').append('<tr style="cursor: pointer;"  class=' + value.no + '>\n\
                                                    <td onclick=getLigne(' + value.noSalle + ',' + value.noPdt + ',' + value.noEns + ',' + value.no + ',"' + value.dateBdd + '") id="noOrdre">' + value.noOrdre + '</td>\n\
                                                    <td onclick=getLigne(' + value.noSalle + ',' + value.noPdt + ',' + value.noEns + ',' + value.no + ',"' + value.dateBdd + '") id="date">' + value.date + '</td>\n\
                                                    <td onclick=getLigne(' + value.noSalle + ',' + value.noPdt + ',' + value.noEns + ',' + value.no + ',"' + value.dateBdd + '") id="soutenance">' + value.soutenance + '</td>\n\
                                                    <td onclick=getLigne(' + value.noSalle + ',' + value.noPdt + ',' + value.noEns + ',' + value.no + ',"' + value.dateBdd + '") id="president">' + value.nomPresident + ' ' + value.prenomPresident + '</td>\n\
                                                    <td onclick=getLigne(' + value.noSalle + ',' + value.noPdt + ',' + value.noEns + ',' + value.no + ',"' + value.dateBdd + '") id="enseignant">' + value.nomEnseignant + ' ' + value.prenomEnseignant + '</td>\n\
                                                    <td onclick=getLigne(' + value.noSalle + ',' + value.noPdt + ',' + value.noEns + ',' + value.no + ',"' + value.dateBdd + '") id="expCom">' + $expCom + '</td>\n\
                                                    <td><center><button type="button" class="btn btn-danger ' + value.no + '" data-toggle="modal" id=' + value.no + ' onclick=getModal("' + value.nomPresident + '","' + value.prenomPresident + '","' + value.nomEnseignant + '","' + value.prenomEnseignant + '",' + value.no + ',' + value.noOrdre + ',' + id + ')>Supprimer</button><center></td></tr>');

                    }
                    }
                    else
                {
                    
                    if(value.nbErreurEleve>0)
                    {
                        $('#table-body tr').each(function(index) {
                            var cellule=$(this).find('#soutenance').html();
                            //var etudiant=$(this).find('#soutenance').find('span').html();
                            if(cellule.search(value.etudiant)!==-1)
                            {
                                
                                $('.'+value.noEtud).css('color','red');
                                $(this).css('background-color','#F0AD4E');            
                            }
                        });
                    }
                    else if(value.nbErreurJury>0)
                    {
                        $('#table-body tr').each(function(index) {
                            /*var cellule=$(this).find('#soutenance').html();
                            var etudiant=$(this).find('#soutenance').find('span').html();*/
                            if($(this).attr('class')===value.noJury){
                                $(this).css('background-color','#F0AD4E');
                                $(this).find('#date').css('color','blue');
                                $(this).find('#soutenance').find("u").css('color','blue');
                            }
                        });
                    }
                    
                    else if(value.nbErreurSoutenance>0)
                    {
                        $('#table-body tr').each(function(index) {
                            
                            var caseEnseignant=$(this).find('#enseignant').html();
                            var casePresident=$(this).find('#president').html();

                            if(($(this).attr('class')===value.noJury)&&(casePresident.search(value.enseignant)!==-1)){
                                $(this).css('background-color','#F0AD4E');
                                $(this).find('#president').css('color','red');
                            }
                            
                            if(($(this).attr('class')===value.noJury)&&(caseEnseignant.search(value.enseignant)!==-1)){
                                $(this).css('background-color','#F0AD4E');
                                $(this).find('#enseignant').css('color','red');
                            }
                        });
                    }
                }
                });
                if (debug) {
                    $('#loadJury').empty();
                    $('#loadJury').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong> Jurys chargÃ©s</div>');
                }
            },
            error: function () {
                if (debug) {
                    $('#loadJury').empty();
                    $('#loadJury').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"> Une erreur est survenue lors du chargement des jurys</div>');
                }
            }
        });


    };

    // fonction affichage des informations sur le clic d'une ligne
    getLigne = function (salle, pdt, ens, idJury, date) {
        $("#salle option[value=" + salle + "]").prop('selected', true);
        $("#president option[value=" + pdt + "]").prop('selected', true);
        $("#enseignant option[value=" + ens + "]").prop('selected', true);
        $("#selectJour option[value=" + date + "]").prop('selected', true);
        getEtudiantAPlacer();
        EtudiantPlace(idJury);
    };


    //fonction affichage du message de suppression
    getModal = function (nomPre, prenomPre, nomEns, prenomEns, idJury, idOrdre, nosalle) {
        $("#delete #rowJury").empty();
        $("#delete #rowJury").append('Voulez-vous supprimer définitivement le Jury ' + nomPre + ' ' + prenomPre + ' et ' + nomEns + ' ' + prenomEns + ' ?');
        $('#delete #confirmDelete').attr('onclick', 'deleteJury(' + idJury + ',' + nosalle + ')');
        $("#delete").modal('show');

    };


    //fonction suppression du jury
    deleteJury = function (idJury, nosalle) {
        $.ajax({
            url: link + "parse.php?page=jury",
            type: "POST",
            data: "getIdJury=" + idJury + "&getNoSalle=" + nosalle,
            dataType: 'json', // JSON

            success: function (data) {
                $.each(data, function (key, value) {
                    getId(value.nosalle);
                });
            },
            error: function () {
                if (debug) {
                    $('#loadJury').empty();
                    $('#loadJury').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"> Une erreur est survenue lors du chargement des jurys</div>');
                }
            }
        });

        $("#delete").modal('hide');
    };


    //fonction affichage des étudiants déja placé

    EtudiantPlace = function (idJury) {

        $.ajax({
            url: link + "parse.php?page=etudiant",
            type: "POST",
            data: "getIdJury=" + idJury,
            dataType: 'json',
            success: function (data) {

                var PremierEtudiant = 0;

                $('#listeEtudPlaces').empty();
                PremierEtudiant = 0;
                heureDebut = 0;

                $.each(data, function (key, value) {
                    if (PremierEtudiant === 0) {
                        heureDebut = value.heure;
                    }
                    $('#listeEtudPlaces').append('<li class="ui-state-default" id="' + value.id + '">' + value.heure + ' - ' + value.nomEtud + ' ' + value.prenomEtud + '</li>');
                    setTabEtudiant(value.id, parseDate(value.heure), value.nomEtud + ' ' + value.prenomEtud);
                    PremierEtudiant++;
                });

                // selection de l'heure
                $('#heureDebut option').each(function (index) {
                    if ($(this).val() === parseDate(heureDebut)) {
                        $(this).attr('selected', 'true');
                    }
                });
                
                if($('#heureDebut').val() === ""){
                    $('#freeTime').val(heureDebut);
                }

                //animation de l'ancre
                $('html,body').animate({
                    scrollTop: $('#indexHaut').offset().top
                }, 700);
            },
            error: function () {
                if (debug) {
                    $('#loadJury').empty();
                    $('#loadJury').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"> Une erreur est survenue lors du chargement des données</div>');
                }
            }
        });
    };



});
