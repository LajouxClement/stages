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


/* global arraySection, link, debug */

$(document).ready(function () {

    if (debug) {
        $('#modal').modal('show');
    }

    /** take ALL section By responsable **/
    $.ajax({
        method: "POST",
        url: link + "parse.php?page=responsable",
        data: {
            idRes: localStorage.getItem("noResp")
        },
        dataType: 'json',
        async: false,
        beforeSend: function () {
            $('#loadSection').append('<div class="alert alert-info">Chargement des sections <img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie" /></div>');
        }
    }).done(function (data) {
        $.each(data, function (key, val) {
            arraySection.push(val);
        });
        $('#loadSection').empty();
        $('#loadSection').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong>Sections chargées</div>');
    }).fail(function () {
        $('#loadSection').empty();
        $('#loadSection').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"></span></strong> Une erreur est survenue lors du chargement des sections</div>');
    });

    /** arraySection > 1 && empty(numSection) => set localStorage **/
    if (arraySection.length > 1 && !localStorage.getItem("numSection")) {
        $.ajax({
            method: "POST",
            url: link + "parse.php?page=section",
            data: {
                getNumSection: arraySection
            },
            async: false,
            beforeSend: function () {
                if (debug) {
                    $('#loadSectionByResponsable').append('<div class="alert alert-info">Chargement de vos sections ' + localStorage.getItem('nomResp') + ' <img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie" /></div>');

                }
            },
            dataType: 'json' //JSON
        }).done(function (data) {
            if (data.numSection) { //not empty
                localStorage.setItem("numSection", data.numSection);
                localStorage.setItem("libSection", data.lib);
            } else {
                localStorage.setItem("numSection", arraySection[0].noSection);
                localStorage.setItem("libSection", arraySection[0].lib);
            }
            if (debug) {
                $('#loadSectionByResponsable').empty();
                $('#loadSectionByResponsable').append('<div class="alert alert-success"><strong><span class="glyphicon glyphicon-ok"></span></strong> Vos sections ont été chargées</div>');
            }
        }).fail(function () {
            if (debug) {
                $('#loadSectionByResponsable').empty();
                $('#loadSectionByResponsable').append('<div class="alert alert-danger"><strong><span class="glyphicon glyphicon-remove"></span></strong> Une erreur est survenue lors du chargement de vos sections</div>');
            }

        });
    }


    //get and save num section
    if (arraySection.length === 1) {
        localStorage.setItem("numSection", arraySection[0].noSection);
        localStorage.setItem("libSection", arraySection[0].lib);
    }

    if (arraySection.length > 1) {
        $('#dropDownSection').fadeIn(1000);
        for (var i = 0; i < arraySection.length; i++) {
            var isChecked = (arraySection[i].noSection === localStorage.getItem('numSection')) ? "class='disabled alert-info'" : "";
            $('#dropDownSection .dropdown-menu').append("<li " + isChecked + ">\n\
                                                <a href='#' data-name='yourSection' data-val='" + arraySection[i].noSection + ";" + arraySection[i].lib + "'>" + arraySection[i].lib + " - " + arraySection[i].libLong + "</a>\n\
                                                </li>");
        }
    }

    //set num section
    $('.dropdown-menu li').on('click', function (e) {
        if (!$(this).hasClass("disabled")) {
            var split = $(this).children('a').attr('data-val').split(';');
            localStorage.setItem('numSection', split[0]);
            localStorage.setItem('libSection', split[1]);
            location.reload();
        }
    });

    $('#nameResp').append("Section " + localStorage.getItem("libSection"));


});